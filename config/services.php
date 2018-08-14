<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'twitter' => [
        'client_id'     => env('TWITTER_ID','nMF6CrRFecJjbXklkIsKm4Xdv  '),
        'client_secret' => env('TWITTER_SECRET','JFgCxlGohhx11vvuBzSIH1Lalte6csxjZLGBcpnYhVWrQdZ6ED'),
        'redirect'      => env('TWITTER_URL','https://www.altee.com/auth/twitter/callback'),
        'scope'         =>'email'
    ],
    'facebook' => [
        'client_id'     => env('FACEBOOK_ID', '454775958253469'),
        'client_secret' => env('FACEBOOK_SECRET', '89377702b8a56fc6acec6772e2d13a4a'),
        'redirect'      => env('FACEBOOK_URL','https://www.altee.com/auth/facebook/callback')
    ],
    'google' => [
        'client_id' => '1003546402910-6edj5iicnevmbbilcp1mntkjumkgusk6.apps.googleusercontent.com',
        'client_secret' => 'HdsaOnUhjHYNqXSFTIV2MhXA',
        'redirect' => 'https://www.altee.com/auth/google/callback'
    ],
	'stripe' => [
        'model' => App\User::class,
		'secret' => env('STRIPE_SECRATE_KEY'),
		'publishable_key'=>env('STRIPE_PUBLISHABLE_KEY')
	],
	'mailchimp' => [
		'MAILCHIMP_API_KEY' => env('MAILCHIMP_API_KEY'),
		'MAILCHIMP_LIST_ID' => env('MAILCHIMP_LIST_ID')
	],


];
