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

class RequestEvent extends Event
{
    /** @var  string */
    protected $serviceName;

    /** @var  mixed */
    protected $request;

    /**
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
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