<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTenant;
use App\Models\Main\Tenant;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        return successResponse('Successful!', compact('tenants'));
    }

    public function store(StoreTenant $request)
    {
        $input = $request->only([
            'name',
            'address',
            'contact_no',
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

    public function update(Request $request, $id)
    {
        $input = $request->only(['name', 'email', 'address', 'contact_no', 'url', 'established_year', 'pan_no']);
        $tenant = Tenant::findOrFail($id);
        try {
            $tenant->update($input);
            return response()->json(['status' => true, 'message' => 'updated successfully!', 'data' => $tenant]);
        } catch (Throwable $e) {
            return response()->json(['status' => false, 'message' => "failed ! {$e->getMessage()}"]);
        }
    }

    public function destroy($id)
    {
        $tenant = Tenant::find($id);
        $tenant->makeVisible('database_name');
        deleteDatabase($tenant->database_name);
        User::where('tenant_id', $tenant->id)->delete();
        $tenant->delete();
        return successResponse('Tenant deleted successfully !');
    }
}
