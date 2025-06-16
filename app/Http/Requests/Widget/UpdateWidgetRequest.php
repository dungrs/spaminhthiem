<?php

namespace App\Http\Requests\Widget;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWidgetRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => "required",
            "keyword" => [
                'required',
                Rule::unique('widget_languages', 'keyword')->ignore($this->id, 'widget_id')
            ],
            "short_code" => "required|unique:widgets,short_code,{$this->id},id"
        ];
    }

    public function messages()
    {
        $messages = __('validation_create.widget');

        return [
            'name.required' => $messages['name']['required'],

            'keyword.required' => $messages['keyword']['required'],
            'keyword.unique' => $messages['keyword']['unique'],

            'short_code.required' => $messages['short_code']['required'],
            'short_code.unique' => $messages['short_code']['unique'],
        ];
    }
}
