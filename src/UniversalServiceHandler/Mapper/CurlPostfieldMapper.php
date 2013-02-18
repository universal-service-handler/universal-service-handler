<?php
namespace UniversalServiceHandler\Mapper;

use UniversalServiceHandler\Mapper\MapperInterface;

class CurlPostfieldMapper implements MapperInterface
{
    public function map($unmappedData)
    {
        if (!is_array($unmappedData)) {
            throw new \RuntimeException('CurlPostfieldMapper->map() expects an array.');
        }

        $mappedData = '';

        foreach ($unmappedData as $fieldName => $value) {
            $mappedData .= $fieldName . '=' . $value . '&';
        }

        return $mappedData;
    }
}
