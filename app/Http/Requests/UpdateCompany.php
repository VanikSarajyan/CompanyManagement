<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCompany extends FormRequest
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
            'name' => ['required', Rule::unique('companies')->ignore($this->company->id, 'id'), 'max:64'],
            'email' =>['required', 'email', Rule::unique('companies')->ignore($this->company->id, 'id'), 'max:128'],
            'logo' => 'nullable|image|max:1999',
            'website' => 'required'
        ];
    }
}
