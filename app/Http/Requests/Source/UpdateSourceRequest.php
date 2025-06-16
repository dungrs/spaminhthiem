<?php

namespace App\Http\Requests\Source;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSourceRequest extends FormRequest
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
            'name' => 'required',
            'keyword' => "required|unique:sources,keyword,{$this->id}",
        ];
    }

    /**
     * Custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages()
    {   
        $messages = __('validation_create.menu_catalogue');

        return [
            'name.required' => $messages['name']['required'],
            'keyword.unique' => $messages['keyword']['unique'],
            'keyword.required' => $messages['keyword']['required'],
        ];
    }
}
