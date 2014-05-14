<?php
/*
 * @author Zsolt Javorszky
 * @author Sandor Legoza
 * @copyright 2013
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UniversalServiceHandler\Processor;

use Optionable;
use UniversalServiceHandler\Response\Response;

class ResponseProcessor implements ProcessorInterface
{
    protected $errorMapper;
    protected $dataMapper;
    protected $statusMapper;
    protected $response;
    protected $responseValidator;

    function __construct($options)
    {
        $options = Optionable::getOptionable($options);
        $this->setupDefaults($options);

        if (!$options->offsetExists('error_mapper')) {
            throw new \RuntimeException('error_mapper parameter is required.');
        }

        $this->errorMapper = $options['error_mapper'];

        if (!$options->offsetExists('data_mapper')) {
            throw new \RuntimeException('data_mapper parameter is required.');
        }

        $this->dataMapper = $options['data_mapper'];

        if (!$options->offsetExists('status_mapper')) {
            throw new \RuntimeException('status_mapper parameter is required.');
        }

        $this->statusMapper = $options['status_mapper'];

        $this->response = $options['response'];
    }

    public function process($unprocessedData)
    {
        if ($this->validateResponse($unprocessedData) === false) {
            throw new \RuntimeException('Processing response failed. Response is not valid.');
        }

        $errors = $this->errorMapper->map($unprocessedData);
        $mappedData = $this->dataMapper->map($unprocessedData);
        $status = $this->statusMapper->map($unprocessedData);

        $response = $this->response;
        $response->setData($mappedData);
        $response->setErrors($errors);
        $response->setStatus($status);

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
        $options->setDefaultOption('response', new Response());

        return $options;
    }
}