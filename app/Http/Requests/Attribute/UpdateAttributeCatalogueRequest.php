<?php

namespace App\Http\Requests\Attribute;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeCatalogueRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        $messages = __('validation_update.model_catalogue_model');

        return [
            'name.required' => $messages['name']['required'],

            'canonical.required' => $messages['canonical']['required'],
            'canonical.unique' => $messages['canonical']['unique'],
        ];
    }
}
