<?php

return [
    'homepage' => [
        'label' => 'General Information',
        'description' => 'Configure basic website information such as company name, brand, logo, favicon, etc.',
        'value' => [
            'company' => [
                'label' => 'Company Name',
                'placeholder' => 'Enter the company name...',
            ],
            'brand' => [
                'label' => 'Brand Name',
                'placeholder' => 'Enter the brand name...',
            ],
            'slogan' => [
                'label' => 'Slogan',
                'placeholder' => 'Enter the company slogan...',
            ],
            'logo' => [
                'label' => 'Website Logo',
                'placeholder' => 'Click below to upload the website logo',
            ],
            'favicon' => [
                'label' => 'Favicon',
                'placeholder' => 'Click below to upload the favicon (displayed in the browser tab)',
            ],
            'short_info' => [
                'label' => 'Short Introduction',
                'placeholder' => 'Enter a short introduction about the company or website...',
            ],
        ],
    ],

    'contact' => [
        'label' => 'Contact Information',
        'description' => 'Configure the full contact information of the website including company address, office, phone numbers, email, map, etc.',
        'value' => [
            'office' => [
                'label' => 'Company Address',
                'placeholder' => 'Enter the main company address...',
            ],
            'address' => [
                'label' => 'Office Address',
                'placeholder' => 'Enter the office address...',
            ],
            'hotline' => [
                'label' => 'General Hotline',
                'placeholder' => 'Enter the main hotline number...',
            ],
            'technical_phone' => [
                'label' => 'Technical Hotline',
                'placeholder' => 'Enter the technical support number...',
            ],
            'sell_phone' => [
                'label' => 'Sales Hotline',
                'placeholder' => 'Enter the sales support number...',
            ],
            'phone' => [
                'label' => 'Landline Phone',
                'placeholder' => 'Enter the landline phone number...',
            ],
            'fax' => [
                'label' => 'Tax Code',
                'placeholder' => 'Enter the company tax code...',
            ],
            'email' => [
                'label' => 'Contact Email',
                'placeholder' => 'Enter the contact email address...',
            ],
            'website' => [
                'label' => 'Website',
                'placeholder' => 'Enter the official website URL...',
            ],
            'map' => [
                'label' => 'Map',
                'placeholder' => 'Embed Google Maps iframe code...',
            ],
            'map_link_text' => 'How to set up the map',
        ],
    ],

    'seo' => [
        'label' => 'SEO Configuration for Homepage',
        'description' => 'Configure SEO details for the homepage including title, keywords, description, and meta image.',
        'value' => [
            'meta_title' => [
                'label' => 'SEO Title',
                'placeholder' => 'Enter the SEO title for the homepage...',
            ],
            'meta_keyword' => [
                'label' => 'SEO Keywords',
                'placeholder' => 'Enter keywords related to the homepage...',
            ],
            'meta_description' => [
                'label' => 'SEO Description',
                'placeholder' => 'Enter a short description for the homepage...',
            ],
            'meta_image' => [
                'label' => 'Meta Image',
                'placeholder' => 'Choose an image to display when sharing the homepage...',
            ],
        ],
    ],

    'socical' => [
        'label' => 'Social Media Configuration for Homepage',
        'description' => 'Set up social media links to be displayed on the homepage such as Facebook, YouTube, Twitter, etc.',
        'value' => [
            'facebook' => [
                'label' => 'Facebook',
                'placeholder' => 'Enter the URL of your Facebook page...',
            ],
            'youtube' => [
                'label' => 'YouTube',
                'placeholder' => 'Enter the URL of your YouTube channel...',
            ],
            'twitter' => [
                'label' => 'Twitter',
                'placeholder' => 'Enter the URL of your Twitter page...',
            ],
            'tiktok' => [
                'label' => 'TikTok',
                'placeholder' => 'Enter the URL of your TikTok account...',
            ],
            'instagram' => [
                'label' => 'Instagram',
                'placeholder' => 'Enter the URL of your Instagram page...',
            ],
        ],
    ],
];