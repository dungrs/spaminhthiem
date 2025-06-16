<?php 

return [
    'stats' => [
        'monthly_orders' => 'Monthly Orders',
        'total_orders' => 'Total Orders',
        'monthly_revenue' => 'Monthly Revenue',
        'total_customers' => 'Total Customers',
        'new_customers' => 'New Customers', 
        'conversion_rate' => 'Conversion Rate'
    ],
    'dashboard' => [
        'index' => [
            'title' => "System Overview",
        ],
        'chart' => [
            'revenue_chart' => 'Revenue Chart',
            'sort_by' => 'Sort by:',
            'sort_options' => [
                'year' => 'By Year',
                'month' => 'By Month',
                '30_days' => 'Last 30 Days',
                '7_days' => 'Last 7 Days'
            ],
            'order_stats' => 'Order Statistics',
            'order_status' => [
                'completed' => 'Completed Orders',
                'processing' => 'Processing Orders',
                'canceled' => 'Canceled Orders'
            ],
            'change_labels' => [
                'increase' => 'Increase :value%',
                'decrease' => 'Decrease :value%'
            ]
        ],
        'sale_best_product' => [
            'productItem' => [
                'no_reviews' => 'No reviews yet',
                'reviews_count' => ':count reviews',
                'view_details' => 'View details',
                'sold_progress' => 'Sold :sold/:total',
                'discount_badge' => '-:value:type'
            ],
            'sales_by_social_source' => [
                'title' => 'Sales by Social Source',
                'time_periods' => [
                    'monthly' => 'Monthly',
                    'yearly' => 'Yearly',
                    'weekly' => 'Weekly',
                    'today' => 'Today'
                ],
                'platforms' => [
                    'facebook' => [
                        'name' => 'Facebook Ads',
                        'category' => 'Footwear',
                        'orders' => 'Orders',
                        'likes' => 'Likes'
                    ],
                    'twitter' => [
                        'name' => 'Twitter Ads',
                        'category' => 'T-shirts'
                    ],
                    'linkedin' => [
                        'name' => 'LinkedIn Ads',
                        'category' => 'Watches'
                    ],
                    'youtube' => [
                        'name' => 'YouTube Ads',
                        'category' => 'Chairs'
                    ],
                    'instagram' => [
                        'name' => 'Instagram Ads',
                        'category' => 'Chairs'
                    ]
                ],
                'metrics' => [
                    'orders' => ':count Orders',
                    'likes' => ':countk Likes',
                    'revenue' => ':amountđ',
                    'growth' => [
                        'positive' => ':percent% Increase',
                        'negative' => ':percent% Decrease'
                    ]
                ]
            ],
            'best_selling_products' => [
                'title' => 'Best Selling Products'
            ],
            'navigation' => [
                'next' => 'Next',
                'prev' => 'Previous'
            ]
        ],

        'sales_recent_orders' => [
            'sales_revenue' => [
                'title' => 'Sales Revenue',
                'year_selection' => [
                    'label' => 'Year:',
                    'placeholder' => '2022',
                    'options' => [
                        '2019' => '2019',
                        '2020' => '2020',
                        '2021' => '2021'
                    ]
                ]
            ],
            
            'recent_orders' => [
                'title' => 'Recent Orders',
                'table' => [
                    'headers' => [
                        'order_code' => 'Order Code',
                        'customer' => 'Customer',
                        'price' => 'Price',
                        'payment_status' => 'Payment Status',
                        'confirmation' => 'Confirmation',
                        'actions' => 'Actions'
                    ],
                    'customer_col_width' => '210px'
                ]
            ]
        ]
    ],
    'source' => [
        'index' => [
            'title' => "Customer Source Management",
            'table' => [
                'title' => "List of Customer Sources",
                'table_header' => [
                    'name' => 'Source Name',
                    'description' => 'Description',
                    'keyword' => 'Keyword',
                ],
                'add_button' => "Add Customer Source",
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Add New Customer Source',
                'edit' => 'Edit Customer Source'
            ],
            'name' => 'Source Name',
            'keyword' => 'Keyword',
            'description' => 'Short Description',
            'name_placeholder' => 'Enter customer source name...',
            'keyword_placeholder' => 'Enter keyword...',
            'description_placeholder' => 'Enter a short description...',
        ]
    ],
    'user_catalogue' => [
        'index' => [
            'title' => "Manage Member Groups",
            'table' => [
                'title' => "Member Group List",
                'table_header' => [
                    'name' => 'Name Group',
                    'description' => 'Description',
                    'email' => 'Email',
                    'phone' => 'Phone Number',
                    'user_count' => 'Member Count',
                ],
                'add_button' => "Add New Member Group",
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Add a new member group',
                'edit' => 'Edit member group',
                'translate' => 'Translate member group into another language'
            ],
            'create' => [
                'title' => 'Add a new member group'
            ],
            'edit' => [
                'title' => 'Edit member group'
            ],
            'translate' => [
                'title' => 'Translate member group into another language'
            ],
            'name' => 'Member Group Name',
            'phone' => 'Phone Number',
            'email' => 'Email',
            'description' => 'Short Description',
            'language' => 'Select display language',
            'name_placeholder' => 'Enter member group name...',
            'phone_placeholder' => 'Enter phone number...',
            'email_placeholder' => 'Enter email...',
            'description_placeholder' => 'Enter description...',
        ],
        'notifications' => [
            'delete_error_users_exist' => "Cannot delete the member group because there are users using this group. Please delete the members first before deleting the group!",
        ]
    ],
    'user' => [
        'index' => [
            'title' => "Manage Members",
            'table' => [
                'title' => "Member List",
                'table_header' => [
                    'name' => 'Full Name',
                    'contact' => 'Phone Number / Email',
                    'address' => 'Address',
                    'group' => 'Member Group',
                ],
                'add_button' => "Add New Member",
                'filter_user' => "Select Member Group"
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Add a new member',
                'edit' => 'Edit member',
            ],
            'common_info' => 'General Information',
            'name' => 'Full Name',
            'name_placeholder' => 'Enter full name...',
            'email' => 'Email',
            'email_placeholder' => 'Enter your email...',
            'group' => 'Member Group',
            'group_placeholder' => 'Select Member Group...',
            'birthday' => 'Birthday',
            'birthday_placeholder' => 'Select birthdate (dd/mm/yyyy)...',
            'avatar' => 'Avatar',
            'avatar_placeholder' => 'Enter URL or select an image...',
            'contact_info' => 'Contact Information',
            'city' => 'City',
            'district' => 'District/County',
            'ward' => 'Ward/Commune',
            'address' => 'Address',
            'address_placeholder' => 'Enter address (if any)...',
            'phone' => 'Phone Number',
            'phone_placeholder' => 'Enter contact phone number...',
            'note' => 'Note',
            'note_placeholder' => 'Enter note (if any)...',
            'password' => [
                'label' => 'Password',
                'placeholder' => 'Enter password...',
                'confirm_label' => 'Confirm password',
                'confirm_placeholder' => 'Confirm password...',
            ],
        ]
    ],
    'customer_catalogue' => [
        'index' => [
            'title' => "Customer Group Management",
            'table' => [
                'title' => "Customer Group List",
                'table_header' => [
                    'name' => 'Group Name',
                    'description' => 'Description',
                    'customer_count' => 'Member Count',
                ],
                'add_button' => "Add New Customer Group",
            ],
        ],
        'permission' => [
            'title' => "Permission Management",
            'table' => [
                'title' => "Permission List",
                'table_header' => [
                    'name' => 'Permission Name',
                ],
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Add New Customer Group',
                'edit' => 'Edit Customer Group',
            ],
            'name' => 'Customer Group Name',
            'phone' => 'Phone Number',
            'email' => 'Email',
            'description' => 'Short Description',
            'language' => 'Select Display Language',
            'name_placeholder' => 'Enter customer group name...',
            'phone_placeholder' => 'Enter phone number...',
            'email_placeholder' => 'Enter email address...',
            'description_placeholder' => 'Enter description...',
        ],
        'notifications' => [
            'delete_error_customers_exist' => "Cannot delete customer group because there are still customers in this group. Please delete the customers first!",
        ]
    ],
    'customer' => [
        'index' => [
            'title' => "Customer Management",
            'table' => [
                'title' => "Customer List",
                'table_header' => [
                    'name' => 'Full Name',
                    'contact' => 'Phone / Email',
                    'address' => 'Address',
                    'group' => 'Customer Group',
                ],
                'add_button' => "Add New Customer",
                'filter_customer' => "Filter by Customer Group"
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Add New Customer',
                'edit' => 'Edit Customer Information',
            ],
            'common_info' => 'General Information',
            'name' => 'Full Name',
            'name_placeholder' => 'Enter full name...',
            'email' => 'Email',
            'email_placeholder' => 'Enter email address...',
            'group' => 'Customer Group',
            'group_placeholder' => 'Select customer group...',
            'birthday' => 'Date of Birth',
            'birthday_placeholder' => 'Select birth date (dd/mm/yyyy)...',
            'avatar' => 'Profile Image',
            'avatar_placeholder' => 'Enter image URL or select from device...',
            'contact_info' => 'Contact Information',
            'city' => 'Province/City',
            'district' => 'District',
            'ward' => 'Ward/Commune',
            'address' => 'Address',
            'address_placeholder' => 'Enter address (if any)...',
            'phone' => 'Phone Number',
            'phone_placeholder' => 'Enter contact number...',
            'note' => 'Note',
            'note_placeholder' => 'Enter notes (if any)...',
            'password' => [
                'label' => 'Password',
                'placeholder' => 'Enter password...',
                'confirm_label' => 'Confirm Password',
                'confirm_placeholder' => 'Re-enter password...',
            ],
        ]
    ],
    'permission' => [
        'index' => [
            'title' => "Permission Management",
            'table' => [
                'title' => "Permission List",
                'table_header' => [
                    'name' => 'Permission',
                    'canonical' => 'Canonical Identifier'
                ],
                'add_button' => "Add New Permission",
            ],
        ],
        'modal' => [
            'title' => [
                'create' => 'Add New Permission',
                'edit' => 'Edit Permission',
            ],
            'name' => 'Permission Name',
            'name_placeholder' => 'Enter permission name...',
            'canonical' => 'Canonical Identifier',
            'canonical_placeholder' => 'Enter canonical identifier...',
        ]
    ],
    'post_catalogue' => [
        'index' => [
            'title' => "Manage Post Groups",
            'table' => [
                'title' => "Post Group List",
                'add_button' => "Add New Post Group",
            ],
        ],
        'create' => [
            'title' => "Add New Post Group",
        ],
        'edit' => [
            'title' => "Update Post Group",
        ],
        'notifications' => [

        ]
    ],
    'post' => [
        'index' => [
            'title' => "Manage Posts",
            'table' => [
                'title' => "Post List",
                'add_button' => "Add New Post",
            ],
        ],
        'create' => [
            'title' => "Create New Post",
        ],
        'edit' => [
            'title' => "Update Post",
        ],
        'notifications' => [
            
        ]
    ],
    'product_catalogue' => [
        'index' => [
            'title' => "Manage Product Groups",
            'table' => [
                'title' => "List of Product Groups",
                'add_button' => "Add New Product Group",
            ],
        ],
        'create' => [
            'title' => "Add New Product Group",
        ],
        'edit' => [
            'title' => "Update Product Group",
        ],
        'notifications' => [
            // ...
        ]
    ],
    'product' => [
        'index' => [
            'title' => "Manage Products",
            'table' => [
                'title' => "List of Products",
                'add_button' => "Add New Product",
            ],
        ],
        'create' => [
            'title' => "Add New Product",
        ],
        'edit' => [
            'title' => "Update Product",
        ],
        'notifications' => [
            // ...
        ],
        'step_4_title' => 'Product with multiple variants',
        'step_4_description' => 'Configure variants for the product',
        'step_5_title' => 'Variant list',
        'step_5_description' => 'Set up product variants',
        'has_variant_label' => 'This product has multiple variants, such as different colors or sizes.',
        'choose_attribute_group' => 'Select attribute group',
        'choose_attribute_value' => 'Select attribute value (Enter keyword to search)',
        'add_variant_button' => 'Add new variant',
        'product_variant_required' => 'You must enter Price and SKU to use this feature!',
        'input_attribute_value' => 'Enter attribute value',

        'stock_info' => 'Inventory Information',
        'quantity' => 'Stock Quantity',
        'enter_quantity' => 'Enter quantity...',
        'sku' => 'SKU Code',
        'enter_sku' => 'Enter SKU code...',
        'price' => 'Selling Price',
        'enter_price' => 'Enter selling price...',
        'barcode' => 'Barcode',
        'enter_barcode' => 'Enter barcode...',

        'file_management' => 'File Management',
        'file_name' => 'File Name',
        'enter_file_name' => 'Enter file name...',
        'file_url' => 'File URL',
        'enter_file_url' => 'Enter file URL...',
        'aside' => [
            'card' => [
                'title' => 'Product Information',
                'description' => 'Enter the product information below.',
            ],
            'form' => [
                'code' => [
                    'label' => 'Product Code',
                    'placeholder' => 'Enter product code',
                ],
                'made_in' => [
                    'label' => 'Origin',
                    'placeholder' => 'Enter product origin',
                ],
                'price' => [
                    'label' => 'Price',
                    'placeholder' => 'Enter product price',
                ],
            ],
        ],
    ],
    'attribute_catalogue' => [
        'index' => [
            'title' => "Manage Attribute Categories",
            'table' => [
                'title' => "List of Attribute Categories",
                'add_button' => "Add New Attribute Category",
            ],
        ],
        'create' => [
            'title' => "Add New Attribute Category",
        ],
        'edit' => [
            'title' => "Update Attribute Category",
        ],
        'notifications' => [

        ]
    ],
    'attribute' => [
        'index' => [
            'title' => "Manage Attributes",
            'table' => [
                'title' => "List of Attributes",
                'add_button' => "Add New Attribute",
            ],
        ],
        'create' => [
            'title' => "Add New Attribute",
        ],
        'edit' => [
            'title' => "Update Attribute",
        ],
        'notifications' => [

        ]
    ],
    'menu' => [
        'index' => [
            'title' => 'Menu Management',
            'table' => [
                'title' => 'List of Available Menus',
                'table_header' => [
                    'name' => 'Menu Name',
                    'canonical' => 'Canonical Path',
                ],
                'add_button' => 'Add New Menu',
            ],
        ],
        'create' => [
            'title' => 'Create New Menu',
        ],
        'children' => [
            'title' => 'Edit Submenu',
        ],
        'translate' => [
            'title' => 'Add Translation for Menu',
            'original_language' => 'Original Language',
            'save' => 'Save',
            'name' => 'Menu Name',
            'name_placeholder' => 'Enter menu name',
            'name_helper' => 'Displayed name on the interface',
            'link' => 'Link',
            'link_placeholder' => 'Enter link',
            'link_helper' => 'Static URL for the menu',
            'item' => 'Menu #:number',
        ],
        'edit' => [
            'title' => 'Edit Menu',
        ],
        'setup' => [
            'title' => 'Configure Categories',
            'description' => 'Select the area where you want the menu to appear on the website.',
        ],
        'custom_link' => [
            'title' => 'Custom Link',
            'tips' => [
                'title' => 'Set up the menu you want to display.',
                'items' => [
                    'path_working' => 'When creating a menu, ensure the path works.',
                    'path_modules' => 'Paths are generated in modules like: Posts, Products, Projects, etc.',
                    'required_fields' => '<strong>Title</strong> and <strong>path</strong> cannot be empty.',
                    'max_levels' => 'The system supports up to <strong>5 menu levels</strong>.',
                ],
            ],
            'add_button' => 'Add Link',
        ],
        'management' => [
            'title' => 'Menu Management',
            'columns' => [
                'name' => 'Menu Name',
                'path' => 'Path',
                'position' => 'Position',
                'actions' => 'Actions',
            ],
            'empty_state' => [
                'title' => 'No menus have been created yet',
                'description' => 'Please add menu links from the left sidebar',
            ],
            'name_placeholder' => 'Menu name (e.g., Home)',
            'canonical_placeholder' => 'Path (e.g., home)',
            'order_placeholder' => 'Display order (e.g., 1)',
        ],
        'module' => [
            'search_placeholder' => 'Enter characters to search...',
            'loading' => 'Loading data...',
            'buttons' => [
                'refresh' => 'Refresh',
                'apply' => 'Apply',
            ],
        ],
        'errors' => [
            'general' => 'An error occurred!',
            'validation' => ':count errors need to be fixed:',
        ],
        'position' => [
            'title' => 'Select Menu Display Position',
            'description' => 'Choose the area where you want the menu to appear on the website.',
            'label' => 'Display Position',
            'placeholder' => '-- Select display position --',
            'create_button' => 'Create Display Position',
        ],
        'modal' => [
            'title' => 'Add New Menu Display Position',
            'fields' => [
                'required_note' => 'Fields marked with <span class="text-danger">(*)</span> are required.',
                'position_name' => [
                    'label' => 'Display Position Name',
                    'placeholder' => 'e.g., Main Menu, Footer Menu...',
                ],
                'keyword' => [
                    'label' => 'Keyword',
                    'placeholder' => 'e.g., main-menu, footer-menu...',
                ],
            ],
            'buttons' => [
                'close' => 'Cancel',
                'submit' => 'Save',
            ],
            'icons' => [
                'close' => 'Close',
                'save' => 'Save',
                'required' => 'Required Field',
            ],
        ],
        'menu_management' => 'Menu Management',
        'quick_guide' => 'Quick Guide',
        'update_menu' => 'Update Menu',
        'update_menu_description' => 'Use the "Update Menu" button to edit level 1 menus',
        'sort_menu' => 'Sort Menu',
        'sort_menu_description' => 'Drag and drop to change the menu display order',
        'manage_submenu' => 'Manage Submenu',
        'manage_submenu_description' => 'Click "Manage Submenu" to add subcategories',
        'multi_level_menu' => 'Multi-level Menu',
        'multi_level_menu_description' => 'The system supports up to 5-level menus',
        'auto_translate' => 'Auto Translate',
        'update_level1_menu' => 'Update Level 1 Menu',
        'help' => 'Help',
    ],
    'language' => [
        'index' => [
            'title' => "Manage Languages",
            'table' => [
                'title' => "Language List",
                'table_header' => [
                    'image' => 'Avatar',
                    'name' => 'Language Name',
                    'description' => 'Description',
                    'canonical' => 'Canonical URL',
                ],
                'add_button' => "Add New Language",
            ],
        ],
        'translate' => [
            'title' => "Content Translation",
        ],
        'modal' => [
            'title' => [
                'create' => 'Add a new language',
                'edit' => 'Edit language',
            ],
            'name' => 'Language Name',
            'canonical' => 'Canonical URL',
            'description' => 'Short Description',
            'image' => 'Avatar',
            'name_placeholder' => 'Enter language name',
            'canonical_placeholder' => 'Enter canonical URL',
            'description_placeholder' => 'Enter short description',
            'image_placeholder' => 'Select avatar image',
        ]
    ],
    'system' => [
        'index' => [
            'title' => "System Configuration",
        ],
    ],
    'review' => [
        'index' => [
            'title' => "Review Management",
            'table' => [
                'title' => "Review List",
                'table_header' => [
                    'name' => 'Full Name',
                    'email' => 'Email',
                    'phone' => "Phone Number",
                    'description' => "Content",
                    'score' => "Rating",
                ],
            ],
        ],
    ],
    'notifications' => [
        'create_success' => "Successfully created!",
        'create_error' => "An error occurred while creating the data!",
        'update_success' => "Information updated successfully!",
        'update_error' => "An error occurred while updating the data!",
        'delete_success' => "Data deleted successfully!",
        'delete_error' => "An error occurred while deleting the data!",
        'not_found' => "Requested data not found.",
        'no_changes' => "No changes were made.",
        'translation_saved_successfully' => 'Translation saved successfully.',
        'error_saving_translation' => 'An error occurred while saving translation.',
    ],
    'slide' => [
        'index' => [
            'title' => "Banner & Slide Management",
            'table' => [
                'title' => "Banner & Slide List",
                'add_button' => "Add New Banner & Slide",
                'name' => 'Slide Name',
                'keyword' => 'Keyword'
            ],
        ],
        'create' => [
            'title' => "Create New Banner & Slide",
        ],
        'edit' => [
            'title' => "Update Banner & Slide",
        ],
        'basic_settings' => [
            'title' => 'Basic Settings',
            'description' => 'Configure basic parameters',
            'fields' => [
                'name' => [
                    'label' => 'Slide name',
                    'placeholder' => 'Enter slide name',
                    'help' => 'Display name of the slide',
                ],
                'keyword' => [
                    'label' => 'Keyword',
                    'placeholder' => 'Enter unique identifier',
                    'help' => 'Unique keyword to identify the slide',
                ],
                'dimensions' => [
                    'title' => 'Dimension Specifications',
                    'width' => 'Width',
                    'height' => 'Height',
                    'unit' => 'px',
                ],
                'animation' => [
                    'label' => 'Transition Effect',
                ],
                'navigation' => [
                    'arrows' => 'Show navigation buttons',
                    'type' => 'Navigation type',
                ],
            ],
        ],
        'advanced_settings' => [
            'title' => 'Advanced Settings',
            'description' => 'Configure advanced parameters',
            'autoplay' => [
                'label' => 'Autoplay',
                'help' => 'Slides will automatically transition when enabled',
            ],
            'pause_hover' => [
                'label' => 'Pause on hover',
                'help' => 'Pause transition when user hovers over',
            ],
            'animation' => [
                'title' => 'Animation',
                'delay' => [
                    'label' => 'Delay time',
                    'help' => 'Delay between slide transitions',
                    'placeholder' => '3000',
                    'unit' => 'ms',
                ],
                'speed' => [
                    'label' => 'Transition speed',
                    'help' => 'Duration of transition animation',
                    'placeholder' => '500',
                    'unit' => 'ms',
                ],
            ],
        ],
        'shortcode' => [
            'title' => 'Embed Code',
            'description' => 'Configure custom embed code',
            'label' => 'Custom embed code',
            'placeholder' => 'Paste HTML/JavaScript code here...',
            'help' => 'Use to embed custom code into slide',
        ],
        'list' => [
            'title' => 'Slide List',
            'description' => 'Configure basic parameters for each Slide',
            'add_slide' => 'Add Slide',
            'empty_state' => [
                'icon' => 'bx-slider-alt',
                'title' => 'No slides created yet',
                'description' => 'Click "Add Slide" button to create new slide',
            ],
            'tabs' => [
                'general' => 'General Information',
                'seo' => 'SEO',
            ],
            'fields' => [
                'description' => 'Slide description',
                'description_placeholder' => 'Enter slide description...',
                'canonical' => 'Static URL',
                'new_tab' => 'Open in new tab',
                'alt' => 'Image title (ALT)',
                'alt_placeholder' => 'Enter SEO title...',
                'title' => 'Image description (Title)',
                'title_placeholder' => 'Enter SEO description...',
            ],
            'buttons' => [
                'delete' => 'Delete',
            ],
        ],
    ],
    'order' => [
        'index' => [
            'title' => "Order Management",
            'table' => [
                'title' => 'Order List',
                'add_button' => 'Add New Order',
                'order_code' => 'Order Code',
                'order_date' => 'Order Date',
                'customer' => 'Customer',
                'payment_method' => 'Payment Method',
                'shipping_method' => 'Shipping Method',
                'total_price' => 'Total Price',
                'payment_status' => 'Payment Status',
                'delivery_status' => 'Delivery Status',
                'confirmation' => 'Confirmation',
                'actions' => 'Actions',
            ],
        ],
        'details' => [
            'title' => 'Order Details',
            'order_code' => 'Order Code',
            'customer' => 'Customer',
            'shipping_address' => 'Shipping Address',
            'payment_method' => 'Payment Method',
            'order_items' => 'Invoice Details',
            'products_count' => ':count products',
            'product' => 'Product',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'total' => 'Total',
            'order_summary' => 'Order Summary',
            'subtotal' => 'Subtotal',
            'discount' => 'Discount',
            'shipping_fee' => 'Shipping Fee',
            'grand_total' => 'Grand Total',
            'order_status' => 'Order Status',
            'invoice' => 'Invoice',
            'download_invoice' => 'Download Invoice',
            'confirm_status' => 'Confirmation Status',
            'payment_status' => 'Payment Status',
            'delivery_status' => 'Delivery Status',
            'shipping_details' => 'Shipping Details',
            'track_order' => 'Track Order',
            'documents' => 'Documents',
            'invoice_number' => 'Invoice Number',
            'shipping_number' => 'Shipping Number',
            'edit' => 'Edit',
            'estimated_delivery' => 'Estimated Delivery',
            'modal' => [
                'update_customer_info' => 'Update Customer Information',
                'update_customer_address' => 'Update Customer Address',
                'update_invoice_status' => 'Update Invoice Status',
            ],
        ],
    ],
    'widget' => [
        'index' => [
            'title' => "Widget Management",
            'table' => [
                'title' => "Widget List",
                'add_button' => "Add New Widget",
            ],
        ],
        'create' => [
            'title' => "Add New Widget",
        ],
        'edit' => [
            'title' => "Update Widget",
        ],
        'translate' => [
            'title' => 'Translate Content'
        ],
        'notifications' => [

        ],
        'content_configuration' => [
            'title' => 'Widget Content Configuration',
            'description' => 'Settings for widget contents',
            'module_section' => [
                'title' => 'Module',
                'select_placeholder' => 'Select categories based on selected module',
            ],
            'search_section' => [
                'empty_state' => [
                    'icon' => 'bx bx-search-alt',
                    'text' => 'Enter keywords to search for products'
                ],
                'item_template' => [
                    'path_label' => 'Path:',
                    'name_validate' => 'Please enter a title.',
                    'keyword_validate' => 'Please enter a keyword.',
                    'module_validate' => 'Please select at least one item to add to the widget.'
                ]
            ]
        ],
        'fields' => [
            'name' => [
                'label' => 'Widget Name',
                'placeholder' => 'Enter widget name',
            ],
            'keyword' => [
                'label' => 'Widget Keyword',
                'placeholder' => 'Enter widget keyword',
            ],
        ]
    ],
    'promotion' => [
        'index' => [
            'title' => "Promotion Management",
            'table' => [
                'title' => "Promotion List",
                'add_button' => "Add New Promotion",
                'tableHeader' => [
                    'program_name' => 'Program Name',
                    'discount' => 'Discount',
                    'information' => 'Information',
                    'start_date' => 'Start Date',
                    'end_date' => 'End Date',
                    'status' => 'Status',
                    'actions' => 'Actions',
                ]
            ],
        ],
        'create' => [
            'title' => "Add New Promotion",
        ],
        'edit' => [
            'title' => "Update Promotion",
        ],
        'notifications' => [
            
        ],
        'aside' => [
            'time' => [
                'title' => 'Program Application Period',
                'description' => 'Set the program application period',
                'start_date' => 'Start Date',
                'end_date' => 'End Date',
                'never_end' => 'No End Date',
            ],
            
            'source' => [
                'title' => 'Applicable Customer Sources',
                'description' => 'Configure the applications below',
                'scope' => 'Application Scope',
                'all_channels' => 'All Channels',
                'all_channels_desc' => 'Apply to all customer sources',
                'specific_channels' => 'Specific Channels',
                'specific_channels_desc' => 'Select preferred customer sources',
                'select_channels' => 'Select Channel',
                'select_channels_placeholder' => 'Select corresponding channel',
            ],
            
            'object' => [
                'title' => 'Applicable Targets',
                'description' => 'Configure the target scope below',
                'scope' => 'Target Scope',
                'all_customers' => 'All Customers',
                'all_customers_desc' => 'Apply to all targets',
                'customer_groups' => 'Customer Groups',
                'customer_groups_desc' => 'Only apply to selected groups',
                'select_groups' => 'Select Customer Group',
                'select_groups_placeholder' => 'Select customer group',
            ],
        ],
        'general' => [
            'title' => 'Basic Information',
            'description' => 'Configure main program information',
            'name_label' => 'Promotion Program Name',
            'name_placeholder' => 'Enter promotion program name',
            'code_label' => 'Promotion Code',
            'code_placeholder' => 'Enter promotion code',
            'content_label' => 'Promotion Content',
            'content_placeholder' => 'Describe the promotion program in detail',
            'required' => '<i class="uil uil-exclamation-circle text-danger"></i>',
        ],
        'details' => [
            'title' => 'Promotion Detail Settings',
            'description' => 'Configure the information below',
            'method_label' => 'Select Promotion Method',
            'method_placeholder' => 'Select method',
            'order_amount' => [
                'from' => 'Value From',
                'to' => 'Value To',
                'discount' => 'Discount',
                'order_from' => 'Order Value From',
                'order_to' => 'To Value',
                'discount_level' => 'Discount Level',
                'from_placeholder' => 'Enter starting value',
                'to_placeholder' => 'Enter ending value',
                'discount_placeholder' => 'Enter discount amount',
                'currency' => 'VND',
                'percent' => '%',
                'add_condition' => 'Add Condition',
                'invalid_value' => 'Invalid "to" value!',
                'value_compare' => '"To" value must be greater than or equal to "from"!',
                'range_conflict' => 'This range already exists or overlaps!'
            ],
            'product_quantity' => [
                'title' => 'Applicable Products',
                'select_option' => 'Select Method',
                'table' => [
                    'product' => 'Product',
                    'discount_limit' => 'Discount Limit',
                    'discount_amount' => 'Discount Amount',
                    'select_product_placeholder' => 'Click here to select products',
                    'max_discount_placeholder' => 'Enter discount limit',
                    'discount_value_placeholder' => 'Enter discount value',
                    'currency_symbol' => 'VND',
                    'percent_symbol' => '%',
                ],
                'product_row' => [
                    'product_name' => 'Product Name',
                    'product_details' => 'Product Details',
                    'no_name' => '(No name)',
                    'sku' => 'SKU:',
                    'inventory' => 'Inventory:',
                    'could_sell' => 'Available:',
                ],
                'product_catalogue_row' => [
                    'product_catalogue_name' => 'Product Catalogue Name',
                ],
            ],
            'select_product_prompt' => 'Click here to select products...',
            'select_product_warning' => 'Please select applicable products!',
            'select_at_least_one_product' => 'Please select at least one product!',
            'customer_select' => [
                'label' => 'Select Customer Group',
                'placeholder' => 'Select customer group'
            ],
            'promotion_table_details' => [
                'view_details' => 'View Details',
                'max_discount' => 'Max:',
                'no_expiry' => 'No Expiry',
                'expired' => 'Expired',
                'discount_types' => [
                    'percent' => ':value%',
                    'cash' => ':amountVND'
                ],
                'date_format' => 'm/d/Y H:i'
            ],
        ],
    ],
    'publish' => [
        '' => 'Select status',
        '2' => 'Published',
        '1' => 'Unpublished',
    ],
    'perpage' => 'records',
    'keyword_placeholder' => 'Search...',
    'status' => 'Status',
    'actions' => [
        'title' => 'Actions',
        'edit' => 'Edit',
        'translate' => 'Translate',
        'delete' => 'Delete',
        'cancel' => 'Cancel',
        'save' => 'Save',
    ],
    'confirmJs' => [
        'title' => "Are you sure?",
        'text' => "You will not be able to undo this action!",
        'confirmButton' => "Yes, delete it!",
        'cancelButton' => "Cancel",
        'successTitle' => "Deleted!",
        'errorTitle' => "Error!",
        'deleteSuccess' => "Deleted successfully.",
        'deleteError' => "An error occurred while deleting.",
        'generalError' => "An error has occurred, please try again!",
    ],
    "modal" => [
        'close' => 'Close',
        'confirm' => 'Confirm',
    ],
    'icon_explanation' => 'Icon Explanation:',
    'translated' => 'Translated',
    'not_translated' => 'Not Translated',
    'cannot_be_empty' => 'Information cannot be empty',
    'original_language' => 'Original Language',
    'required_fields' => 'Fields with the :icon icon are required.',
    'configuration' => 'SEO Configuration',
    'setup_title_description_keywords' => 'Set up SEO title, description, and keywords',
    'seo_default' => [
        'no_seo_title' => 'You have not set an SEO title',
        'default_canonical' => url('/') . '/' . 'your-url' . config('apps.general.suffix'),
        'no_seo_description' => 'You have not set an SEO description',
    ],
    'seo_title' => 'SEO Title',
    'enter_seo_title' => 'Enter SEO title',
    'seo_keywords' => 'SEO Keywords',
    'enter_seo_keywords' => 'Enter SEO keywords',
    'seo_description' => 'SEO Description',
    'enter_seo_description' => 'Enter SEO description',
    'keyword' => 'Keyword',
    'enter_keyword' => 'Enter keyword',
    'general_information' => 'General Information',
    'enter_title_description_content' => 'Enter title, description, and content',
    'title' => 'Title',
    'enter_title' => 'Enter title',
    'short_description' => 'Short Description',
    'enter_short_description' => 'Enter short description',
    'content' => 'Content',
    'enter_content' => 'Enter detailed content',
    'upload_image' => 'Upload Image',
    'advanced_settings' => 'Advanced Settings',
    'configure_category_status_navigation' => 'Configure category, status, and navigation',
    'parent_category' => 'Parent Category',
    'select_root_if_no_parent' => 'Select <strong>Root</strong> if there is no parent category.',
    'navigation' => 'Navigation',
    'featured_image' => 'Featured Image',
    'select_representative_image' => 'Select a representative image',
    'preview_image' => 'Preview Image',
    'save' => 'Save',
    'translations' => [
        'supported_languages' => "Supported languages:",
        'no_languages' => "No languages supported",
    ],
    'cannot_delete_category' => 'Cannot delete this category because it still has subcategories.',
    'assign_permission' => 'Assign Permission',
    'album' => [
        'album_title' => 'Photo Album',
        'album_description' => 'Select and upload images for the product',
        'upload_placeholder' => 'Drag and drop files here or click to upload.',
    ],
    'day' => 'Day',
    'month' => 'Month',
];