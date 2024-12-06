<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends BaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'        => ['required', 'string', 'max:255' ],
            'last_name'         => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'unique:customers,email'],
            'phone'             => ['required', 'string', 'max:10', 'unique:customers,phone'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'lat'               => ['nullable' , 'string'],
            'lng'               => ['nullable' , 'string'],
            'address_name'      => ['nullable' , 'string'], 
            'image'             => ['nullable' , 'image' , 'mimes:png,jpg,jpeg' , 'max:2048']
        ];
    }
}
