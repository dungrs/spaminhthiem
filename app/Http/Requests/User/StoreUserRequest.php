<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        return [
            'email' => 'required|string|email|unique:users,email,NULL,id,deleted_at,NULL|max:250',
            'name' => 'required|string',
            'user_catalogue_id' => 'required|integer|gt:0',
            'password' => "required|string|min:6",
            're_password' => "required|string|same:password",
            'birthday' => "required|date_format:d/m/Y"
        ];
    }

    public function messages() 
    {   
        $validateMessages = __('validation_create.user');

        return [
            'email.required' => $validateMessages['email']['required'],
            'email.email' => $validateMessages['email']['email'],
            'email.unique' => $validateMessages['email']['unique'],
            'email.string' => $validateMessages['email']['string'],
            'email.max' => $validateMessages['email']['max'],

            'name.required' => $validateMessages['name']['required'],
            'name.string' => $validateMessages['name']['string'],

            'user_catalogue_id.gt' => $validateMessages['user_catalogue_id']['gt'],
            'user_catalogue_id.required' => $validateMessages['user_catalogue_id']['required'],

            'birthday.required' => $validateMessages['birthday']['required'],
            'birthday.date_format' => $validateMessages['birthday']['date_format'],

            'password.required' => $validateMessages['password']['required'],
            'password.min' => $validateMessages['password']['min'],

            're_password.required' => $validateMessages['re_password']['required'],
            're_password.same' => $validateMessages['re_password']['same'],
        ];
    }
}
