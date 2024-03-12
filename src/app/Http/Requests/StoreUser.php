<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'firstName' => 'required|max:50',
            'lastName' => 'required|max:50',
            'email' => 'required|max:50',
        ];
    }
    public function messages()
    {
        return [
            'firstName.required' => 'A firstName is required',
            'lastName.required'  => 'lastName is required',
            'email.required'  => 'A email is required',
        ];
    }
}
