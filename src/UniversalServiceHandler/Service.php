<?php
namespace UniversalServiceHandler;

use Optionable;

class Service
{
    protected $requestProcessor;
    protected $responseProcessor;
    protected $transferClient;


    function __construct($options)
    {
        $options = Optionable::getOptionable($options);

        if (!$options->offsetExists('transfer_client')) {
            throw new \RuntimeException('transfer_client parameter is required.');
        }

        if (!$options->offsetExists('request_processor')) {
            throw new \RuntimeException('request_processor parameter is required.');
        }

        if (!$options->offsetExists('response_processor')) {
            throw new \RuntimeException('response_processor parameter is required.');
        }

        $this->transferClient = $options['transfer_client'];
        $this->requestProcessor = $options['request_processor'];
        $this->responseProcessor = $options['response_processor'];
    }

    public function callService($requestOptions)
    {
        $processedRequest = $this->requestProcessor->process($requestOptions);
        $unprocessedResponse = $this->transferClient->callService($processedRequest);
        $response = $this->responseProcessor->process($unprocessedResponse);

        return $response;
    }
}
