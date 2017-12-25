<?php

$auth = new \Bavix\Auth\Auth($slice);

/**
 * @var $provider \Bavix\Auth\Providers\PasswordProvider
 */
$provider = $auth->provider('password');

// [ id => 1 ]

// auth -> val.check login? -> user exists?
//    -> verify password

// $auth->login(..args) -> sym $val->login(

// bool
$provider->login( $_POST['login'], $_POST['pssw'] );

// mixed
$provider->identifier();

// store current login data
$provider->store('cookies');


// AuthObject or null
// $auth->login($login, $password)

$objAuth = $provider->login($login, $password);

if ($objAuth)
{

    $provider->store($objAuth, 'session');

    if ($rememberMe)
    {
        // store(objAuth, type = 'default')
        $provider->store($objAuth, 'cookies');
    }

}

// get

// [
//  [id: 1]
//  [id: 2]
//  [id: 3]
// ]
$provider->get(); // array of array's

