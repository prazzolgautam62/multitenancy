<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTenantConfigurationRequest;
use App\Repositories\TenantConfigurationRepository;
use Illuminate\Http\Request;
use Throwable;

class TenantConfigurationController extends Controller
{
    private $tenant_configuration_repo;

    public function __construct(TenantConfigurationRepository $tenant_configuration_repo)
    {
          $this->tenant_configuration_repo = $tenant_configuration_repo;
    }

    public function index(){

    }

    public function store(){

    }

    public function update(UpdateTenantConfigurationRequest $request){
        $selected_tenant_configuration = $this->tenant_configuration_repo->findByTenantIdOrFail(auth()->user()->tenant_id);
        $input_configuration = $request->configuration;

        try {
            $selected_tenant_configuration->configuration = $input_configuration;
            $selected_tenant_configuration->save();
        } catch (Throwable $e) {
            return failResponse("failed ! {$e->getMessage()}");
        }

        return successResponse('successful!', $selected_tenant_configuration);
    }
}
