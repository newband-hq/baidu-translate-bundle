<?php

namespace Newband\Baidu\Translate;
use Newband\Baidu\Translate\Utils\Signature;
use Newband\Baidu\Translate\Utils\SignatureGenerator;

/**
 * Class Client
 * @package Newband\Baidu\Translate
 * @author Zafar <zafar@newband.com>
 */
class Client
{
    /**
     * @var string
     */
    protected $url = 'http://api.fanyi.baidu.com/api/trans/vip/translate';

    /**
     * @var string
     */
    protected $appId;

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Client constructor.
     * @param string $appId
     * @param string $secretKey
     */
    public function __construct(
        $appId,
        $secretKey
    ){
        $this->appId = $appId;
        $this->secretKey = $secretKey;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        if (null == $this->client) {
            $this->client = new \GuzzleHttp\Client();
        }

        return $this->client;
    }

    /**
     * @param string $query
     * @param string $from
     * @param string $to
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function request($query, $from, $to)
    {
        $signatureGenerator = new SignatureGenerator($query, $this->appId, $this->secretKey);
        $params = array(
            'q'     => $query,
            'appid' => $this->appId,
            'salt'  => $signatureGenerator->getSalt(),
            'from'  => $from,
            'to'    => $to,
            'sign'  =>  $signatureGenerator->generate()
        );

        $response = $this->getClient()->request('POST', $this->url, array(
            'form_params' => $params
        ));

        return $response;
    }
}