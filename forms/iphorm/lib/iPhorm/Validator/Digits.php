<?php

/**
 * Digits Validator
 *
 * Checks whether or not the value contains only digits
 */
class iPhorm_Validator_Digits extends iPhorm_Validator_Abstract
{
    /**
     * Whether to allow white space characters; off by default
     *
     * @var boolean
     */
    protected $_allowWhiteSpace = false;

    /**
     * Class constructor
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        if (array_key_exists('allowWhiteSpace', $options)) {
            $this->setAllowWhiteSpace($options['allowWhiteSpace']);
        }
    }

    /**
     * Returns true if the given value contains only digits.
     * Return false otherwise.
     *
     * @param string $value
     * @return boolean
     */
    public function isValid($value)
    {
        $value = (string) $value;

        $digitsFilter = new iPhorm_Filter_Digits(array(
            'allowWhiteSpace' => $this->_allowWhiteSpace
        ));

        if ($value !== $digitsFilter->filter($value)) {
            $this->addMessage('Only digits are allowed');
            return false;
        }

        return true;
    }

    /**
     * Whether or not to allow white space
     *
     * @param boolean $flag
     * @return iPhorm_Validator_Digits
     */
    public function setAllowWhiteSpace($flag)
    {
        $this->_allowWhiteSpace = (bool) $flag;
        return $this;
    }

    /**
     * Is white space allowed?
     *
     * @return boolean
     */
    public function getAllowWhiteSpace()
    {
        return $this->_allowWhiteSpace;
    }
}