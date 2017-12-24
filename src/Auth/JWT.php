<?php

namespace Bavix\Auth;

use Carbon\Carbon;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class JWT
{

    /**
     * @var Carbon
     */
    protected $carbon;

    /**
     * @var string
     */
    protected $alg;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var int
     */
    protected $expires;

    /**
     * JWT constructor.
     *
     * @param string     $algo
     * @param string     $key
     * @param Carbon|int $time
     */
    public function __construct(string $algo, string $key, $time)
    {
        $this->carbon  = Carbon::now();
        $this->expires = $time;

        if (!\is_object($this->expires))
        {
            $this->expires = (clone $this->carbon)
                ->addSeconds($time);
        }

        $this->alg = $algo;
        $this->key = $key;
    }

    /**
     * @param mixed $data
     *
     * @return array
     */
    protected function payload($data): array
    {
        return [
            // issued at
            'iat'  => $this->carbon->timestamp,

            // not before
            'nbf'  => $this->carbon->timestamp,

            // expires
            'exp'  => $this->expires->timestamp,

            // user data
            'data' => $data
        ];
    }

    /**
     * @param mixed $payload
     *
     * @return string
     */
    public function encode($payload): string
    {
        return \Firebase\JWT\JWT::encode(
            $this->payload($payload),
            $this->key,
            $this->alg
        );
    }

    /**
     * @param string $jwt
     *
     * @return \stdClass
     *
     * @throws \UnexpectedValueException    Provided JWT was invalid
     * @throws SignatureInvalidException    Provided JWT was invalid because the signature verification failed
     * @throws BeforeValidException         Provided JWT is trying to be used before it's eligible as defined by 'nbf'
     * @throws BeforeValidException         Provided JWT is trying to be used before it's been created as defined by
     *                                      'iat'
     * @throws ExpiredException             Provided JWT has since expired, as defined by the 'exp' claim
     */
    public function decode(string $jwt): \stdClass
    {
        $payload = \Firebase\JWT\JWT::decode(
            $jwt,
            $this->key,
            (array)$this->alg
        );

        return $payload->data;
    }

}
