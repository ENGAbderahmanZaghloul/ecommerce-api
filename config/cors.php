<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // api url / endpoints allowed to  frontend

    'allowed_methods' => ['*'], // restfull api methods [GEt ,POST ,PUT,DELETE]

    'allowed_origins' => ['*'], // **مهم جدًا:** في مرحلة التطوير خليها '*'
         // لكن في الإنتاج لازم تحط الـ Domain بتاع React بتاعك بالضبط
       // مثال: 'allowed_origins' => ['http://localhost:3000', 'https://your-react-app.com'],


    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // all headers

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false, // خليها false لو بتستخدم Bearer Tokens مش Cookies

];
