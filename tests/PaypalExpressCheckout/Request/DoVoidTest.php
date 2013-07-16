<?php

use PaypalExpressCheckout\Request\DoVoid;

class DoVoidTest extends PHPUnit_Framework_TestCase
{
    protected $_object = null;

    public function setUp()
    {

    }

    public function testConstructor()
    {
        $this->_object = new DoVoid();
    }
}
