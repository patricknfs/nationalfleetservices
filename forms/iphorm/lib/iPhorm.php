<?php

class iPhorm
{
    /**
     * The elements of the form
     *
     * @var array
     */
    protected $_elements = array();

    /**
     * Character encoding to use
     *
     * @var string
     */
    protected $_charset = 'UTF-8';

    /**
     * Get the character encoding
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->_charset;
    }

    /**
     * Set the character encoding
     *
     * @param string $charset
     */
    public function setCharset($charset)
    {
        $this->_charset = $charset;
    }

    /**
     * Add a single element to the form
     *
     * @param $element iPhorm_Element The element to add
     */
    public function addElement(iPhorm_Element $element)
    {
        $element->setForm($this);
        $this->_elements[$element->getName()] = $element;
    }

    /**
     * Add multiple elements to the form
     *
     * @param $elements array The array of elements
     */
    public function addElements(array $elements)
    {
        foreach ($elements as $element) {
            $this->addElement($element);
        }
    }

    /**
     * Is the form valid?
     *
     * @param array $values The values to check against
     * @return boolean True if valid, false otherwise
     */
    public function isValid(array $values = array())
    {
        $valid = true;

        foreach ($this->getElements() as $element) {
            if ($element->isArray()) {
                $value = $this->_dissolveArrayValue($values, $element->getName());
            } else {
                $value = isset($values[$element->getName()]) ? $values[$element->getName()] : null;
            }

            if (!$element->isValid($value, $values)) {
                $valid = false;
            }
        }

        return $valid;
    }


    /**
     * Get all of the form elements
     *
     * @return array The form elements
     */
    public function getElements()
    {
        return $this->_elements;
    }

    /**
     * Get the elements and any errors they have
     *
     * @return array
     */
    public function getErrors()
    {
        $errors = array();

        foreach ($this->getElements() as $element) {
            $errors[$element->getFullyQualifiedName()] = array('label' => $element->getLabel(), 'errors' => $element->getErrors());
        }

        return $errors;
    }


    /**
     * Encode PHP data in JSON
     *
     * @param mixed $data The data to encode
     * @return string The JSON encoded response
     */
    public function jsonEncode($data)
    {
        require_once IPHORM_ROOT . '/lib/JSON.php';
        $json = new Services_JSON();
        return $json->encode($data);
    }

    /**
     * Get the values of all fields
     *
     * @return array The values of all fields
     */
    public function getValues()
    {
        $values = array();

        foreach ($this->getElements() as $element) {
            $values[$element->getName()] = $element->getValue();
        }

        return $values;
    }

    /**
     * Get the values of a single field
     *
     * @param string $name The name of the field
     * @return mixed The value of the given field or null
     */
    public function getValue($name)
    {
        $value = null;

        foreach ($this->getElements() as $element) {
            if ($element->getName() == $name) {
                $value = $element->getValue();
            }
        }

        return $value;
    }

    /**
     * Escapes a value for output to browser.  Uses
     * the set character encoding.
     *
     * @param string $value The value to escape
     * @return string The escaped value
     */
    public function escape($value)
    {
        return htmlentities($value, ENT_COMPAT, $this->getCharset());
    }

    /**
     * Internal autoloader for spl_autoload_register().
     *
     * @param string $class
     */
    public static function autoload($class)
    {
        // Don't interfere with other autoloaders
        if (strpos($class, 'iPhorm') !== 0) {
            return false;
        }

        $path = dirname(__FILE__). '/' . str_replace('_', '/', $class).'.php';

        if (!file_exists($path)) {
            return false;
        }

        require_once $path;
    }

    /**
     * Format a message with wrapping HTML <div> with classes. The
     * message should be escaped beforehand for display in the
     * browser, using htmlentities() for example
     *
     * @param string $message
     * @param string $type Additional class to add to the wrapper
     * @return string The HTML
     */
    public function formatMessage($message, $type = '')
    {
        $classes = array('message');
        if ($type !== '') {
            $classes[] = $type . '-message';
        }

        $xhtml = '<div class="' . join(' ', $classes) . '">' . $message . '</div>';

        return $xhtml;
    }

    /**
     * Configure autoloading of iPhorm classes
     */
    public static function registerAutoload()
    {
        spl_autoload_register(array('iPhorm', 'autoload'));
    }

    /**
     * Generate a filename that does not already exist in the given path
     *
     * @return string
     */
    public function generateFilename($path, $filename)
    {
        $count = 1;
        $newFilenamePath = $path . $filename;

        while (file_exists($newFilenamePath)) {
            $newFilename = $count++ . $filename;
            $newFilenamePath = $path . $newFilename;
        }

        return $newFilename;
    }

    /**
     * Replace all placeholder values in a string with their
     * form value equivalents
     *
     * @param string $string
     * @return string
     */
    public function replacePlaceholderValues($string)
    {
        return preg_replace_callback('/%.+%/U', array($this, '_getPlaceholderValue'), $string);
    }

    /**
     * Get the form value of a single placeholder
     *
     * @param string $matches
     * @return string The the form value
     */
    protected function _getPlaceholderValue($matches)
    {
        $match = $matches[0];

        $match = preg_replace('/(^%|%$)/', '', $match);

        $value = $this->getValue($match);

        if (is_array($value)) {
            $value = join(', ', $value);
        }

        return $value;
    }

    /**
     * Get the pretty version of the form element name. Translates
     * the machine name to a more human readable format.  E.g.
     * "email_address" becomes "Email address".
     *
     * @param string $name The form element name
     * @return string The pretty version of the name
     */
    protected function _prettyName($name)
    {
        $prettyName = str_replace(array('-', '_'), ' ', $name);
        $prettyName = ucfirst($prettyName);
        return $prettyName;
    }

    /**
     * Extract the value by walking the array using given array path.
     *
     * Given an array path such as foo[bar][baz], returns the value of the last
     * element (in this case, 'baz').
     *
     * @param  array $value Array to walk
     * @param  string $arrayPath Array notation path of the part to extract
     * @return string
     */
    protected function _dissolveArrayValue($value, $arrayPath)
    {
        // As long as we have more levels
        while ($arrayPos = strpos($arrayPath, '[')) {
            // Get the next key in the path
            $arrayKey = trim(substr($arrayPath, 0, $arrayPos), ']');

            // Set the potentially final value or the next search point in the array
            if (isset($value[$arrayKey])) {
                $value = $value[$arrayKey];
            }

            // Set the next search point in the path
            $arrayPath = trim(substr($arrayPath, $arrayPos + 1), ']');
        }

        if (isset($value[$arrayPath])) {
            $value = $value[$arrayPath];
        }

        return $value;
    }
}