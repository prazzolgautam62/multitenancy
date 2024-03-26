<?php

namespace Database\Seeders\Test;

use App\User;
use Illuminate\Database\Seeder;
use App\Models\Tenant\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use PermissionConstants;

class SingleTenantPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $all_actions = PermissionConstants::$ALL_ACTIONS;
        $group_to_actions = PermissionConstants::$GROUP_TO_ACTIONS;
        $group_to_permission = PermissionConstants::$GROUP_TO_PERMISSIONS;


        $newPermissions = [];
        $count = 1;
        foreach($group_to_actions as $_group => $_actions)
        {
            foreach($_actions as $__action)
            {
                $action = $all_actions[$__action];
                $action_name = str_replace(' ', '_', $action) ;
                $group_name = str_replace(' ', '_', $_group);

//                $newPermissions[$count]['id'] = $count;
                $newPermissions[$count]['name'] = "{$action_name}_{$group_name}";
                $newPermissions[$count]['display_name'] = "{$action} {$_group}";
                $newPermissions[$count]['group'] = $_group;
                $count++;
            }
        }

        foreach ($group_to_permission as $_group => $_permissions)
        {
            foreach ($_permissions as $__permission)
            {
//                $newPermissions[$count]['id'] = $count;
                $newPermissions[$count]['name'] = str_replace(' ', '_', $__permission);
                $newPermissions[$count]['display_name'] = $__permission;
                $newPermissions[$count]['group'] = $_group;
                $count++;
            }
        }

        try{
                Permission::query()->insertOrIgnore($newPermissions);


        }catch(\Exception $e){

            throw new \Exception($e->getMessage());
        }

    }
}
