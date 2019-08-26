<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
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
            'first_name' => 'required|max:64',
            'last_name' => 'required|max:64',
            'email' => 'required|unique:companies|max:128',
            'phone' => 'required|max:20',
            'company_id' => 'required'
        ];
    }
}
