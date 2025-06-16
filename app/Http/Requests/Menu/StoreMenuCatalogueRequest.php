<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuCatalogueRequest extends FormRequest
{
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
            'keyword' => 'required|unique:menu_catalogues',
        ];
    }

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
