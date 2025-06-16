<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // Xác định người dùng được phép thực hiện yêu cầu này hay không
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
            'canonical' => 'required|unique:languages,canonical,' . $this->id .'',
        ];
    }

    public function messages()
    {   
        $validateMessages = __('validation_update.language');

        return [
            'name.required' => $validateMessages['name']['required'],
            'canonical.required' => $validateMessages['canonical']['required'],
            'canonical.unique' => $validateMessages['canonical']['unique'],
        ];
    }
}
