<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$key  = 'hello world';
$algo = 'HS256';

$jwt = new \Bavix\Auth\JWT(
    $algo,
    $key,
    2
);

$payload = [
    'id' => 1
];

$encode = $jwt->encode($payload);

\sleep(1);

var_dump($jwt->decode($encode));
