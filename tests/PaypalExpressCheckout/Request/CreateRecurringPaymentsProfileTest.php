<?php

use PaypalExpressCheckout\Request\CreateRecurringPaymentsProfile;

class CreateRecurringPaymentsProfileTest extends PHPUnit_Framework_TestCase
{
    protected $_object = null;

    public function setUp()
    {

    }

    public function testConstructor()
    {
        $this->_object = new CreateRecurringPaymentsProfile();
    }
}
