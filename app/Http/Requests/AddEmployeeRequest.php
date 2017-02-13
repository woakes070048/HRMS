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
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required',
            'password' => 'required',
            'retype_password' => 'required|same:password',
            'present_division_id' => 'required',
            'present_district_id' => 'required',
            'present_policestation_id' => 'required',
            'present_postoffice' => 'required',
            'present_address' => 'required',
            'permanent_division_id' => 'required',
            'permanent_district_id' => 'required',
            'permanent_policestation_id' => 'required',
            'permanent_postoffice' => 'required',
            'permanent_address' => 'required',
        ];
    }


    public function attributes(){
        return [
            'designation_id' => 'employee designation',

            'present_division_id' => 'division',
            'present_district_id' => 'district',
            'present_policestation_id' => 'police station',
            'present_postoffice' => 'post office',

            'permanent_division_id' => 'division',
            'permanent_district_id' => 'district',
            'permanent_policestation_id' => 'police station',
            'permanent_postoffice' => 'post office',
        ];
    }
}
