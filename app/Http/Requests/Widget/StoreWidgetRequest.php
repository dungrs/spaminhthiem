<?php

namespace App\Http\Requests\Widget;

use Illuminate\Foundation\Http\FormRequest;

class StoreWidgetRequest extends FormRequest
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
            'keyword' => 'required|unique:widget_languages',
            'short_code' => 'required|unique:widgets',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, mixed>
     */
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
