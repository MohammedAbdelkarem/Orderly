<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends BaseApiRequest
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
        $rules = [
            'password' => ['required'],
        ];
        
        if($this->routeIs('customer.login'))
        {
            $rules['phone'] = ['required', 'exists:customers,phone'];
        }
        

        if($this->routeIs('admin.login'))
        {
            $rules['email'] = ['required', 'exists:admins,username'];
        }

        return $rules;
    }
}
