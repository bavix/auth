<?php

namespace Bavix\Auth;

use Bavix\Context\Content;
use Bavix\Slice\Slice;

abstract class Provider
{

    /**
     * @var Content
     */
    protected $content;

    /**
     * @var Slice
     */
    protected $providerSlice;

    /**
     * @var Slice
     */
    protected $slice;

    /**
     * Provider constructor.
     *
     * @param Slice        $providerSlice
     * @param Slice        $slice
     * @param Content|null $content
     */
    public function __construct(Slice $providerSlice, Slice $slice, ?Content $content)
    {
        $this->providerSlice = $providerSlice;
        $this->slice         = $slice;
        $this->content       = $content;
    }

    /**
     * @return Validator
     */
    protected function validator(): Validator
    {
        $class = $this->slice->getRequired('validator.class');

        return new $class($this->providerSlice, $this->slice);
    }

    public function store(array $token): bool
    {

    }

    public function login(string $login, string $password)
    {
        $validator = $this->validator();

        if ($validator->loginExists($login))
        {
            if ($validator->passwordVerify($password))
            {
                return $this->store(
                    $validator->generateToken()
                );
            }
        }

        return false;
    }

    abstract public function verify();
    abstract public function forgot();

}
