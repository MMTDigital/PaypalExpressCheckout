<?php

use PaypalExpressCheckout\Response;

class ResponseTest extends PHPUnit_Framework_TestCase
{
    //SetExpressCheckout response
    protected $_successfulResponse = 'TOKEN=EC%2d9PL11743NP680631L&TIMESTAMP=2013%2d07%2d10T07%3a55%3a19Z&CORRELATIONID=5bcce7ec8ce76&ACK=Success&VERSION=97&BUILD=6733274';

    public function setUp()
    {

    }

    public function testFailedResponse()
    {
        $failedResponse = new Response(false);
        $this->assertFalse($failedResponse->isSuccess());
        $this->assertTrue($failedResponse->isFailure());
        $this->assertEquals(0, count($failedResponse->getParameters()));
        $this->assertFalse($failedResponse->getAck());
        $this->assertFalse($failedResponse->getTimestamp());
        $this->assertFalse($failedResponse->getCorrelationId());
        $this->assertFalse($failedResponse-> getVersion());
        $this->assertFalse($failedResponse->getBuild());
        $this->assertFalse($failedResponse->getParameter('foo'));
    }

    public function testSuccessfulResponse()
    {
        $successResponse = new PaypalExpressCheckout\Response($this->_successfulResponse);
        $this->assertTrue($successResponse->isSuccess());
        $this->assertFalse($successResponse->isFailure());
        $this->assertEquals('EC-9PL11743NP680631L', $successResponse->getParameter('TOKEN'));
        $this->assertEquals(6, count($successResponse->getParameters()));

        $this->assertEquals('Success', $successResponse->getAck());
        $this->assertEquals(1373442919, $successResponse->getTimestamp());
        $this->assertEquals('5bcce7ec8ce76', $successResponse->getCorrelationId());
        $this->assertEquals(97, $successResponse-> getVersion());
        $this->assertEquals(6733274, $successResponse->getBuild());
    }
}
