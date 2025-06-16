<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartRequest extends FormRequest
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
            'fullname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => "Bạn chưa nhập vào Họ Tên.",
            'phone.required' => "Bạn chưa nhập vào Số điện thoại.",
            'address.required' => "Bạn chưa nhập vào địa chỉ.",
            'email.required' => "Bạn chưa nhập vào email.",
            'email.email' => "Email chưa đúng định dạng. Ví dụ: abc@gmail.com",
        ];
    }
}

// namespace App\Http\Requests\Cart;

// use Illuminate\Foundation\Http\FormRequest;

// class StoreCartRequest extends FormRequest
// {
//     /**
//      * Determine if the user is authorized to make this request.
//      *
//      * @return bool
//      */
//     public function authorize()
//     {
//         return true;
//     }

//     /**
//      * Get the validation rules that apply to the request.
//      *
//      * @return array<string, mixed>
//      */
//     public function rules()
//     {
//         return [
//             'fullname' => 'required',
//             'phone' => 'required',
//             'email' => 'required|email',
//             'address' => 'required',
//         ];
//     }

//     /**
//      * Get custom validation messages.
//      *
//      * @return array<string, mixed>
//      */
//     public function messages()
//     {
//         $messages = __('validation_create.cart');

//         return [
//             'fullname.required' => $messages['fullname']['required'],
//             'phone.required' => $messages['phone']['required'],
//             'email.required' => $messages['email']['required'],
//             'email.email' => $messages['email']['email'],
//             'address.required' => $messages['address']['required'],
//         ];
//     }
// }