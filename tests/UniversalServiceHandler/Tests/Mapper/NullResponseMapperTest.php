<?php

namespace UniversalServiceHandler\Tests\Mapper;

use UniversalServiceHandler\Mapper\NullResponseMapper;

class NullResponseMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testMap($unmappedData, $expectedMappedData)
    {
        $mapper = new NullResponseMapper();
        $mappedData = $mapper->map($unmappedData);

        $this->assertEquals($expectedMappedData, $mappedData);
    }

    public function provider()
    {
        return array(
            array('', null),
            array('something', null),
            array(array('123'), null)

        );
    }
}
