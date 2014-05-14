<?php
namespace UniversalServiceHandler\Tests\TransferClient;

use UniversalServiceHandler\Mapper\RelayMapper;

class RelayMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testMap($unmappedData, $expectedMappedData)
    {
        $mapper = new RelayMapper();
        $mappedData = $mapper->map($unmappedData);

        $this->assertEquals($expectedMappedData, $mappedData);
    }

    public function provider()
    {
        return array(
            array('', ''),
            array('something', 'something')
        );
    }
}
