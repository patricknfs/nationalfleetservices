<?php

class iPhorm_Element_File extends iPhorm_Element
{
    /**
     * Whether or not the element should be hidden from the
     * notification email
     *
     * @var boolean
     */
    protected $_isHidden = true;

    /**
     * File upload validator
     *
     * @var iPhorm_Validator_FileUpload
     */
    protected $_fileUploadValidator;

    /**
     * Whether or not to attach any uploads to the notification email
     *
     * @var boolean
     */
    protected $_attach = true;

    /**
     * Whether or not to save any uploaded files to the server
     *
     * @var boolean
     */
    protected $_save = true;

    /**
     * The path to save the uploaded files
     *
     * @var string
     */
    protected $_savePath = '';

    /**
     * Class constructor
     *
     * @param string $name
     * @param string $label
     * @param array $options
     */
    public function __construct($name, $label = '', array $options = array())
    {
        parent::__construct($name, $label);

        $this->_fileUploadValidator = new iPhorm_Validator_FileUpload(array(
            'name' => $this->getName()
        ));
        $this->addValidator($this->_fileUploadValidator);

        if (array_key_exists('allowedExtensions', $options)) {
            $this->_fileUploadValidator->setAllowedExtensions($options['allowedExtensions']);
        }

        if (array_key_exists('maximumFileSize', $options)) {
            $this->_fileUploadValidator->setMaxFileSize($options['maximumFileSize']);
        }

        if (array_key_exists('required', $options)) {
            $this->_fileUploadValidator->setRequired($options['required']);
        }

        if (array_key_exists('attach', $options)) {
            $this->setAttach($options['attach']);
        }

        if (array_key_exists('save', $options)) {
            $this->setSave($options['save']);
        }
    }

    /**
     * Get this elements file upload validator
     *
     * @return iPhorm_Validator_FileUpload
     */
    public function getFileUploadValidator()
    {
        return $this->_fileUploadValidator;
    }

    /**
     * Is the uploaded file valid?
     *
     * @param string $value The value to check
     * @param array $context The other submitted form values
     * @return boolean True if valid, false otherwise
     */
    public function isValid($value, $context = null)
    {
        $this->_errors = array();
        $valid = true;

        foreach ($this->getValidators() as $validator) {
            if ($validator->isValid($value, $context)) {
                continue;
            } else {
                $errors = $validator->getMessages();
                $valid = false;
            }

            $this->_errors = array_merge($this->_errors, $errors);
        }

        return $valid;
    }

    /**
     * Sets whether or not the uploaded files for this element
     * should be attached to the notification email
     *
     * @param boolean $flag
     * @return iPhorm_Element_File
     */
    public function setAttach($flag)
    {
        $this->_attach = (bool) $flag;
        return $this;
    }

    /**
     * Should the uploaded files be attached to the notification
     * email?
     *
     * @return boolean
     */
    public function getAttach()
    {
        return $this->_attach;
    }

    /**
     * Sets whether or not the uploaded files for this element should
     * be saved to the server
     *
     * @param boolean $flag
     * @return iPhorm_Element_File
     */
    public function setSave($flag)
    {
        $this->_save = (bool) $flag;
        return $this;
    }

    /**
     * Should the uploaded files be saved to the server?
     *
     * @return boolean
     */
    public function getSave()
    {
        return $this->_save;
    }

    /**
     * Set the upload save path for uploaded files, this should be
     * the absolute path on disk
     *
     * @param string $savePath
     */
    public function setSavePath($savePath)
    {
        $this->_savePath = $savePath;
    }

    /**
     * Get the upload save path
     *
     * @return string
     */
    public function getSavePath()
    {
        return $this->_savePath;
    }

    /**
     * Does the element have a save path?
     *
     * @return boolean
     */
    public function hasSavePath()
    {
        return strlen($this->_savePath) > 0;
    }
}