<?php
namespace UniversalServiceHandler\Tests\TransferClient;

use UniversalServiceHandler\TransferClient\CurlTransferClient;

class CurlTransferClientTest extends \PHPUnit_Framework_TestCase
{
    public function testInitCurlOptions()
    {
        $curlOptions = array(
            'field_test' => 'value_test'
        );

        $options = array(
            'options' => $curlOptions
        );

        $curlTransferClient = new CurlTransferClient($options);
        $this->assertEquals($curlTransferClient->getCurlOptions(), $curlOptions);
    }
}
