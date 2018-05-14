<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditEmployeRequest extends FormRequest
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
            'first_name' => [
                'required',
                'max:255',
                'min:1'
            ],
            'last_name' => [
                'required',
                'max:255',
                'min:1'
            ],
            'phone' => [
                'required'
            ],
            'email' => [
                'required',
                'email'
            ],
            'company_id' => [
                'required',
                'exists:companies,id'
            ]
        ];
    }
}
