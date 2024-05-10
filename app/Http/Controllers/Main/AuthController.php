<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utilities\ConvertDate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->only(['email', 'password']);

        if(!$selected_user = $this->attempt($credentials))
            return response()->json(['status' => false, 'message' => 'Invalid credentials!']);

        try {
        	$token = $selected_user->createToken('access_token')->plainTextToken;
            $this->getAllUserData($selected_user);

            return response()->json([
                'status' => true,
                'access_token' => 'Bearer '.$token,
                'message' => 'Successful authentication!',
                'user' => $selected_user
            ], 200);
        } catch (Throwable $e) {

            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }

    }

    private function attempt(array $credentials) : ? User
    {
    	try {
    		$selected_user = User::whereEmail($credentials['email'])->firstOrFail();
	    	if(!Hash::check($credentials['password'] , $selected_user->password))
	    		throw new Exception("invalid credentials!", 1);

	    	return $selected_user;
    	} catch (Throwable $e) {
    		return null;
    	}


    }

    private function getAllUserData(User $authUser) : void
    {
        if($authUser->tenant_id)
        {
            $authUser->tenant->connect();
            
            $data = $authUser->load([
                'tenant.configuration:id,tenant_id,configuration',
                'permissions:permissions.id,name,display_name,group',
            ]);
            $configuration = $data->tenant->configuration->configuration;
            if(is_string($configuration))
                $configuration =  json_decode((string) $configuration, true);

            ConvertDate::setConfiguration($configuration);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return successResponse('Logged out successfully !');
    }
}