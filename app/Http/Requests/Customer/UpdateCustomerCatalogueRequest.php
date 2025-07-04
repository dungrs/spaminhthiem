<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerCatalogueRequest extends FormRequest
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
            'name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        $validateMessages = __('validation_update.user_catalogue');

        return [
            'name.required' => $validateMessages['name']['required'],
            'name.string' => $validateMessages['name']['string'],
            'name.max' => $validateMessages['name']['max'],
        ];
    }
}
