<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'product_catalogue_id' => 'required|not_in:0',
            'attribute' => 'array|min:1',
        ];
    }

    public function messages()
    {
        $messages = __('validation_create.model_catalogue_model');
        $messageProducts = __('validation_create.product');

        return [
            'name.required' => $messages['name']['required'],
            'canonical.required' => $messages['canonical']['required'],
            'canonical.unique' => $messages['canonical']['unique'],
            'product_catalogue_id.required' => $messageProducts['product_catalogue_id']['required'],
            'product_catalogue_id.not_in' => $messageProducts['product_catalogue_id']['not_in'],
            'attribute.array' => $messageProducts['attribute']['array'],
            'attribute.min' => $messageProducts['attribute']['min_empty'],
        ];
    }

    /**
     * Kiểm tra nâng cao sau khi các rule mặc định đã được áp dụng.
     */
    public function withValidator($validator)
    {   
        $validator->after(function ($validator) {
            $messageProducts = __('validation_create.product');
            $attributes = $this->input('attribute');

            if ($attributes === null) {
                $validator->errors()->add('attribute', $messageProducts['attribute']['min_empty']);
                return;
            }

            if (is_array($attributes)) {
                $hasValue = false;
                foreach ($attributes as $values) {
                    if (!empty($values)) {
                        $hasValue = true;
                        break;
                    }
                }

                if (!$hasValue) {
                    $validator->errors()->add('attribute', $messageProducts['attribute']['min_empty']);
                }
            }
        });
    }
}