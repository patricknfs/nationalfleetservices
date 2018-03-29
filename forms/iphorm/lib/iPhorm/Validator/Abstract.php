<?php

/**
 * Validator Abstract Class
 */
abstract class iPhorm_Validator_Abstract implements iPhorm_Validator_Interface
{
    /**
     * The error messages
     *
     * @var array
     */
    protected $_messages = array();

    /**
     * Get the error messages
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->_messages;
    }

    /**
     * Add an error message
     *
     * @param string $message
     */
    public function addMessage($message)
    {
        $this->_messages[] = $message;
    }
}