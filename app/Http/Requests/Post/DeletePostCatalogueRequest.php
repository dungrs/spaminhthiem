<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckPostCatalogueChildrenRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class DeletePostCatalogueRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có quyền thực hiện yêu cầu này không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Thêm logic kiểm tra danh mục con trong withValidator.
     *
     * @param Validator $validator
     */
    public function withValidator($validator)
    {
        $id = $this->route('id');

        $validator->after(function ($validator) use ($id) {
            if ((new CheckPostCatalogueChildrenRule($id))->passes('id', $id)) {
                $validator->errors()->add('id', __('messages.cannot_delete_category'));
            }
        });
    }

    /**
     * Xử lý lỗi nếu validation thất bại.
     *
     * @param  Validator  $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator);
    }
}
