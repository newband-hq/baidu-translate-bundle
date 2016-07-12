<?php

namespace Newband\Baidu\Translate\Utils;

/**
 * Class Signature
 * @package Newband\Baidu\Translate\Utils
 * @author Zafar <zafar@newband.com>
 */
class SignatureGenerator
{
    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $appId;

    /**
     * @var string
     */
    private $secretKey;

    /**
     * @var string
     */
    private $salt;

    /**
     * Signature constructor.
     * @param string $query
     * @param string $appId
     * @param string $secretKey
     */
    public function __construct(
        $query,
        $appId,
        $secretKey
    ){
        $this->query = $query;
        $this->appId = $appId;
        $this->secretKey = $secretKey;
        $this->createSalt();
    }

    /**
     * @return string
     */
    public function generate()
    {
        return md5($this->appId.$this->query.$this->salt.$this->secretKey);
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    protected function createSalt()
    {
        $this->salt = rand(10000,99999);
    }
}