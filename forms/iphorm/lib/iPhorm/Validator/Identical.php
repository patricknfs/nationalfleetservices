<?php

/**
 * Identical Validator
 *
 * Checks whether or not the given value is identical to the set token
 */
class iPhorm_Validator_Identical extends iPhorm_Validator_Abstract
{
    /**
     * The token to check
     *
     * @var mixed
     */
    protected $_token;

    /**
     * Whether to check type as well as value
     *
     * @var boolean
     */
    protected $_strict = true;

    /**
     * Class constructor
     *
     * @param mixed $spec Token or array of options
     */
    public function __construct($spec)
    {
        if (is_array($spec) && array_key_exists('token', $spec)) {
            if (array_key_exists('strict', $spec)) {
                $this->setStrict($token['strict']);
            }

            $this->setToken($spec['token']);
        } else if ($spec !== null) {
            $this->setToken($spec);
        }

        if ($this->getToken() === null) {
            throw new Exception('Token required for Identical validator');
        }
    }

    /**
     * Returns true if the given value is equal to the set value
     * Return false otherwise.
     *
     * @param string $value
     * @return boolean
     */
    public function isValid($value)
    {
        $token = $this->getToken();
        $strict = $this->getStrict();

        if (($strict && ($value !== $token)) || (!$strict && ($value != $token))) {
            $this->addMessage('Value does not match');
            return false;
        }

        return true;
    }

    /**
     * Set the token
     *
     * @param mixed $token
     * @return iPhorm_Validator_Identical
     */
    public function setToken($token)
    {
        $this->_token = $token;
        return $this;
    }

    /**
     * Get the token
     *
     * @return mixed
     */
    public function getToken()
    {
        return $this->_token;
    }

    /**
     * Set the strict flag
     *
     * @param boolean $strict
     * @return iPhorm_Validator_Identical
     */
    public function setStrict($strict)
    {
        $this->_strict = $strict;
        return $this;
    }

    /**
     * Get the strict flag
     *
     * @return boolean
     */
    public function getStrict()
    {
        return $this->_strict;
    }
}