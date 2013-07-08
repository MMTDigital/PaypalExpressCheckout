<?php

namespace PaypalExpressCheckout\Request;
use PaypalExpressCheckout\Request;

/**
 * Class GetExpressCheckoutDetails
 * @link https://cms.paypal.com/uk/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_GetExpressCheckoutDetails
 *
 */
class GetExpressCheckoutDetails extends Request
{
    const METHOD = 'GetExpressCheckoutDetails';

    protected $_requiredParams = array('TOKEN');
    protected $_optionalParams = array();

    public function __construct()
    {

    }
}
