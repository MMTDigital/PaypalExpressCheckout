<?php

use PaypalExpressCheckout\Request\SetExpressCheckout;

class SetExpressCheckoutTest extends PHPUnit_Framework_TestCase
{
    //SetExpressCheckout response
    protected $_object = null;

    public function setUp()
    {
        $this->_object = new SetExpressCheckout();
    }

    public function testSandbox()
    {
        $this->assertInstanceOf('PaypalExpressCheckout\Request\SetExpressCheckout', $this->_object->setSandbox(true));
        $this->assertEquals(true, $this->_object->sandbox);
    }

    /**
     * NB: Currently used for nothing...
     */
    public function testDebug()
    {
        $this->assertInstanceOf('PaypalExpressCheckout\Request\SetExpressCheckout', $this->_object->setDebug(true));
    }

    public function testSetUsername()
    {
        $this->assertInstanceOf('PaypalExpressCheckout\Request\SetExpressCheckout', $this->_object->setUsername('foo'));
    }

    public function testSetPassword()
    {
        $this->assertInstanceOf('PaypalExpressCheckout\Request\SetExpressCheckout', $this->_object->setPassword('bar'));
    }

    public function testSetSignature()
    {
        $this->assertInstanceOf('PaypalExpressCheckout\Request\SetExpressCheckout', $this->_object->setSignature('faz'));
    }

    public function testSetQueryParameters()
    {
        $this->assertInstanceOf('PaypalExpressCheckout\Request\SetExpressCheckout', $this->_object->setQueryParameters(array()));
        $this->assertFalse($this->_object->setQueryParameters('blah'));
    }

    public function testSetQueryParameter()
    {
        $this->assertFalse($this->_object->setQueryParameter('', 'foo'));
        $this->assertInstanceOf('PaypalExpressCheckout\Request\SetExpressCheckout', $this->_object->setQueryParameter('boo', 'foo'));
    }

    public function testIsValid()
    {
        $this->_object  ->setQueryParameter('RETURNURL', 'http://www.example.com/success.php')
                        ->setQueryParameter('PAYMENT_REQUEST_0_NOTIFYURL', 'http://www.example.com/notify.php')
                        ->setQueryParameter('CANCELURL', 'http://www.example.com/notify.php')

                        ->setQueryParameter('L_BILLINGTYPE0', 'RecurringPayments')
                        ->setQueryParameter('L_BILLINGAGREEMENTDESCRIPTION0', 'Re-occurring Payment for a subscription')

                        ->setQueryParameter('L_PAYMENTREQUEST_0_AMT0', 24.00)
                        ->setQueryParameter('L_PAYMENTREQUEST_0_NAME0', 'My Subscription')
                        ->setQueryParameter('L_PAYMENTREQUEST_0_QTY0', 1)
                        ->setQueryParameter('L_PAYMENTREQUEST_0_NUMBER0', 0)

                        ->setQueryParameter('PAYMENTREQUEST_0_PAYMENTACTION', 'Sale')
                        ->setQueryParameter('PAYMENTREQUEST_0_AMT', 24.00)
                        ->setQueryParameter('PAYMENTREQUEST_0_CURRENCYCODE', 'GBP')
                        ->setQueryParameter('PAYMENTREQUEST_0_DESC0', 'My product description')

                        ->setUsername('sdk-three_api1.sdk.com')
                        ->setPassword('QFZCWN5HZM8VBG7Q')
                        ->setSignature('A-IzJhZZjhg29XQ2qnhapuwxIDzyAZQ92FRP5dqBzVesOkzbdUONzmOU');

        $this->assertTrue($this->_object->isValid());
    }

    public function testDetermineMissingFields()
    {
        $this->assertFalse($this->_object->isValid());
        $missing = $this->_object->determineMissingFields();
        $this->assertTrue(is_array($missing));
        $this->assertTrue(count($missing) === 10);
    }

    public function testGetPayPalURL()
    {
        $this->_object->setSandbox(true);
        $this->assertEquals('https://api-3t.sandbox.paypal.com/nvp', $this->_object->getPaypalUrl());

        $this->_object->setSandbox(false);
        $this->assertEquals('https://api-3t.paypal.com/nvp', $this->_object->getPaypalUrl());
    }
}
