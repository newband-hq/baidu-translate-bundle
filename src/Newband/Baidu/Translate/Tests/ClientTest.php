<?php

namespace Newband\Baidu\Translate\Tests;

use Newband\Baidu\Translate\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testSend()
    {
        $client = new Client($GLOBALS['appid'], $GLOBALS['secretkey']);
        $response = $client->request('上海', 'zh', 'en');
        $this->assertEquals(200, $response->getStatusCode());
    }
}