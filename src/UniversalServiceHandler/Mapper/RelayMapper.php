<?php
/*
 * @author Zsolt Javorszky
 * @author Sandor Legoza
 * @copyright 2013
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UniversalServiceHandler\Mapper;

use UniversalServiceHandler\Mapper\MapperInterface;

class RelayMapper implements MapperInterface
{
    public function map($unmappedData)
    {
        return $unmappedData;
    }
}
