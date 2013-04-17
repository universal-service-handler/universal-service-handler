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
        $xmlEntity = @simplexml_load_string($unmappedData);
        $value = '';

        if ($xmlEntity !== false) {
            $entity = $xmlEntity->xpath($this->xPath);
            if (array_key_exists(0, $entity)) {
                $value = (string) $entity[0];
            }
        }
        return $value;
    }
}
