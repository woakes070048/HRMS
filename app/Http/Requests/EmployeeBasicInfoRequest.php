<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeBasicInfoRequest extends FormRequest
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

         if($this->segment(3)){
             $employee_no ='required|regex:/[0-9][\-{1}][0-9]+$/|unique:users,id,'.$this->segment(3);
             $email = 'required|email|unique:users,email,'.$this->segment(3);
             $password = 'nullable';
             $retype_pass = 'nullable';
        }else{
             $employee_no ='required|regex:/[0-9][\-{1}][0-9]+$/|unique:users';
             $email = 'required|email|unique:users';
             $password = 'required|digits_between:6,16';
             $retype_pass = 'required|same:password';
         }

        return [
            'employee_no' => $employee_no,
            'designation_id' => 'required|numeric',
            'employee_type_id' => 'required|numeric',
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'email' => $email,
            'mobile_number' => 'required',
            'password' => $password,
            'retype_password' => $retype_pass,
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
            'employee_type_id' => 'employee type',

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
