<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeSalaryRequest extends FormRequest
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
            'basic_salary' => 'required|numeric',
            'effective_date' => 'required|date',
            'bank_id' => 'nullable|required',
            'bank_account_no' => 'nullable|required|digits_between:13,26',
            'bank_account_name' => 'nullable|required|alpha_spaces',
            'bank_branch_name' => 'nullable|required|alpha_spaces',
        ];
    }


    public function attributes(){
        return [
            'bank_id' => 'bank name',
        ];
    }
}
