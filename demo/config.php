<?php

return [

    'jwt' => [
        // random key
        'key'       => 'Zje$5bZJ#cQFjsL@o2i#',

        // IMPORTANT:
        // You must specify supported algorithms for your application. See
        // https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
        // for a list of spec-compliant algorithms.
        'algorithm' => 'HS256',

        // When checking nbf, iat or expiration times,
        // we want to provide some extra leeway time to
        // account for clock skew.
        'expires'   => \Carbon\Carbon::now()->addWeek()
    ],

    'stores' => [

        'session' => [
            'key'   => 'bavixAuth',
            'class' => \Bavix\Context\Session::class,
        ],

        'cookies' => [
            'key'     => 'bavixAuth',
            'class'   => \Bavix\Context\Cookies::class,
            'persist' => 'session'
        ],

    ],

    'providers' => [

        /**
         * password provider
         */
        'password' => [
            'class'     => \Bavix\Auth\Providers\PasswordProvider::class,
            'validator' => \Bavix\Auth\Validator::class,

            'options' => [
                'loginFields' => ['email'],
                'hashField'   => 'password',
            ]
        ]

    ]

];
