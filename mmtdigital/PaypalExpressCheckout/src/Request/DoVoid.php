<?php

namespace PaypalExpressCheckout\Request;
use PaypalExpressCheckout\Request;

/**
 * Class DoVoid
 *
 * @link https://cms.paypal.com/uk/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_DoVoid
 *
 */
class DoVoid extends Request
{
    const METHOD = 'DoVoid';
    protected $_requiredParams = array('AUTHORIZATIONID');
    protected $_optionalParams = array('NOTE');

    public function __construct()
    {

    }
}
