<?php

namespace Bavix\Auth;

use Bavix\Context\Content;
use Bavix\Context\Cookies;
use Bavix\Context\Session;
use Bavix\Exceptions\Runtime;
use Bavix\Slice\Slice;

class Auth
{

    /**
     * @var Content[]
     */
    protected $contents = [];

    /**
     * @var Slice
     */
    protected $slice;

    /**
     * @var JWT
     */
    protected $jwt;

    /**
     * Auth constructor.
     *
     * @param Slice $slice
     */
    public function __construct(Slice $slice)
    {
        $this->slice = $slice;
    }

    /**
     * @return JWT
     */
    public function jwt(): JWT
    {
        if (!$this->jwt)
        {
            $this->jwt = new JWT(
                $this->slice->getRequired('jwt.key'),
                $this->slice->getRequired('jwt.algorithm'),
                $this->slice->getRequired('jwt.expires')
            );
        }

        return $this->jwt;
    }

    /**
     * @param string $name
     *
     * @return Provider
     */
    public function provider(string $name): Provider
    {
        $slice = $this->slice->getSlice('providers.' . $name);
        $class = $slice->getRequired('class');
        $key   = $slice->getData('content');

        if ($key && empty($this->contents[$key]))
        {
            /**
             * if key for content exists and
             *  content not found then
             *  runtime error
             */
            throw new Runtime('Content `' . $key . '` is empty');
        }

        return new $class(

            // provider slice
            $slice,

            // auth slice
            $this->slice,

            // content (session, cookies, ...)
            $this->contents[$key] ?? null
        );
    }

}
