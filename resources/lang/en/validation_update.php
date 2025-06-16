<?php 

return [
    'user' => [
        'email' => [
            'required' => 'Please enter an email.',
            'email' => 'Invalid email format. Example: abc@gmail.com.',
            'unique' => 'This email is already in use. Please choose another email.',
            'string' => 'Email must be a valid string.',
            'max' => 'Email cannot exceed 250 characters.',
        ],
        'name' => [
            'required' => 'Please enter your full name.',
            'string' => 'Full name must be a valid string.',
        ],
        'user_catalogue_id' => [
            'required' => 'Please select a member group.',
            'integer' => 'Invalid member group.',
            'gt' => 'Please select a valid member group.',
        ],
        'birthday' => [
            'required' => 'Please enter your date of birth.',
            'date_format' => 'Date of birth is not in the correct format. Please enter in dd/mm/yyyy format.',
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
            'required' => 'Member group name cannot be empty.',
            'string' => 'Member group name must be a string.',
            'max' => 'Member group name cannot exceed 255 characters.',
        ],
        'email' => [
            'required' => 'Email cannot be empty.',
            'email' => 'Entered email is in an incorrect format.',
            'unique' => 'This email is already in use. Please choose another email.',
            'max' => 'Email cannot exceed 250 characters.',
        ],
        'phone' => [
            'required' => 'Phone number cannot be empty.',
            'string' => 'Phone number must be a string.',
            'max' => 'Phone number cannot exceed 20 characters.',
        ],
        'description' => [
            'string' => 'Description must be a string.',
            'max' => 'Description cannot exceed 500 characters.',
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
];