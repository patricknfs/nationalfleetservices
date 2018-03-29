<?php

/**
 * String Length Validator
 *
 * Checks whether or not the number of characters in the given value are between
 * the set minimum and maximum
 */
class iPhorm_Validator_StringLength extends iPhorm_Validator_Abstract
{
    /**
     * Minimum length
     *
     * @var integer
     */
    protected $_min;

    /**
     * Maximum length.  If null, there is no maximum length
     *
     * @var integer|null
     */
    protected $_max;

    /**
     * Class constructor
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        if (!array_key_exists('min', $options)) {
            $options['min'] = 0;
        }
        $this->setMin($options['min']);

        if (array_key_exists('max', $options)) {
            $this->setMax($options['max']);
        }
    }

    /**
     * Returns true if and only if the string length of $value is at least the min option and
     * no greater than the max option (when the max option is not null).
     *
     * @param string $value
     * @return boolean
     */
    public function isValid($value)
    {
        if (!is_string($value)) {
            $this->addMessage('Invalid type given, value should be a string');
            return false;
        }

        $length = strlen(utf8_decode($value));

        if ($length < $this->_min) {
            $this->addMessage("Value must be at least $this->_min characters long");
            return false;
        }

        if ($this->_max !== null && $this->_max < $length) {
            $this->addMessage("Value must be less than $this->_max characters long");
            return false;
        }

        return true;
    }

    /**
     * Set the minimum length
     *
     * @param integer $min
     * @return iPhorm_Validator_StringLength
     */
    public function setMin($min)
    {
        if ($this->_max !== null && $min > $this->_max) {
            throw new Exception('The minimum must be less than or equal to the maximum length');
        } else {
            $this->_min = max(0, (int) $min);
        }

        return $this;
    }

    /**
     * Get the minimum length
     *
     * @return integer
     */
    public function getMin()
    {
        return $this->_min;
    }

    /**
     * Set the maximum length
     *
     * @param integer $max
     * @return iPhorm_Validator_StringLength
     */
    public function setMax($max)
    {
        if ($max < $this->_min) {
            throw new Exception('The maximum must be greater than or equal to the minimum length');
        } else {
            $this->_max = (int) $max;
        }

        return $this;
    }

    /**
     * Get the maximum length
     *
     * @return integer|null
     */
    public function getMax()
    {
        return $this->_max;
    }
}