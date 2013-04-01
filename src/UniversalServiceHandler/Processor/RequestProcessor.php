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
use UniversalServiceHandler\Processor\ProcessorInterface;

class RequestProcessor implements ProcessorInterface
{
    protected $requestMapper;
    protected $requestValidator;

    function __construct($options)
    {
        $options = Optionable::getOptionable($options);
        $this->setupDefaults($options);

        if (!$options->offsetExists('request_mapper')) {
            throw new \RuntimeException('request_mapper parameter is required.');
        }

        $this->requestMapper = $options['request_mapper'];
    }

    public function process($unprocessedData)
    {
        if ($this->validateRequest($unprocessedData) === false) {
            throw new \RuntimeException('Processing request failed. Request is not valid.');
        }

        $mappedData = $this->requestMapper->map($unprocessedData);

        return $mappedData;
    }

    protected function validateRequest($requestOptions)
    {
        if ($this->requestValidator) {
            return $this->requestValidator->validate($requestOptions);
        }

        return true;
    }

    protected function setupDefaults(Optionable $options)
    {
        $options->setDefaultOption('request_validator', null);

        return $options;
    }
}
