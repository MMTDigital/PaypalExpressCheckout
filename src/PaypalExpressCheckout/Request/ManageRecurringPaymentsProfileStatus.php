<?php

namespace PaypalExpressCheckout\Request;
use PaypalExpressCheckout\Request;

/**
 * Class ManageRecurringPaymentsProfileStatus
 * @link https://cms.paypal.com/uk/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_ManageRecurringPaymentsProfileStatus
 *
 */
class ManageRecurringPaymentsProfileStatus extends Request
{
    const METHOD = 'ManageRecurringPaymentsProfileStatus';

    protected $_requiredParams = array('PROFILEID', 'ACTION');
    protected $_optionalParams = array('NOTE');

    public function __construct()
    {

    }
}
