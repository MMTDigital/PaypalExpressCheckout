<?php

namespace PaypalExpressCheckout\Request;
use PaypalExpressCheckout\Request;

/**
 * Class CreateRecurringPaymentsProfile
 * @link https://cms.paypal.com/uk/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_CreateRecurringPayments
 *
 */
class CreateRecurringPaymentsProfile extends Request
{
    const METHOD = 'CreateRecurringPaymentsProfile';

    protected $_requiredParams = array('AMT', 'DESC', 'PROFILESTARTDATE', 'BILLINGPERIOD', 'BILLINGFREQUENCY', 'CURRENCYCODE');
    protected $_optionalParams = array('SUBSCRIBERNAME', 'PROFILEREFERENCE');

    public function __construct()
    {

    }
}
