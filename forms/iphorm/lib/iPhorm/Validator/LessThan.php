<?php

/**
 * LessThan Validator
 *
 * Checks whether or not the given value is less than the given maximum
 */
class iPhorm_Validator_LessThan extends iPhorm_Validator_Abstract
{
    /**
     * Maximum value
     *
     * @var mixed
     */
    protected $_max;

    /**
     * Class constructor
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        if (array_key_exists('max', $options)) {
            $this->setMax($options['max']);
        } else {
            throw new Exception("Missing option 'max'");
        }
    }

    /**
     * Returns true if and only if $value is less than max option
     *
     * @param string $value
     * @return boolean
     */
    public function isValid($value)
    {
        if ($this->_max <= $value) {
            $this->addMessage("'$value' is not less than $this->_max");
            return false;
        }

        return true;
    }

    /**
     * Sets the maximum value
     *
     * @param mixed $max
     * @return iPhorm_Validator_LessThan
     */
    public function setMax($max)
    {
        $this->_max = $max;
        return $this;
    }

    /**
     * Get the maximum value
     *
     * @return mixed
     */
    public function getMax()
    {
        return $this->_max;
    }
}