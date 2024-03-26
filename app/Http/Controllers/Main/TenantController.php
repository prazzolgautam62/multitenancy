<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenant;
use App\Models\Main\Tenant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Throwable;

class TenantController extends Controller
{
    public function index(){
        $tenants = Tenant::all();
        return successResponse('Successful!', compact('tenants'));
    }

    public function store(StoreTenant $request){
        $input = $request->only([
            'name',
            'api_key',
            'address',
            'phone_nos',
            'logo',
            'email',
            'url',
            'established_year',
            'pan_no',
        ]);
        
        $app_name = config('app.name');
        if (is_null($app_name))
            throw new \RuntimeException("cannot read environment file!");

        $uuid = Str::uuid();
        $input['database_name'] =  Str::slug("{$app_name}_{$uuid}", '_');

        try {
            $tenant = new Tenant($input);
            $tenant->save();

            return response()->json(['status' => true, 'message' => 'Tenant created successfully.', 'data' => $tenant->makeVisible('database_name')]);
        } catch (Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'errors' => [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]
            ], 500);
        }
    }
}
