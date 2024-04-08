<?php


namespace App\Repositories;


use App\Models\Main\TenantConfiguration;

class TenantConfigurationRepository implements \App\Contracts\ITenantConfigurationRepository
{
    public function findByTenantIdOrFail(int $tenant_id, array $columns = ['*']) : TenantConfiguration
    {

       return TenantConfiguration::where('tenant_id', $tenant_id)->firstOrFail($columns);
    }
}
