<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

if(!function_exists('connectTenant'))
{
	function connectTenant($db_name)
	{

		// Disconnect from the tenant database and remove from local cache.
		DB::purge('tenant');
		//set tenant database to auth user $database_name
        Config::set('database.connections.tenant.database', $db_name);
//        Config::set('database.connections.tenant.username', $db_username);
//        Config::set('database.connections.tenant.password', $db_password);
		//rearrange and  reconnect database connection
        DB::reconnect('tenant');
		//ping tenant database connection
		Schema::connection('tenant')->getConnection()->reconnect();

	}
}

if(!function_exists('migrateTenant'))
{
	function migrateTenant()
	{
		Artisan::call('migrate', [
			'--database' => 'tenant',
			'--path' => 'database/tenant_migrations'
		]);
	}
}


if(!function_exists('rollbackTenant'))
{
	function rollbackTenant()
	{
		Artisan::call('migrate:rollback', [
			'--database' => 'tenant',
			'--path' => 'database/tenant_migrations'
		]);
	}
}

if(!function_exists('refreshTenant'))
{
	function refreshTenant()
	{
		Artisan::call('migrate:refresh', [
			'--database' => 'tenant',
			'--path' => 'database/tenant_migrations'
		]);
	}
}

if(!function_exists('createDatabase'))
{
	function createDatabase($database_name)
	{
        return DB::statement('CREATE DATABASE ' . $database_name);
	}
}

if(!function_exists('checkDatabaseExists'))
{
    function checkDatabaseExists($database_name)
    {
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        return $database = DB::select($query, [$database_name]);

    }
}

if(!function_exists('deleteDatabase'))
{
	function deleteDatabase($database_name)
	{
        $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
        $database = DB::select($query, [$database_name]);
        if(!empty($database)){
            DB::statement('DROP DATABASE ' . $database_name);
        }

	}
}
