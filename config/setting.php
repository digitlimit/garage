<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Admin Password
    |--------------------------------------------------------------------------
    |
    | This is the deafult admin password for demo purposes!
    |
    */

    'demo_password' => env('DEMO_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Garage Opening Time
    |--------------------------------------------------------------------------
    |
    | The garage opening time is when the garage opens for business
    |
    */

    'open' => '9:00',

    /*
    |--------------------------------------------------------------------------
    | Garage Closing Time
    |--------------------------------------------------------------------------
    |
    | The garage closing time is when the garage closes for the day
    |
    */

    'close' => '17:30',

    /*
    |--------------------------------------------------------------------------
    | Booking Time Interval
    |--------------------------------------------------------------------------
    |
    | Booking times are available in the interval below
    |
    */

    'interval' => 30,

    /*
    |--------------------------------------------------------------------------
    | Pagination Configuration
    |--------------------------------------------------------------------------
    |
    | The configuration for records pagination
    |
    */

    'pagination' => [
        'per_page' => 15
    ],
];
