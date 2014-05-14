<?php

namespace UniversalServiceHandler\Tests\Mapper;

use UniversalServiceHandler\Mapper\XPathMapper;

class XPathMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testMap($xPath, $unmappedData, $expectedMappedData)
    {
        $options = array(
          'x_path' => $xPath
        );

        $mapper = new XPathMapper($options);
        $mappedData = $mapper->map($unmappedData);

        $this->assertEquals($expectedMappedData, $mappedData);
    }

    public function provider()
    {

        $xml = <<<XML
<a>
 <b>
  <c>text</c>
  <c>stuff</c>
 </b>
 <d>
  <c>code</c>
 </d>
</a>
XML;
        return array(
            array('/a/b/c', $xml, 'text'),
            array('b/c', $xml, 'text')
        );
    }
}