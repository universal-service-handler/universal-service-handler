<?php
/*
 * @author Zsolt Javorszky
 * @author Sandor Legoza
 * @copyright 2013
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UniversalServiceHandler\TransferClient;

use Optionable;
use UniversalServiceHandler\TransferClient\TransferClientInterface;

class CurlTransferClient implements TransferClientInterface
{
    protected $curlOptions;

    function __construct($options)
    {
        $options = Optionable::getOptionable($options);
        $options = $this->setupDefaults($options);

        $this->curlOptions = $options['options'];
    }

    public function callService($request)
    {
        $curlOptions = $this->curlOptions;
        $curlOptions[CURLOPT_POSTFIELDS] = $request;

        $ch = curl_init();
        curl_setopt_array($ch, $curlOptions);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new \RuntimeException('Curl error: ' . curl_error($ch));
        }

        curl_close($ch);

        return $response;
    }

    protected function setupDefaults(Optionable $options)
    {
        $options->setDefaultOption('options', array());

        return $options;
    }
}
