<?php

namespace App\Http\Requests\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
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
            'canonical' => 'required|unique:routers',
            'attribute_catalogue_id' => 'required|not_in:0',
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        $messages = __('validation_create.model_catalogue_model');
        $messageAttributes = __('validation_create.attribute');

        return [
            'name.required' => $messages['name']['required'],

            'canonical.required' => $messages['canonical']['required'],
            'canonical.unique' => $messages['canonical']['unique'],
            
            'attribute_catalogue_id.required' => $messageAttributes['attribute_catalogue_id']['required'],
            'attribute_catalogue_id.not_in' => $messageAttributes['attribute_catalogue_id']['not_in'],
        ];
    }
}
