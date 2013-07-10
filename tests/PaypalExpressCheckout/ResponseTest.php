<?php

use PaypalExpressCheckout\Response;

class ResponseTest extends PHPUnit_Framework_TestCase
{
    //SetExpressCheckout response
    protected $_successfulResponse = 'TOKEN=EC%2d9PL11743NP680631L&TIMESTAMP=2013%2d07%2d10T07%3a55%3a19Z&CORRELATIONID=5bcce7ec8ce76&ACK=Success&VERSION=97&BUILD=6733274';
    protected $_errorResponse = 'TIMESTAMP=2013%2d07%2d10T13%3a27%3a51Z&CORRELATIONID=b2da22ead61d9&ACK=Failure&VERSION=97&BUILD=6825724&L_ERRORCODE0=10406&L_SHORTMESSAGE0=Transaction%20refused%20because%20of%20an%20invalid%20argument%2e%20See%20additional%20error%20messages%20for%20details%2e&L_LONGMESSAGE0=The%20PayerID%20value%20is%20invalid%2e&L_SEVERITYCODE0=Error';

    public function setUp()
    {

    }

    public function testFailedResponse()
    {
        $failedResponse = new Response($this->_errorResponse);
        $this->assertFalse($failedResponse->isSuccess());
        $this->assertTrue($failedResponse->isFailure());
        $this->assertEquals(9, count($failedResponse->getParameters()));
        $this->assertEquals('Failure', $failedResponse->getAck());
        $this->assertEquals('b2da22ead61d9', $failedResponse->getCorrelationId());
        $this->assertEquals(97, $failedResponse->getVersion());
        $this->assertEquals(6825724, $failedResponse->getBuild());
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
