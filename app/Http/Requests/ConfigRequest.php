<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_name' => 'required|alpha_spaces|min:5|max:25|unique:configs',
            'package_name' => 'required',
            'first_name' => 'required|alpha|alpha_dash',
            'last_name' => 'required|alpha|alpha_dash',
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required|max:15|min:10',
            'password' => 'required|min:6|max:16',
            'password_confirmation' => 'required|min:6|max:16|same:password',
            'company_address' => 'required',
        ];
    }
}
