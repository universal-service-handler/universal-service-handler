<?php
namespace UniversalServiceHandler\Tests\TransferClient;

use UniversalServiceHandler\Response\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testMap($status, $expectedStatus, $data, $expectedData, $errors, $expectedErrors)
    {
        $response = new Response();
        $response->setStatus($status);
        $response->setData($data);
        $response->setErrors($errors);

        $this->assertEquals($expectedStatus, $response->getStatus());
        $this->assertEquals($expectedData, $response->getData());
        $this->assertEquals($expectedErrors, $response->getErrors());

    }
    public function provider()
    {
        $status = Response::STATUS_SUCCESS;
        $data =  'something';
        $errors = array('error');

        return array(
            array($status, $status, $data, $data, $errors, $errors),
        );
    }
}