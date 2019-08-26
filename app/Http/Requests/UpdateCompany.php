<?php

namespace App\Http\Requests;

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
            'name' => 'required|unique:companies|max:128',
            'email' => 'required|unique:companies|max:255',
            'logo' => 'nullable|image|max:1999',
            'website' => 'required',
            'company_id' => 'required'
        ];
    }
}
