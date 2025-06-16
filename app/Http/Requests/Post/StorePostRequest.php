<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'post_catalogue_id' => 'required|not_in:0',
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
