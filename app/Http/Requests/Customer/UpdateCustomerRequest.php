<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {   
        $rules = [
            'email' => 'required|string|email|unique:customers,email,'.$this->id.'|max:250',
            'name' => 'required|string',
            'birthday' => 'required|date_format:d/m/Y',
        ];
    
        if ($this->filled('password')) {
            $rules['password'] = 'required|string|min:6';
            $rules['re_password'] = 'required|string|same:password';
        }
    
        return $rules;
    }
    
    public function messages()
    {   
        $validateMessages = __('validation_update.user');

        return [
            'email.required' => $validateMessages['email']['required'],
            'email.email' => $validateMessages['email']['email'],
            'email.unique' => $validateMessages['email']['unique'],
            'email.string' => $validateMessages['email']['string'],
            'email.max' => $validateMessages['email']['max'],

            'name.required' => $validateMessages['name']['required'],
            'name.string' => $validateMessages['name']['string'],

            'birthday.required' => $validateMessages['birthday']['required'],
            'birthday.date_format' => $validateMessages['birthday']['date_format'],
            
            'password.required' => $validateMessages['password']['required'],
            'password.min' => $validateMessages['password']['min'],

            're_password.required' => $validateMessages['re_password']['required'],
            're_password.same' => $validateMessages['re_password']['same'],
        ];
    }
}
