<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$slice = new \Bavix\Slice\Slice(
    include __DIR__ . '/config.php'
);

$auth = new \Bavix\Auth\Auth($slice);

// login

/**
 * @var $password \Bavix\Auth\Providers\PasswordProvider
 */
$provider = $auth->provider('password');

$isLogin = $provider->login(
    $email,
    $password
);

if ($isLogin)
{
    $provider->persist('cookies');
    // provider.store('cookies')
}

// check

// auth.login
if ($auth->valid())
{

}
