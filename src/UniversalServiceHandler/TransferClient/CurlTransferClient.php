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
use UniversalServiceHandler\TransferClient\Exceptions\CurlTransferClientException;
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
        $error = curl_errno($ch);

        if($error){
            throw new CurlTransferClientException('Curl errorcode : ' . $error . ' Message: ' . curl_error($ch));
        }

        curl_close($ch);

        return $response;
    }

    public function getCurlOptions()
    {
        return $this->curlOptions;
    }

    protected function setupDefaults(Optionable $options)
    {
        $options->setDefaultOption('options', array());

        return $options;
    }
}
