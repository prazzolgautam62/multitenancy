<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Database\Seeders\Test\SingleTenantPermissionTableSeeder;


class SingleTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            $this->call([
                SingleTenantPermissionTableSeeder::class,
            ]);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }
}
