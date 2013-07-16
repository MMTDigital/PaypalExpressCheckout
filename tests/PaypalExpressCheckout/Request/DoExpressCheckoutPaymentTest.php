<?php

use PaypalExpressCheckout\Request\DoExpressCheckoutPayment;

class DoExpressCheckoutPaymentTest extends PHPUnit_Framework_TestCase
{
    protected $_object = null;

    public function setUp()
    {

    }

    public function testConstructor()
    {
        $this->_object = new DoExpressCheckoutPayment();
    }
}
