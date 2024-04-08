<?php


namespace App\Contracts;


use App\Models\Main\TenantConfiguration;

interface ITenantConfigurationRepository
{
    public function findByTenantIdOrFail(int $tenant) : TenantConfiguration;
}
