<?php
/*
 * @author Zsolt Javorszky
 * @author Sandor Legoza
 * @copyright 2013
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UniversalServiceHandler\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\EventDispatcher\Event;
use UniversalServiceHandler\Event\RequestEvent;
use UniversalServiceHandler\Event\ResponseEvent;
use UniversalServiceHandler\Event\UnprocessedRequestEvent;
use UniversalServiceHandler\Event\UnprocessedResponseEvent;

class LogListener
{
    /** @var  LoggerInterface */
    protected $logger;

    /** @var int */
    protected $logLevel;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logLevel = Logger::DEBUG;
        $this->logger = $logger;
    }

    public function preRequestProcess(UnprocessedRequestEvent $event)
    {
        $this->logger->log($this->logLevel, print_r($event->getUnprocessedRequest(), true));
    }

    public function postRequestProcess(RequestEvent $event)
    {
        $this->logger->log($this->logLevel, print_r($event->getRequest(), true));
    }

    public function preResponseProcess(UnprocessedResponseEvent $event)
    {
        $this->logger->log($this->logLevel, print_r($event->getUnprocessedResponse(), true));
    }

    public function postResponseProcess(ResponseEvent $event)
    {
        $this->logger->log($this->logLevel, print_r($event->getResponse(), true));
    }

    /**
     * @param int $logLevel
     */
    public function setLogLevel($logLevel)
    {
        $this->logLevel = $logLevel;
    }

    /**
     * @return int
     */
    public function getLogLevel()
    {
        return $this->logLevel;
    }
}