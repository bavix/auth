<?php

namespace Bavix\Auth\Providers;

use Bavix\Auth\Provider;

class PasswordProvider extends Provider
{

    public function login(string $login, string $password)
    {
        $this->auth([
            'login' => $login,
            'password' => $password
        ]);

        return (bool)$this->validator();
    }

}
