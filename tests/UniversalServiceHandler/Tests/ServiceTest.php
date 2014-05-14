<?php
namespace UniversalServiceHandler\Tests\ServiceTest;

use UniversalServiceHandler\Mapper\RelayMapper;
use UniversalServiceHandler\Processor\RequestProcessor;
use UniversalServiceHandler\Processor\ResponseProcessor;
use UniversalServiceHandler\Response\Response;
use UniversalServiceHandler\Service;
use Mockery as m;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        m::close();
    }


    /**
     * @dataProvider provider
     */
    public function testCallService($serviceOptions, $requestOptions, $expectedResponse)
    {

        $service = new Service($serviceOptions);
        $response = $service->callService($requestOptions);

        $this->assertEquals($expectedResponse, $response);
    }

    public function provider()
    {
        $relayMapper = new RelayMapper();
        $options = array(
            'request_mapper' => $relayMapper
        );
        $requestProcessor = new RequestProcessor($options);

        $options = array(
            'error_mapper' => $relayMapper,
            'data_mapper' => $relayMapper,
            'status_mapper' => $relayMapper
        );
        $responseProcessor = new ResponseProcessor($options);

        $transferClientMock = m::mock('UniversalServiceHandler\TransferClient\CurlTransferClient');
        $transferClientMock->shouldReceive('callService')->andReturn('something');

        $serviceOptions = array(
            'request_processor' => $requestProcessor,
            'response_processor' => $responseProcessor,
            'transfer_client' => $transferClientMock
        );

        $requestOptions = array();

        $response = new Response();
        $response->setStatus('something');
        $response->setData('something');
        $response->setErrors('something');

        return array(
            array($serviceOptions, $requestOptions, $response)
        );
    }
}