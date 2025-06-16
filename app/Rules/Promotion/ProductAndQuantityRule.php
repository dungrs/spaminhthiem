<?php

namespace App\Rules\Promotion;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Lang;

class ProductAndQuantityRule implements Rule
{
    protected $data;
    protected $errorMessage;

    public function __construct($data)
    {
        $this->data = $data;
        $this->errorMessage = Lang::get('validation_create.promotion.product_and_quantity.invalid_configuration');
    }

    public function passes($attribute, $value)
    {
        // Uncomment if you need this validation
        /*
        if (empty($this->data['product_and_quantity']['quantity']) || 
            parseValue($this->data['product_and_quantity']['quantity']) <= 0) {
            $this->errorMessage = Lang::get('validation_create.promotion.product_and_quantity.invalid_quantity');
            return false;
        }
        */

        if (empty($this->data['product_and_quantity']['discountValue']) || 
            parseValue($this->data['product_and_quantity']['discountValue']) <= 0) {
            $this->errorMessage = Lang::get('validation_create.promotion.product_and_quantity.missing_discount_value');
            return false;
        }

        if (empty($this->data['object']['name'])) {
            $this->errorMessage = Lang::get('validation_create.promotion.product_and_quantity.missing_target_object');
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->errorMessage;
    }
}