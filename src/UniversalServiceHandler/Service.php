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

use Optionable;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use UniversalServiceHandler\Event\RequestEvent;
use UniversalServiceHandler\Event\ResponseEvent;
use UniversalServiceHandler\Event\UnprocessedRequestEvent;
use UniversalServiceHandler\Event\UnprocessedResponseEvent;
use UniversalServiceHandler\Processor\ProcessorInterface;
use UniversalServiceHandler\TransferClient\TransferClientInterface;

class Service
{
    /** @var  ProcessorInterface */
    protected $requestProcessor;

    /** @var  ProcessorInterface */
    protected $responseProcessor;

    /** @var  TransferClientInterface */
    protected $transferClient;

    /** @var  EventDispatcherInterface */
    protected $dispatcher;

    function __construct($options)
    {
        $options = Optionable::getOptionable($options);
        $this->setupDefaults($options);

        if (!$options->offsetExists('transfer_client')) {
            throw new \RuntimeException('transfer_client parameter is required.');
        }

        if (!$options->offsetExists('request_processor')) {
            throw new \RuntimeException('request_processor parameter is required.');
        }

        if (!$options->offsetExists('response_processor')) {
            throw new \RuntimeException('response_processor parameter is required.');
        }

        if (!$options->offsetExists('dispatcher')) {
            throw new \RuntimeException('dispatcher parameter is required.');
        }

        $this->transferClient = $options['transfer_client'];
        $this->requestProcessor = $options['request_processor'];
        $this->responseProcessor = $options['response_processor'];
        $this->dispatcher = $options['dispatcher'];
    }

    public function callService($unprocessedRequest)
    {
        $dispatcher = $this->dispatcher;

        $unprocessedRequestEvent = new UnprocessedRequestEvent($unprocessedRequest);
        $dispatcher->dispatch(Events::preRequestProcess, $unprocessedRequestEvent);
        $request = $this->requestProcessor->process($unprocessedRequest);
        $processedRequestEvent = new RequestEvent($request);
        $dispatcher->dispatch(Events::postRequestProcess, $processedRequestEvent);

        $unprocessedResponse = $this->transferClient->callService($request);

        $unprocessedResponseEvent = new UnprocessedResponseEvent($unprocessedResponse);
        $dispatcher->dispatch(Events::preResponseProcess, $unprocessedResponseEvent);
        $response = $this->responseProcessor->process($unprocessedResponse);
        $responseEvent = new ResponseEvent($response);
        $dispatcher->dispatch(Events::postResponseProcess, $responseEvent);

        return $response;
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getDispatcher()
    {
        return $this->dispatcher;
    }

    protected function setupDefaults(Optionable $options)
    {
        $options->setDefaultOption('dispatcher', new EventDispatcher());

        return $options;
    }
}