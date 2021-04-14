<?php

return [
    'auth' => [
        'login' => env('AIMON_SMS_LOGIN', null),
        'password' => env('AIMON_SMS_PASSWD', null),
        'api_id' => env('AIMON_ID_API', null),
    ],
    'database' => [
        /**
        * Disable or enable database log.
        */
        'enabled' => env('AIMON_DATABASE_LOG', true),
        /**
         * Change this variable to path to user model.
         */
        'user'    => 'App\Models\User',
        'tables' => [
            /**
             * Table in which users are stored.
             */
            'user' => 'users',
        ],
    ]
];
