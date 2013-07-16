<?php

use PaypalExpressCheckout\Request\ManageRecurringPaymentsProfileStatus;

class ManageRecurringPaymentsProfileStatusTest extends PHPUnit_Framework_TestCase
{
    protected $_object = null;

    public function setUp()
    {

    }

    public function testConstructor()
    {
        $this->_object = new ManageRecurringPaymentsProfileStatus();
    }
}
