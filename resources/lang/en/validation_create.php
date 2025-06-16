<?php

return [
    'source' => [
        'name' => [
            'required' => 'You have not entered the customer source name',
        ],
        'keyword' => [
            'required' => 'You have not entered the customer source keyword',
            'unique' => 'The keyword already exists, please choose another one',
        ],
    ],
    'user' => [
        'email' => [
            'required' => 'Please enter an email address.',
            'email' => 'Invalid email format. Example: abc@gmail.com.',
            'unique' => 'This email is already in use. Please choose another email.',
            'string' => 'Email must be a valid string.',
            'max' => 'Email must not exceed 250 characters.',
        ],
        'name' => [
            'required' => 'Please enter your full name.',
            'string' => 'Full name must be a valid string.',
        ],
        'user_catalogue_id' => [
            'gt' => 'Please select a valid user group.',
            'required' => 'Please select a valid user group.',
        ],
        'birthday' => [
            'required' => 'Please enter your date of birth.',
            'date_format' => 'Invalid date format. Please enter in the format dd/mm/yyyy.',
        ],
        'password' => [
            'required' => 'Please enter a password.',
            'min' => 'Password must be at least 6 characters.',
        ],
        're_password' => [
            'required' => 'Please re-enter your password.',
            'same' => 'The re-entered password does not match.',
        ],
    ],
    'user_catalogue' => [
        'name' => [
            'required' => 'User group name cannot be empty.',
            'string' => 'User group name must be a string.',
            'max' => 'User group name must not exceed 255 characters.',
        ],
        'email' => [
            'required' => 'Email cannot be empty.',
            'email' => 'Invalid email format.',
            'max' => 'Email must not exceed 250 characters.',
            'unique' => 'This email is already in use. Please choose another email.',
        ],
        'phone' => [
            'required' => 'Phone number cannot be empty.',
            'string' => 'Phone number must be a string.',
            'max' => 'Phone number must not exceed 20 characters.',
        ],
        'description' => [
            'string' => 'Description must be a string.',
            'max' => 'Description must not exceed 500 characters.',
        ],
    ],
    'model_catalogue_model' => [
        'name' => [
            'required' => 'You have not entered a title.',
        ],
        'canonical' => [
            'required' => 'You have not entered a URL.',
            'unique' => 'This URL already exists, please choose another one.',
        ],
    ],
    'language' => [
        'name' => [
            'required' => 'You have not entered the language name.',
        ],
        'canonical' => [
            'required' => 'You have not entered the language keyword.',
            'unique' => 'The keyword already exists, please choose another one.',
        ],
    ],
    'translate' => [
        'name' => [
            'required' => 'You have not entered the title name.',
        ],
        'canonical' => [
            'required' => 'You have not entered the keyword.',
            'unique' => 'The keyword already exists, please choose another one.',
        ],
    ],
    'product' => [
        'product_catalogue_id' => [
            'required' => 'Please select a product category.',
            'not_in' => 'Invalid product category.',
        ],
        'attribute' => [
            'array' => 'Invalid product attribute data.',
            'min_empty' => 'Please select at least one product attribute.',
            'missing' => 'Please select at least one product attribute.',
        ],
    ],
    'post' => [
        'post_catalogue_id' => [
            'required' => 'Please select a post category.',
            'not_in' => 'Invalid post category.',
        ],
    ],
    'attribute' => [
        'attribute_catalogue_id' => [
            'required' => 'Please select an attribute category.',
            'not_in' => 'Invalid attribute category.',
        ],
    ],
    'menu_catalogue' => [
        'name' => [
            'required' => 'You have not entered the menu group name.',
        ],
        'keyword' => [
            'required' => 'You have not entered the menu keyword.',
            'unique' => 'The menu group already exists.',
        ],
    ],
    'menu' => [
        'menu_catalogue_id' => [
            'required' => 'You must select a menu category.',
            'integer' => 'Menu category ID must be an integer.',
            'min' => 'Menu category ID must be greater than or equal to 1.',
        ],
        'name' => [
            'required' => 'You must enter at least one menu name.',
            'array' => 'The list of menu names must be an array.',
            'min' => 'There must be at least one menu name.',
        ],
        'name.*' => [
            'required' => 'Menu name cannot be empty.',
            'string' => 'Menu name must be a string.',
            'max' => 'Menu name cannot exceed 255 characters.',
        ],
        'canonical' => [
            'required' => 'You must enter at least one canonical URL.',
            'array' => 'The list of canonical URLs must be an array.',
            'min' => 'There must be at least one canonical URL.',
        ],
        'canonical.*' => [
            'required' => 'Canonical URL cannot be empty.',
            'string' => 'Canonical URL must be a string.',
            'max' => 'Canonical URL cannot exceed 255 characters.',
            'unique' => 'Canonical URL already exists in the system.',
        ],
        'order' => [
            'required' => 'You must enter at least one display order.',
            'array' => 'The list of orders must be an array.',
            'min' => 'There must be at least one order value.',
        ],
        'order.*' => [
            'required' => 'You must enter an order value.',
            'integer' => 'Order value must be an integer.',
            'min' => 'Order value must be greater than or equal to 0.',
        ],
        'id' => [
            'array' => 'Menu IDs must be an array.',
        ],
        'id.*' => [
            'integer' => 'Each menu ID must be an integer.',
            'min' => 'Invalid ID, must be greater than or equal to 0.',
        ],
    ],
    'slide' => [
        'name' => [
            'required' => 'You have not entered the slide name',
        ],
        'keyword' => [
            'required' => 'You have not entered the slide keyword',
            'unique' => 'Keyword already exists. Please choose a different keyword',
        ],
        'image' => [
            'required' => 'You have not selected any image for the slide',
        ],
    ],
    'widget' => [
        'name' => [
            'required' => 'Please enter the widget name.',
        ],
        'keyword' => [
            'required' => 'Please enter the widget keyword.',
            'unique' => 'The widget keyword already exists.',
        ],
        'short_code' => [
            'required' => 'Please enter the shortcode.',
            'unique' => 'The shortcode already exists.',
        ],
    ],
    'promotion' => [
        'name' => [
            'required' => 'Please enter the promotion name',
        ],
        'code' => [
            'required' => 'Please enter the promotion keyword',
        ],
        'start_date' => [
            'required' => 'Please enter the promotion start date',
            'custom_date_format' => 'Invalid promotion start date format',
            'custom_after_now' => 'Promotion start date must be equal to or later than current time',
        ],
        'method' => [
            'required' => 'Please select a promotion method',
            'in' => 'Invalid promotion method',
        ],
        'end_date' => [
            'required' => 'Please select the promotion end date',
            'custom_date_format' => 'Invalid promotion end date format',
            'custom_after' => 'Promotion end date must be later than the start date',
        ],
        'order_amount_range' => [
            'empty_configuration' => 'Please initialize values for the promotion range',
            'invalid_discount_value' => 'Invalid promotion value configuration',
            'range_conflict' => 'There are conflicts between promotion value ranges! Please check your data',
        ],
        'product_and_quantity' => [
            'invalid_configuration' => 'Invalid promotion configuration',
            'missing_discount_value' => 'Please enter the discount value',
            'missing_target_object' => 'Please select the target object for discount application',
            // Uncomment if you need this validation
            // 'invalid_quantity' => 'Please enter the minimum purchase quantity to receive discount'
        ],
    ],
    'cart' => [
        'fullname' => [
            'required' => 'Full name is required.',
        ],
        'phone' => [
            'required' => 'Phone number is required.',
        ],
        'email' => [
            'required' => 'Email is required.',
            'email' => 'Invalid email format. Example: abc@gmail.com',
        ],
        'address' => [
            'required' => 'Address is required.',
        ],
    ],
];