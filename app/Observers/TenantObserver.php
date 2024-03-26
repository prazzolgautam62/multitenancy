<?php

namespace App\Observers;

use App\Models\Main\Tenant;
use App\Models\Main\TenantConfiguration;
use App\Models\Tenant\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Throwable;

class TenantObserver
{
    /**
     * Handle the Tenant "created" event.
     */
    public function created(Tenant $tenant): void
    {
        try {
            if (isset($tenant) && isset($tenant->database_name)) {
                $tenantConfiguration = [
                    "date_type" => "bs",
                ];
                (new TenantConfiguration([
                    'tenant_id' => $tenant->id,
                    'configuration' => $tenantConfiguration
                ]))->save();

                createDatabase($tenant->database_name);

                $tenant->connect();

                migrateTenant();

                try{
                    $newTenantUser['name'] = $tenant->name;
                    $newTenantUser['email'] = $tenant->email;
                    $newTenantUser['tenant_id'] = $tenant->id;
                    $newTenantUser['role'] = 2;
                    $newTenantUser['password'] = request()->password ?? (strtolower(explode(" ", $tenant->name)[0]) . '@1');
                    $user = new User($newTenantUser);
                    $user->save();

                    Artisan::call('db:seed:tenant:single');

                    $permissions = Permission::all(['id']);

                    $user->permissions()->sync($permissions);

                }catch(Throwable $e){
                    throw new \Exception($e->getMessage());
                }
            }
        } catch (Throwable $e) {
            throw  $e;
        }
    }

    /**
     * Handle the Tenant "updated" event.
     */
    public function updated(Tenant $tenant): void
    {
        //
    }

    /**
     * Handle the Tenant "deleted" event.
     */
    public function deleted(Tenant $tenant): void
    {
        //
    }

    /**
     * Handle the Tenant "restored" event.
     */
    public function restored(Tenant $tenant): void
    {
        //
    }

    /**
     * Handle the Tenant "force deleted" event.
     */
    public function forceDeleted(Tenant $tenant): void
    {
        //
    }
}
