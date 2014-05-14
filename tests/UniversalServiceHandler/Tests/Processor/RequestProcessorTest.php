<?php
namespace UniversalServiceHandler\Tests\Processor;

use UniversalServiceHandler\Mapper\RelayMapper;
use UniversalServiceHandler\Processor\RequestProcessor;

class RequestProcessorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testProcess($options, $unprocessedData, $expectedProcessedData)
    {

        $processor = new RequestProcessor($options);
        $processedData = $processor->process($unprocessedData);

        $this->assertEquals($expectedProcessedData, $processedData);
    }

    public function provider()
    {
        $mapper = new RelayMapper();
        $options = array(
            'request_mapper' => $mapper
        );
        return array(
            array($options, 'something', 'something')
        );
    }
}