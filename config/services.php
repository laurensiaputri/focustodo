<?php

return [

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // Konfigurasi untuk Login Google
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),         // Client ID dari Google Developer Console
        'client_secret' => env('GOOGLE_CLIENT_SECRET'), // Client Secret dari Google Developer Console
        'redirect' => env('GOOGLE_REDIRECT_URI'),       // URL redirect setelah login
    ],

];
