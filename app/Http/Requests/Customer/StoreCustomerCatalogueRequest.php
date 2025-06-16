<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerCatalogueRequest extends FormRequest
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
        $rules = [];

        if ($this->has('name')) {
            $rules['name'] = 'required|string|max:255';
        }
        return $rules;
    }

    public function messages() 
    {
        $validateMessages = __('validation_create.user_catalogue');

        return [
            'name.required' => $validateMessages['name']['required'],
            'name.string' => $validateMessages['name']['string'],
            'name.max' => $validateMessages['name']['max'],
        ];
    }
}
