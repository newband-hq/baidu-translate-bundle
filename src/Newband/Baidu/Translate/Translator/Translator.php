<?php

namespace Newband\Baidu\Translate\Translator;

use Newband\Baidu\Translate\Client;
use Newband\Baidu\Translate\TranslatorInterface;

/**
 * Class Translator
 * @package Newband\Baidu\Translate\Translator
 * @author Zafar <zafar@newband.com>
 */
class Translator implements TranslatorInterface
{
    const LANG_AUTO                 = 'auto';
    const LANG_SIMPLIFIED_CHINESE   = 'zh';
    const LANG_CLASSICAL_CHINESE    = 'wyw';
    const LANG_TRADITIONAL_CHINESE  = 'cht';
    const LANG_CANTONESE            = 'yue';
    const LANG_ENGLISH              = 'en';
    const LANG_JAPANESE             = 'jp';
    const LANG_KOREAN               = 'kr';
    const LANG_FRENCH               = 'fr';
    const LANG_SPANISH              = 'spa';
    const LANG_THAI                 = 'th';
    const LANG_ARABIC               = 'ara';
    const LANG_RUSSIAN              = 'ru';
    const LANG_PORTUGUESE           = 'pt';
    const LANG_GERMAN               = 'de';
    const LANG_ITALIAN              = 'it';
    const LANG_GREEK                = 'el';
    const LANG_DUTCH                = 'nl';
    const LANG_POLISH               = 'pl';
    const LANG_BULGARIAN            = 'bul';
    const LANG_ESTONIAN             = 'est';
    const LANG_DANISH               = 'dan';
    const LANG_FINNISH              = 'fin';
    const LANG_CZECH                = 'cs';
    const LANG_ROMANIAN             = 'rom';
    const LANG_SLOVENIAN            = 'slo';
    const LANG_SWEDISH              = 'swe';
    const LANG_HUNGARIAN            = 'hu';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $errorCode;

    /**
     * @var string
     */
    protected $errorMessage;

    /**
     * Translate constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function translate($query, $from = self::LANG_AUTO, $to = self::LANG_ENGLISH)
    {
        try {
            $response = $this->client->request($query, $from, $to);
            $content = json_decode($response->getBody()->getContents(), true);
            if (isset($content['trans_result'])) {
                return $content['trans_result'][0]['dst'];
            }
            if (isset($content['error_code'])) {
                $this->errorCode = $content['error_code'];
                $this->errorMessage = $content['error_msg'];
            }
        } catch (\Exception $e) {
            $this->errorCode = $e->getCode();
            $this->errorMessage = $e->getMessage();
        }

        return null;
    }

    /**
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}