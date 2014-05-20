<?php
/*
 * @author Zsolt Javorszky
 * @author Sandor Legoza
 * @copyright 2013
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UniversalServiceHandler;

final class Events
{
    /**
     * Private constructor. This class is not meant to be instantiated.
     */
    private function __construct()
    {
    }

    /**
     * @var string
     */
    const preRequestProcess = 'ush.preRequestProcess';

    /**
     * @var string
     */
    const postRequestProcess = 'ush.postRequestProcess';

    /**
     * @var string
     */
    const preResponseProcess = 'ush.preResponseProcess';

    /**
     * @var string
     */
    const postResponseProcess = 'ush.postResponseProcess';
}