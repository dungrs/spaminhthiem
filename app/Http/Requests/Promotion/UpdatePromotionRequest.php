<?php

namespace App\Http\Requests\Promotion;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Promotion\OrderAmountRangeRule;
use App\Rules\Promotion\ProductAndQuantityRule;
use App\Classes\PromotionEnum;

class UpdatePromotionRequest extends FormRequest
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
        $rules = [
            'name' => 'required',
            'code' => 'required|unique:promotions,code,' . $this->id,
            'start_date' => 'required|custom_date_format|custom_after_now',
            'method' => 'required|in:' . implode(',', array_keys(__('module.promotion')))
        ];

        if (!$this->input('never_end_date')) {
            $rules['end_date'] = 'required|custom_date_format|custom_after:start_date';
        }

        $method = $this->input('method');
        switch ($method) {
            case PromotionEnum::ORDER_AMOUNT_RANGE:
                $rules['method'] = [new OrderAmountRangeRule($this->input('promotion_order_amount_range'))];
                break;
            case PromotionEnum::PRODUCT_AND_QUANTITY;
                $rules['method'] = [new ProductAndQuantityRule($this->only('product_and_quantity', 'object'))];
                break;
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'name.required' => __('validation_create.promotion.name.required'),
            'code.required' => __('validation_create.promotion.code.required'),
            'start_date.required' => __('validation_create.promotion.start_date.required'),
            'start_date.custom_date_format' => __('validation_create.promotion.start_date.custom_date_format'),
            'start_date.custom_after_now' => __('validation_create.promotion.start_date.custom_after_now'),
            'method.required' => __('validation_create.promotion.method.required'),
            'method.in' => __('validation_create.promotion.method.in'),
        ];
    
        if (!$this->input('never_end_date')) {
            $messages['end_date.required'] = __('validation_create.promotion.end_date.required');
            $messages['end_date.custom_date_format'] = __('validation_create.promotion.end_date.custom_date_format');
            $messages['end_date.custom_after'] = __('validation_create.promotion.end_date.custom_after');
        }
    
        return $messages;
    }
}
