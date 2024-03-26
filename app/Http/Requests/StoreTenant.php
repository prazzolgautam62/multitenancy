<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreTenant extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules() : array
    {
        return [
            'name' => ['required', 'string','max:191', 'unique:tenants,name'],
            'api_key' => ['present', 'nullable', 'string', 'max:191', 'unique:tenants,api_key'],
            'address' => ['present', 'nullable', 'string', 'max:191'],
            'contact_no' => ['present', 'nullable', 'string', 'max:191'],
            'email' => ['required', 'string', 'max:191', 'unique:main.users,email'],
            'password' => ['required', 'string'],
            'url' => ['present', 'nullable', 'string', 'max:191'],
            'established_year' => ['present', 'nullable', 'string', 'max:191'],
            'pan_no' => ['present', 'nullable', 'string', 'max:191'],
        ];
    }

}
