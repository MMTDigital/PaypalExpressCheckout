<?php

namespace PaypalExpressCheckout;

/**
 * Simple holder for the paypal response information. Basically breaks the returned data into
 * a key=>value array for manipulation.
 *
 * Class Response
 */
class Response
{
    protected $parameters = array();
    protected $_response = null;

    public function __construct($result = null)
    {
        if ($result !== false)
        {
            $this->setResponse($result);
        }
    }

    /**
     * Parse the response string and store
     *
     * @param $result string
     * @return $this
     */
    public function setResponse($result = '')
    {
        $this->_response = $result;
        parse_str(urldecode($result), $this->parameters);
        return $this;
    }

    /**
     * Returns an arbitary parameter if its present, false otherwise.2
     *
     * @param string $parameter
     * @return bool|int
     */
    public function getParameter($parameter = '')
    {
        $parameter = strtoupper($parameter);

        if (!isset($this->parameters[$parameter]))
        {
            return false;
        }

        return $this->parameters[$parameter];
    }

    /**
     * Returns all of the parameters
     * 
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Determine if request was a success (complete success not success with warning)
     *
     * @return bool
     */
    public function isSuccess()
    {
        return (isset($this->parameters['ACK']) && (strpos($this->parameters['ACK'], 'Success') !== false));
    }

    /**
     * Determine if request was a failure (complete success not success with warning)
     *
     * @return bool
     */
    public function isFailure()
    {
        return (isset($this->parameters['Failure']) && (strpos($this->parameters['ACK'], 'Failure') !== false));
    }

    /**
     * Returns the acknowledgement status: Success, SuccessWithWarning, Failure, FailureWithWarning
     * Returns false if not set.
     *
     * @return bool|int
     */
    public function getAck()
    {
        if (!isset($this->parameters['ACK']))
        {
            return false;
        }

        return $this->parameters['ACK'];
    }

    /**
     * Return the timestamp of the response
     *
     * @return bool|int
     */
    public function getDate()
    {
        if (!isset($this->parameters['TIMESTAMP']))
        {
            return false;
        }

        return strtotime($this->parameters['TIMESTAMP']);
    }

    /**
     * Returns the correlationId (transaction identifier)
     *
     * @return bool|int
     */
    public function getCorrelationId()
    {
        if (!isset($this->parameters['CORRELATIONID']))
        {
            return false;
        }

        return $this->parameters['CORRELATIONID'];
    }

    /**
     * Returns the version of the API called
     *
     * @return bool|int
     */
    public function getVersion()
    {
        if (!isset($this->parameters['VERSION']))
        {
            return false;
        }

        return (int)$this->parameters['VERSION'];
    }

    /**
     * Get the build version of the API called.
     *
     * @return bool|int
     */
    public function getBuild()
    {
        if (!isset($this->parameters['BUILD']))
        {
            return false;
        }

        return (int)$this->parameters['BUILD'];
    }

    /**
     * Return the timestamp of the request.
     *
     * @return bool
     */
    public function getTimestamp()
    {
        if (!isset($this->parameters['TIMESTAMP']))
        {
            return false;
        }

        return strtotime($this->parameters['TIMESTAMP']);
    }
}
