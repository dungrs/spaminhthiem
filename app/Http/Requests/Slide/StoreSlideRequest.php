<?php

namespace App\Http\Requests\Slide;

use Illuminate\Foundation\Http\FormRequest;

class StoreSlideRequest extends FormRequest
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
    // Để lấy các quy tắc xác thực
    public function rules()
    {
        return [
            'name' => 'required',
            'keyword' => 'required|unique:slides',
            'slide.image' => 'required'
        ];
    }

    public function messages()
    {   
        $messages = __('validation_create.slide');
        return [
            'name.required' => $messages['name']['required'],
            'keyword.required' => $messages['keyword']['required'],
            'keyword.unique' => $messages['keyword']['unique'],
            'slide.image.required' => $messages['image']['required']
        ];
    }
}