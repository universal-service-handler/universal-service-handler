<?php

namespace UniversalServiceHandler\Tests\Mapper;

use UniversalServiceHandler\Mapper\CurlPostfieldMapper;

class CurlPostfieldMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testMap($unmappedData, $expectedMappedData)
    {
        $mapper = new CurlPostfieldMapper();
        $mappedData = $mapper->map($unmappedData);

        $this->assertEquals($expectedMappedData, $mappedData);
    }

    public function provider()
    {
        return array(
            array(
                array(),
                ''
            ),
            array(
                array(
                    'firstKey' => 'firstValue'
                ),
                'firstKey=firstValue&'
            ),
            array(
                array(
                    'firstKey' => 'firstValue',
                    'secondKey' => 'secondValue'
                ),
                'firstKey=firstValue&secondKey=secondValue&'
            )

        );
    }
}
