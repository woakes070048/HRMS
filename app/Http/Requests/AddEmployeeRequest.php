<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEmployeeRequest extends FormRequest
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
            'employee_no' => 'required',
            'designation_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'mobile_number' => 'required',
            'password' => 'required',
            'retype_password' => 'required|same:password',
//            'present_division_id' => 'required',
//            'present_district_id' => 'required',
        ];
    }


    public function attributes(){
        return [
            'designation_id' => 'employee designation'
        ];
    }
}
