<?php

/**
 * Recaptcha Validator
 *
 * Checks the given reCAPTCHA answer
 */
class iPhorm_Validator_Recaptcha extends iPhorm_Validator_Abstract
{
    protected $_privateKey;

    protected $_messageTemplates;

    public function __construct($options = null)
    {
        $this->_messageTemplates = array(
            'invalid-site-private-key' => 'Invalid reCAPTCHA private key',
            'invalid-request-cookie' => 'The challenge parameter of the verify script was incorrect',
            'incorrect-captcha-sol' => 'The CAPTCHA solution was incorrect',
            'recaptcha-not-reachable' => 'reCAPTCHA server not reachable'
        );

        if (is_array($options)) {
            if (array_key_exists('privateKey', $options)) {
                $this->_privateKey = $options['privateKey'];
            }
        }

        if ($this->_privateKey == null) {
            throw new Exception('reCAPTCHA private key is required');
        }
    }

    /**
     * Checks the reCAPTCHA answer
     *
     * @param $value The value to check
     * @param $context The other submitted form values
     * @return boolean True if valid false otherwise
     */
    public function isValid($value, $context = null)
    {
        $resp = recaptcha_check_answer($this->_privateKey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) {
            if (array_key_exists($resp->error, $this->_messageTemplates)) {
                $message = $this->_messageTemplates[$resp->error];
            } else {
                $message = $this->_messageTemplates['incorrect-captcha-sol'];
            }
            $this->addMessage($message);
            return false;
        }

        return true;
    }
}