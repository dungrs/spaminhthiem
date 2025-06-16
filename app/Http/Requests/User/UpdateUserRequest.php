<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users,email,'.$this->id.'|max:250',
            'name' => 'required|string',
            'user_catalogue_id' => 'required|integer|gt:0',
            'birthday' => "required|date_format:d/m/Y"
        ];
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

            'user_catalogue_id.required' => $validateMessages['user_catalogue_id']['required'],
            'user_catalogue_id.integer' => $validateMessages['user_catalogue_id']['integer'],
            'user_catalogue_id.gt' => $validateMessages['user_catalogue_id']['gt'],

            'birthday.required' => $validateMessages['birthday']['required'],
            'birthday.date_format' => $validateMessages['birthday']['date_format'],
        ];
    }
}
