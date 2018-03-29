<?php

/**
 * GreaterThan Validator
 *
 * Checks whether or not the given value is greater than the given minimum
 */
class iPhorm_Validator_GreaterThan extends iPhorm_Validator_Abstract
{
    /**
     * Minimum value
     *
     * @var mixed
     */
    protected $_min;

    /**
     * Class constructor
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        if (array_key_exists('min', $options)) {
            $this->setMin($options['min']);
        }

        if ($this->getMin() === null) {
            throw new Exception("Missing option 'min'");
        }
    }

    /**
     * Returns true if and only if $value is greater than min option
     *
     * @param string $value
     * @return boolean
     */
    public function isValid($value)
    {
        if ($this->_min >= $value) {
            $this->addMessage("'$value' is not greater than $this->_min");
            return false;
        }

        return true;
    }

    /**
     * Sets the minimum value
     *
     * @param mixed $min
     * @return iPhorm_Validator_GreaterThan
     */
    public function setMin($min)
    {
        $this->_min = $min;
        return $this;
    }

    /**
     * Get the minimum value
     *
     * @return mixed
     */
    public function getMin()
    {
        return $this->_min;
    }
}