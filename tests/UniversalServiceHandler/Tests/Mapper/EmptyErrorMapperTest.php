<?php
namespace UniversalServiceHandler\Tests\TransferClient;

use UniversalServiceHandler\Mapper\EmptyErrorMapper;

class EmptyErrorMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testMap($unmappedData, $expectedMappedData)
    {
        $mapper = new EmptyErrorMapper();
        $mappedData = $mapper->map($unmappedData);

        $this->assertEquals($expectedMappedData, $mappedData);
    }

    public function provider()
    {
        return array(
            array('', array()),
            array('something', array()),
            array(array('123'), array())

        );
    }
}
