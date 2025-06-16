<?php

namespace App\Rules\Promotion;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

class OrderAmountRangeRule implements Rule
{
    protected $data;
    protected $errorMessage;

    public function __construct($data)
    {
        $this->data = $data;
        $this->errorMessage = Lang::get('validation_create.promotion.generic_error');
    }

    public function passes($attribute, $value)
    {
        if (
            !isset($this->data['amountFrom']) ||
            !isset($this->data['amountTo']) ||
            !isset($this->data['amountValue']) ||
            count($this->data['amountFrom']) == 0 ||
            $this->data['amountFrom'][0] == ''
        ) {
            $this->errorMessage = Lang::get('validation_create.promotion.order_amount_range.empty_configuration');
            return false;
        }

        if (in_array(0, $this->data['amountValue']) || in_array('', $this->data['amountValue'])) {
            $this->errorMessage = Lang::get('validation_create.promotion.order_amount_range.invalid_discount_value');
            return false;
        }

        for ($i = 0; $i < count($this->data['amountFrom']); $i++) {
            $amount_from_1 = parseValue($this->data['amountFrom'][$i]);
            $amount_to_1 = parseValue($this->data['amountTo'][$i]);

            for ($j = $i + 1; $j < count($this->data['amountTo']); $j++) {
                $amount_from_2 = parseValue($this->data['amountFrom'][$j]);
                $amount_to_2 = parseValue($this->data['amountTo'][$j]);

                if ($amount_from_1 <= $amount_to_2 && $amount_to_1 >= $amount_from_2) {
                    $this->errorMessage = Lang::get('validation_create.promotion.order_amount_range.range_conflict');
                    return false;
                }
            }
        }

        return true;
    }

    public function message()
    {
        return $this->errorMessage;
    }
}