<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class TranslateRequest extends FormRequest
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
            'name_trans' => 'required',
            'canonical_trans' => [
                'required',
                function ($attribute, $value, $fail) {
                    $option = $this->input('option');

                    $exist = DB::table('routers')
                        ->where('canonical', $value)
                        ->where('module_id', '<>', $option['id'])
                        ->where('language_id', '<>', $option['language_id'])
                        ->exists();

                    if ($exist) {
                        $fail('Đường dẫn đã tồn tại. Hãy chọn đường dẫn khác!');
                    }
                }
            ]

        ];
    }

    public function messages()
    {
        $translationMessages = __('validation_create.translate');
    
        return [
            'name_trans.required' => $translationMessages['name']['required'],
            'canonical_trans.required' => $translationMessages['canonical']['required'],
            'canonical_trans.unique' => $translationMessages['canonical']['unique'],
        ];
    }
    
}
