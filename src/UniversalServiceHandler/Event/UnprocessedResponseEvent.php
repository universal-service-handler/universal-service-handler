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

class UnprocessedResponseEvent extends Event
{
    /** @var  string */
    protected $serviceName;

    /**
     * @var mixed
     */
    protected $unprocessedResponse;

    /**
     * @param $unprocessedResponse
     */
    public function __construct($unprocessedResponse)
    {
        $this->unprocessedResponse = $unprocessedResponse;
    }

    /**
     * @return mixed
     */
    public function getUnprocessedResponse()
    {
        return $this->unprocessedResponse;
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