<?php
/*
 * @author Zsolt Javorszky
 * @author Sandor Legoza
 * @copyright 2013
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UniversalServiceHandler\Event;

use Symfony\Component\EventDispatcher\Event;

class ResponseEvent extends Event
{
    /** @var  string */
    protected $serviceName;

    /** @var  mixed */
    protected $response;

    /**
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param string $serviceName
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;
    }

    /**
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }
}