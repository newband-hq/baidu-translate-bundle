<?php

namespace Newband\Baidu\Translate\Tests;

use Newband\Baidu\Translate\Client;
use Newband\Baidu\Translate\Translator\Translator;

class TranslatorTest extends \PHPUnit_Framework_TestCase
{
    public function testTranslate()
    {
        $client = new Client($GLOBALS['appid'], $GLOBALS['secretkey']);
        $translator = new Translator($client);
        $result = $translator->translate('上海', Translator::LANG_SIMPLIFIED_CHINESE, Translator::LANG_ENGLISH);
        $this->assertEquals('Shanghai', $result);
    }
}