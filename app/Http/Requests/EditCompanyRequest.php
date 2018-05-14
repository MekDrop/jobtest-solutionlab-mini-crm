<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditCompanyRequest extends FormRequest
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
        $unique_name = Rule::unique('companies');
        $logo_filled = 'required';
        if (isset($this->company)) {
            $unique_name->ignore($this->company->name);
            $logo_filled = '';
        }

        return [
            'name' => [
                'required',
                $unique_name,
                'max:255',
                'min:3'
            ],
            'logo' => [
                $logo_filled,
                'image',
                'dimensions:min_width=100,min_height=100'
            ],
            'website' => [
                'required',
                'url'
            ],
            'email' => [
                'required',
                'email'
            ]
        ];
    }
}
