<?php

namespace App\Http\Requests\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'canonical' => "required|unique:routers,canonical,{$this->id},module_id",
            'attribute_catalogue_id' => 'required|not_in:0',
        ];
    }

    public function messages(): array
    {
        $messages = __('validation_update.model_catalogue_model');
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