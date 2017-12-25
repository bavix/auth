<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$slice = new \Bavix\Slice\Slice(
    include __DIR__ . '/config.php'
);

$auth = new \Bavix\Auth\Auth($slice);

// login

/**
 * @var $provider \Bavix\Auth\Providers\PasswordProvider
 */
$provider = $auth->provider('password');

if ($provider->login($email, $password))
{
    $provider->persist('cookies');
    // provider.store('cookies')
}

// check

// auth.login
if ($auth->valid())
{

}
