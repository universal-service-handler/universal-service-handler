<?php
namespace UniversalServiceHandler\Mapper;

use UniversalServiceHandler\Mapper\MapperInterface;

class RelayMapper implements MapperInterface
{
    public function map($unmappedData)
    {
        return $unmappedData;
    }
}
