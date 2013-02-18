<?php
namespace UniversalServiceHandler\Processor;

use Optionable;
use UniversalServiceHandler\Processor\ProcessorInterface;
use UniversalServiceHandler\Response\Response;

class ResponseProcessor implements ProcessorInterface
{
    protected $errorMapper;
    protected $responseMapper;
    protected $responseValidator;

    function __construct($options)
    {
        $options = Optionable::getOptionable($options);
        $this->setupDefaults($options);

        if (!$options->offsetExists('error_mapper')) {
            throw new \RuntimeException('error_mapper parameter is required.');
        }

        $this->errorMapper = $options['error_mapper'];

        if (!$options->offsetExists('response_mapper')) {
            throw new \RuntimeException('response_mapper parameter is required.');
        }

        $this->responseMapper = $options['response_mapper'];
    }

    public function process($unprocessedData)
    {
        if ($this->validateResponse($unprocessedData) === false) {
            throw new \RuntimeException('Processing response failed. Response is not valid.');
        }

        $errors = $this->errorMapper->map($unprocessedData);
        $mappedData = $this->responseMapper->map($unprocessedData);

        $response = new Response();
        $response->setData($mappedData);
        $response->setErrors($errors);

        return $response;
    }

    protected function validateResponse($responseOptions)
    {
        if ($this->responseValidator) {
            return $this->responseValidator->validate($responseOptions);
        }

        return true;
    }

    protected function setupDefaults(Optionable $options)
    {
        $options->setDefaultOption('response_validator', null);

        return $options;
    }
}
