<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompany extends FormRequest
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
            'name' => 'required',
            'logo' => 'dimensions:min_width=100,min_height=100,max_width=100,max_height=100'

        ];
    }

    public function messages()
    {
        return [
            'name.required' =>'Name is Required',
            'logo.dimensions' => 'logo must be 100X100'
        ];
    }
}
