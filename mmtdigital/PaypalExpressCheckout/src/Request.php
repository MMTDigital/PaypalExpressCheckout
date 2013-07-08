<?php

namespace PaypalExpressCheckout;
use PaypalExpressCheckout\Response;

abstract class Request
{
    const VERSION = 97.0;
    public $sandbox = true;
    protected $_requiredParams = array();
    protected $_optionalParams = array();
    protected $_debug = false;
    protected $_sandboxEndPoint = 'https://api-3t.sandbox.paypal.com/nvp';
    protected $_endPoint = 'https://api-3t.paypal.com/nvp';
    protected $_queryParameters = array();
    private $_username = null;
    private $_password = null;
    private $_signature = null;

    /**
     * Set whether we're sending the user to the sandbox
     *
     * @param $sandbox
     */
    public function setSandbox($sandbox = true)
    {
        $this->sandbox = (bool)$sandbox;
    }

    /**
     * Determines if we should output debugging information
     *
     * @param $debug
     */
    public function setDebug($debug = false)
    {
        $this->_debug = (bool)$debug;
    }

    /**
     * Set the paypal merchant username
     *
     * @param null $username
     * @return $this
     */
    public function setUsername($username = null)
    {
        $this->_username = $username;
        return $this;
    }

    /**
     * Set the paypal merchant password
     *
     * @param null $password
     * @return $this
     */
    public function setPassword($password = null)
    {
        $this->_password = $password;
        return $this;
    }

    /**
     * Set the paypal merchant signature
     *
     * @param null $signature
     * @return $this
     */
    public function setSignature($signature = null)
    {
        $this->_signature = $signature;
        return $this;
    }

    /**
     * Override the query parameters (in bulk) destined for ebay
     *
     * @param array $params
     * @return $this|bool
     */
    public function setQueryParameters($params = array())
    {
        if (!is_array($params))
        {
            return false;
        }

        $this->_queryParameters = array_change_key_case($params, CASE_UPPER);
        array_filter($this->_queryParameters);
        return $this;
    }

    /**
     * Override a single query parameter
     *
     * @param string $key
     * @param string $value
     * @return $this|bool
     */
    public function setQueryParameter($key = '', $value = '')
    {
        if (strlen($key) === 0)
        {
            return false;
        }

        $this->_queryParameters[strtoupper($key)] = $value;
        return $this;
    }

    /**
     * Send the request to ebay, returns false on failure or a response object on success.
     *
     * @return Response
     * @throws Exception
     */
    public function send()
    {
        $queryString = $this->buildQueryString();

        $headers = array(
            'method' => 'POST',
            'content' => $this->buildQueryString(),
            'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
            "Content-Length: " . strlen($queryString) . "\r\n\r\n"
        );

        $request = file_get_contents(
            $this->getPaypalUrl(),
            false,
            stream_context_create(array('http' => $headers))
        );

        return new Response($request);
    }

    /**
     * Build the query string that will be sent to ebay (includes username, password, signature)
     *
     * @return string
     */
    protected function buildQueryString()
    {
        $parameters = $this->_queryParameters;
        $parameters['USER'] = $this->_username;
        $parameters['PWD'] = $this->_password;
        $parameters['SIGNATURE'] = $this->_signature;
        $parameters['VERSION'] = self::VERSION;
        $parameters['METHOD'] = $this::METHOD;
        return http_build_query($parameters);
    }

    /**
     * Validates the current request object
     *
     * @return bool
     */
    public function isValid()
    {
        return (count($this->determineMissingFields()) === 0);
    }

    /**
     * Returns an array of missing required fields for the request object
     *
     * @return array
     */
    public function determineMissingFields()
    {
        $missing = array();

        foreach ($this->_requiredParams AS $param)
        {
            if (!isset($this->_queryParameters[$param]) || strlen($this->_queryParameters[$param]) === 0)
            {
                $missing[] = $param;
            }
        }

        if (empty($this->_username)) {
            $missing[] = 'USER';
        }

        if (empty($this->_password)) {
            $missing[] = 'PWD';
        }

        if (empty($this->_signature)) {
            $missing[] = 'SIGNATURE1';
        }

        return $missing;
    }

    /**
     * Returns the correct paypal URL depending on the sandbox status.
     *
     * @return string
     */
    public function getPaypalUrl() {
        return ($this->sandbox ? $this->_sandboxEndPoint : $this->_endPoint);
    }
}
