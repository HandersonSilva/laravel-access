<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Enable Access
    |--------------------------------------------------------------------------
    |
    | This value determines if the access is enabled or not.
    |
    */

    'enable' => env('ACCESS_ENABLE', false),

    /*
    |--------------------------------------------------------------------------
    | Secret Access
    |--------------------------------------------------------------------------
    |
    | This value is the secret key used to encrypt and decrypt the access code.
    |
    */

    'secret' => env('ACCESS_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Rate Limit Access
    |--------------------------------------------------------------------------
    |
    | This value determines the rate limit of the request to get the access code.
    |
    */

    'rate_limit' => [
        'max_attempts' => 5,
        'decay' => 60 * 10,
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Environments
    |--------------------------------------------------------------------------
    |
    | This value determines the environments that the access will be blocked.
    | Example: ['production', 'staging']
    */

    'block_env' => [],

    /*
    |--------------------------------------------------------------------------
    | Block Prefixes
    |--------------------------------------------------------------------------
    |
    | This value determines the prefixes that the access will be blocked.
    | Example: ['/admin', '/dashboard']
    |
    */

    'block_prefixes' => [],

    /*
    |--------------------------------------------------------------------------
    | Exclude Prefixes
    |--------------------------------------------------------------------------
    |
    | This value determines the prefixes that the access will be excluded.
    | Example: ['/api']
    |
    */

    'exclude_prefixes' => [],

    /*
    |--------------------------------------------------------------------------
    | Redirect Prefix
    |--------------------------------------------------------------------------
    |
    | This value determines the prefix that the access will be redirected. by default is the root.
    | Example: '/login'
    |
    */

    'redirect_prefix' => '/',

    /*
    |--------------------------------------------------------------------------
    | Auth Configuration
    |--------------------------------------------------------------------------
    |
    | This value determines the configuration of the authentication.
    | - Auto login is the value that determines if the user will be logged in automatically.
    | - Tha value guard is the guard used to authenticate the user.
    | - The user model is the model used to authenticate the user, You should define the id and email fields from the user model.
    |   Example: 'id' => 'my_field_id', 'email' => 'my_field_email'.
    | - The code expires is the time in seconds that the code will be valid, the default is 10 minutes.
    | - The session expires is the time in seconds that the session will be valid, the default is 24 hours.
    */

    'auth' => [
        'auto_login' => env('ACCESS_AUTO_LOGIN', false),
        'guard' => env('ACCESS_GUARD'),
        'user' => [
            'model' => App\Models\User::class,
            'id' => 'id',
            'email' => 'email',
        ],
        'code' => [
            'expires' => 600,
        ],
        'session' => [
            'expires' => 86400,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Page title
    |--------------------------------------------------------------------------
    |
    | This value determines the title of the page.
    |
    */

    'page_title' => 'Email validation',

    /*
    |--------------------------------------------------------------------------
    | App name
    |--------------------------------------------------------------------------
    |
    | This value determines the name of the application that will be displayed on the form page.
    |
    */
    'app_name' => 'Laravel Access',

    /*
    |--------------------------------------------------------------------------
    | App logo
    |--------------------------------------------------------------------------
    |
    | This value determines the logo of the application that will be displayed on the form page.
    |
    */

    'app_logo' => '/vendor/laravel-access/public/logo.png',

    /*
    |--------------------------------------------------------------------------
    | Company logo
    |--------------------------------------------------------------------------
    |
    | This value determines the logo of the company that will be displayed on the top page.
    |
    */
    'company_logo' => '/vendor/laravel-access/public/logo.png',

    /*
    |--------------------------------------------------------------------------
    | Custom title
    |--------------------------------------------------------------------------
    |
    | This value determines the title of the form.
    |
    */

    'custom_title' => 'Email validation',

    /*
    |--------------------------------------------------------------------------
    | Custom description
    |--------------------------------------------------------------------------
    |
    | This value determines the description of the form.
    |
    */

    'custom_description' => 'You will need to validate your email before accessing the system login.',

    /*
    |--------------------------------------------------------------------------
    | Custom button
    |--------------------------------------------------------------------------
    |
    | This value determines the text of the button that will be displayed on the form page index.
    |
    */
    'custom_button' => 'Get code',

    /*
    |--------------------------------------------------------------------------
    | Custom button valid code
    |--------------------------------------------------------------------------
    |
    | This value determines the text of the button that will be displayed on the form page code.
    |
    */

    'custom_button_valid_code' => 'Validate code',

    /*
    |--------------------------------------------------------------------------
    | Custom button resend code
    |--------------------------------------------------------------------------
    |
    | This value determines the text of the button that will be displayed on the form page code.
    |
    */

    'custom_button_resend_code' => 'Resend code',

    /*
    |--------------------------------------------------------------------------
    | Custom Messages
    |--------------------------------------------------------------------------
    |
    | This value determines the messages that will be displayed on the application.
    | - Invalid code is the message that will be displayed when the code is invalid.
    | - Too many requests is the message that will be displayed when the request limit is exceeded.
    */

    'messages' => [
        'invalid_code' => 'Invalid code',
        'too_many_requests' => 'Too many requests',
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Email
    |--------------------------------------------------------------------------
    |
    | This value determines the email messages that will be displayed on the application.
    | - Subject is the subject of the email.
    | - Message is the message that will be displayed on the email.
    | - Code message is the message that will be displayed on the email with the code.
    */

    'mail' => [
        'subject' => 'Email validation',
        'message' => 'Access code',
        'code_message' => 'Use the code below to access the application',
    ],
];
