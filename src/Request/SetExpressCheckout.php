<?php

namespace PaypalExpressCheckout\Request;
use PaypalExpressCheckout\Request;

/**
 * Class SetExpressCheckout
 * @link https://cms.paypal.com/uk/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_SetExpressCheckout
 *
 */
class SetExpressCheckout extends Request
{
    const METHOD = 'SetExpressCheckout';

    protected $_requiredParams = array('RETURNURL', 'PAYMENT_REQUEST_0_NOTIFYURL', 'CANCELURL', 'L_BILLINGTYPE0', 'L_BILLINGAGREEMENTDESCRIPTION0', 'PAYMENTREQUEST_0_AMT', 'PAYMENTREQUEST_0_CURRENCYCODE');
    protected $_optionalParams = array('L_PAYMENTREQUEST_0_AMT0', 'PAYMENTREQUEST_0_DESC0', 'L_PAYMENTREQUEST_0_NUMBER0', 'L_PAYMENTREQUEST_0_NAME0', 'L_PAYMENTREQUEST_0_QTY0', 'PAYMENTREQUEST_0_MAXAMT');


    public function __construct()
    {

    }
}
