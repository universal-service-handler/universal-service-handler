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
