<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'post_catalogue_id' => 'required|not_in:0',

        ];
    }

    public function messages(): array
    {
        $messages = __('validation_update.model_catalogue_model');
        $messagePosts = __('validation_create.post');

        return [
            'name.required' => $messages['name']['required'],

            'canonical.required' => $messages['canonical']['required'],
            'canonical.unique' => $messages['canonical']['unique'],

            'post_catalogue_id.required' => $messagePosts['post_catalogue_id']['required'],
            'post_catalogue_id.not_in' => $messagePosts['post_catalogue_id']['not_in'],
        ];
    }
}