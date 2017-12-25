<?php

namespace Bavix\Auth;

use Bavix\Slice\Slice;

abstract class Validator
{

    /**
     * @var Slice
     */
    protected $providerSlice;

    /**
     * @var Slice
     */
    protected $slice;

    /**
     * Validator constructor.
     *
     * @param Slice $providerSlice
     * @param Slice $slice
     */
    public function __construct(Slice $providerSlice, Slice $slice)
    {
        $this->providerSlice = $providerSlice;
        $this->slice         = $slice;
    }

    /**
     * @param string $login
     *
     * @return bool
     */
    abstract public function loginExists(string $login): bool;

    /**
     * @param string $password
     *
     * @return bool
     */
    abstract public function verify(string $password): bool;

    /**
     * @return int|string
     */
    abstract public function identifier();

}
