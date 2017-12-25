<?php

namespace Bavix\Auth;

use Bavix\Context\Content;
use Bavix\Slice\Slice;

abstract class Provider
{

    /**
     * @var Slice
     */
    protected $providerSlice;

    /**
     * @var Content
     */
    protected $content;

    /**
     * @var Validator
     */
    protected $validator;

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
     * @param array $options
     *
     * @return Validator
     */
    protected function auth(array $options): Validator
    {
        $validator = $this->validator();

        $login    = $options['login'];
        $password = $options['password'];

        if ($validator->loginExists($login) && $validator->verify($password))
        {
            return $validator;
        }

        return null;
    }

    /**
     * @return Validator
     */
    protected function validator(): Validator
    {
        if (!$this->validator)
        {
            $class = $this->providerSlice->getRequired('validator.class');

            $this->validator = new $class($this->providerSlice, $this->slice);
        }

        return $this->validator;
    }

    public function persist($name)
    {

    }

    public function identifier()
    {
        return $this->validator()->identifier();
    }

//    abstract public function forgot($identifier);

//    abstract public function forgotAll();

}
