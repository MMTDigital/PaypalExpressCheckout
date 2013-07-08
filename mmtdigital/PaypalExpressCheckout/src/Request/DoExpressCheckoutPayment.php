<?php

namespace PaypalExpressCheckout\Request;
use PaypalExpressCheckout\Request;

/**
 * Class DoExpressCheckoutPayment
 * @link https://cms.paypal.com/uk/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_DoExpressCheckoutPayment
 */
class DoExpressCheckoutPayment extends Request
{
    const METHOD = 'DoExpressCheckoutPayment';

    protected $_requiredParams = array('TOKEN', 'PAYMENTACTION', 'PAYERID', 'PAYMENTREQUEST_0_AMT', 'PAYMENTREQUEST_0_CURRENCYCODE');
    protected $_optionalParams = array();

    public function __construct()
    {

    }
}
