<?php

use PaypalExpressCheckout\Request\GetExpressCheckoutDetails;

class GetExpressCheckoutDetailsTest extends PHPUnit_Framework_TestCase
{
    protected $_object = null;

    public function setUp()
    {

    }

    public function testConstructor()
    {
        $this->_object = new GetExpressCheckoutDetails();
    }
}
