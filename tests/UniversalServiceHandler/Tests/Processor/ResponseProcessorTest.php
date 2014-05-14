<?php
namespace UniversalServiceHandler\Tests\Processor;

use UniversalServiceHandler\Mapper\RelayMapper;
use UniversalServiceHandler\Processor\ResponseProcessor;
use UniversalServiceHandler\Response\Response;

class ResponseProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testMap($options, $unprocessedData, $expectedResponse)
    {
        $processor = new ResponseProcessor($options);
        $processedData = $processor->process($unprocessedData);

        $this->assertEquals($expectedResponse, $processedData);
    }

    public function provider()
    {
        $mapper = new RelayMapper();
        $options = array(
            'error_mapper' => $mapper,
            'data_mapper' => $mapper,
            'status_mapper' => $mapper
        );

        $response = new Response();
        $response->setErrors('something');
        $response->setData('something');
        $response->setStatus('something');

        return array(
            array($options, 'something', $response)
        );
    }
}