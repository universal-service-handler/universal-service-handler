<?php
namespace UniversalServiceHandler\Mapper;

use Optionable;
use UniversalServiceHandler\Mapper\MapperInterface;

class XPathMapper implements MapperInterface
{
    protected $xPath;

    function __construct($options)
    {
        $options = Optionable::getOptionable($options);

        if (!$options->offsetExists('x_path')) {
            throw new \RuntimeException('x_path parameter is required.');
        }

        $this->xPath = $options['x_path'];
    }

    public function map($unmappedData)
    {
        $xmlEntity = simplexml_load_string($unmappedData);

        $entity = $xmlEntity->xpath($this->xPath);

        $value = '';

        if (array_key_exists(0, $entity)) {
            $value = (string) $entity[0];
        }

        return $value;
    }
}
