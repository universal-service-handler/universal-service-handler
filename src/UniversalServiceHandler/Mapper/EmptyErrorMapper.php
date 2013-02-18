<?php
namespace UniversalServiceHandler\Mapper;

use UniversalServiceHandler\Mapper\MapperInterface;

class EmptyErrorMapper implements MapperInterface
{
    public function map($unmappedData)
    {
        return array();
    }
}
