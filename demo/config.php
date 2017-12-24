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

    'providers' => [

        /**
         * password provider
         */
        'password' => [

            'class' => \Bavix\Auth\Providers\PasswordProvider::class,
            'validator' => \Bavix\Auth\Validator::class,

            'loginFields' => ['email'],
            'hashField'   => 'password',

            'persist' => [

                'session' => [
                    'class' => \Bavix\Auth\Providers\StoreProvider::class
                ],

                'cookies' => [
                    'class' => \Bavix\Auth\Providers\StoreProvider::class
                ],

            ]
        ]

    ]

];
