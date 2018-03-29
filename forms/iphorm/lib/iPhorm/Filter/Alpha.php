<?php

/**
 * Alpha Filter
 *
 * Strips all non-alphabetical characters.
 */
class iPhorm_Filter_Alpha implements iPhorm_Filter_Interface
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
     * Filter everything from the given value except alphabet
     * characters
     *
     * @param string $value The value to filter
     * @return string The filtered value
     */
    public function filter($value)
    {
        $whiteSpace = $this->_allowWhiteSpace ? '\s' : '';

        $pattern = '/[^a-zA-Z' . $whiteSpace . ']/';

        return preg_replace($pattern, '', (string) $value);
    }

    /**
     * Whether or not to allow white space
     *
     * @param boolean $flag
     * @return iPhorm_Filter_Alpha
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