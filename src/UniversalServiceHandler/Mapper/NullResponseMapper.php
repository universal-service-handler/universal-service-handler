<?php
namespace UniversalServiceHandler\Mapper;

use UniversalServiceHandler\Mapper\MapperInterface;

class NullResponseMapper implements MapperInterface
{
    public function map($unmappedData)
    {
        return null;
    }
}
