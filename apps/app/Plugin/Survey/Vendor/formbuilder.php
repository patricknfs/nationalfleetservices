<?php

/**
 * @package 	jquery.Formbuilder
 * @author 		Michael Botsko
 * @copyright 	2009, 2012 Trellis Development, LLC
 *
 * This PHP object is the server-side component of the jquery formbuilder
 * plugin. The Formbuilder allows you to provide users with a way of
 * creating a formand saving that structure to the database.
 *
 * Using this class you can easily prepare the structure for storage,
 * rendering the xml file needed for the builder, or render the html of the form.
 *
 * This package is licensed using the Mozilla Public License 1.1
 *
 * We encourage comments and suggestion to be sent to mbotsko@trellisdev.com.
 * Please feel free to file issues at http://github.com/botskonet/jquery.formbuilder/issues
 * Please feel free to fork the project and provide patches back.
 */

/**
 * @abstract This class is the server-side component that handles interaction with
 * the jquery formbuilder plugin.
 * @package jquery.Formbuilder
 */


class Formbuilder {

    /**
     * @var array Holds the form id and array form structure
     * @access protected
     */
    protected $_form_array;

    /**
     * Property Message Warning
     * @var string
     */
    protected $_warning_message;
    /**
     * Property Message Warning
     * @var string
     */
    protected $_controls_per_page = 10;
    /**
     * Property Preview State
     * @var boolean
     */
    protected $_preview_state = false;

    /**
     * Constructor, loads either a pre-serialized form structure or an incoming POST form
     * @param array $containing_form_array
     * @access public
     */
    public function __construct($form = false) {

        $form = is_array($form) ? $form : array();

        // Set the serialized structure if it's provided
        // otherwise, store the source
        if (array_key_exists('form_structure', $form)) {
            $form_structure = json_decode($form['form_structure']);
            if(!empty($form_structure)){
                $form['form_structure'] = $this->objectToArray($form_structure);
                $this->_form_array = $form;
            }
        } else if (array_key_exists('frmb', $form)) {
            $_form = array();
            $_form['form_id'] = (!isset($form['form_id']) || $form['form_id'] == "undefined") ? false : $form['form_id'];
            $_form['form_structure'] = $form['frmb']; // since the form is from POST, set it as the raw array
            $this->_form_array = $_form;
        }
        return true;
    }

    private function __array_filter_recursive($input) {
        if(empty($input)) return false;

        foreach ($input as &$value) {
            if (is_array($value)) {
                $value = $this->__array_filter_recursive($value);
            }
        }
        return array_filter($input);
    }

    /**
     * Property get/set message warning from settings of client
     */
    public function setMessage($msg){
        $this->_warning_message = $msg;
    }
    public function getMessage(){
        return $this->_warning_message;
    }
    /**
     * Property get/set number of controls per pagefrom settings of client
     */
    public function setControlPerPage($numOfControl){
        if($numOfControl){
            $this->_controls_per_page = $numOfControl;
        }
    }
    public function getControlPerPage(){
        return $this->_controls_per_page;
    }
    /**
     * Property get/set Preview State
     */
    public function setPreviewState($preview){
        $this->_preview_state = $preview;
    }
    public function getPreviewState(){
        return $this->_preview_state;
    }

    /**
     * Returns the form array with the structure encoded, for saving to a database or other store
     *
     * @access public
     * @return array
     */
    public function get_encoded_form_array() {
        return array('form_id' => $this->_form_array['form_id'], 'form_structure' => json_encode($this->_form_array['form_structure']));
    }

    /**
     * Prints out the generated json file with a content-type of application/json
     *
     * @access public
     */
    public function render_json() {
        header("Content-Type: application/json");
        print json_encode($this->_form_array);
    }

    /**
     * get array form content
     *
     * @access public
     */
    public function getArrayFormStructure() {
        return $this->_form_array;
    }

    /**
     * Renders the generated html of the form.
     *
     * @param string $form_action Action attribute of the form element.
     * @access public
     * @uses generate_html
     */
    public function render_html($form_action = false, $form_data = null, $results = null) {
        return $this->generate_html($form_action, $form_data, $results);
    }

    /**
     * Generates the form structure in html.
     *
     * @param string $form_action Action attribute of the form element.
     * @return string
     * @access public
     */
    public function generate_html($form_action = false, $form_data = null, $results = null) {

        $form_action = $form_action ? $form_action : $_SERVER['PHP_SELF'];
        $html = '';
        if (is_array($this->_form_array['form_structure'])) {

            $tabHeader = null;
            $tabContent = null;
            $sectionBreaks = null;
            $outsideContent = null;
            $i = $y = 0;
            foreach ($this->_form_array['form_structure'] as $field) {
                if ($field['cssClass'] == 'tabbable') {
                    $i++;
                    $tabHeader[$i] = $this->loadField((array) $field);
                } else {
                    if ($i > 0) {
                        //content in tab
                        $tabContent[$i][] = $this->loadField((array) $field, $results);
                    } else {
                        $sectionBreaks[$y] = ($field['cssClass'] == 'section_break') ? $this->loadField((array) $field, $results) : null;
                        //content outside tab
                        $outsideContent[$y] = ($field['cssClass'] != 'section_break') ? $this->loadField((array) $field, $results) : null;
                    }
                }
                $y++;
            }

            $navigation = '<div class="navbar"><div class="navbar-inner"><div class="container"><div id="navigation" class="nav-collapse"><ul class="nav">%s</ul></div></div></div></div>' . "\n";
            //$navigation = '<div class="navigation" style="display:none;"><ul>%s</ul></div>' . "\n";
            //run outside content first
            $fieldSet = '';
            if (!empty($outsideContent)) {
                $total_controls = count($this->__array_filter_recursive($outsideContent));//total control without section break
                $numOfControls = $this->getControlPerPage();
                $controls_per_page = round(($total_controls/$numOfControls) + 0.5);
                //$num_of_page = ceil(count($outsideContent)/$controls_per_page);
                //$outsideContent = array_chunk($outsideContent,$num_of_page);


                $z = $x = 0;
                $setHeight = $controls_per_page*90;
                $backDisabledBtn = '<a href="javascript:;;" class="btn btn-large btn-primary prev-step disabled"><i class="icon-chevron-left icon-white"></i> Back</a>';
                $backBtn = '<a href="javascript:;;" class="btn btn-large btn-primary prev-step"><i class="icon-chevron-left icon-white"></i> Back</a>';
                $nextBtn = '<a href="javascript:;;" class="btn btn-large btn-primary next-step">Next <i class="icon-chevron-right icon-white"></i></a>';

                $submitButton = (isset($form_data['Survey']['submit_button_text']) && !empty($form_data['Survey']['submit_button_text'])) ? $form_data['Survey']['submit_button_text'] : 'Submit';
                $submitDisabled = ($this->_preview_state) ? 'disabled="true"' : '';
                if($submitDisabled){
                    $finishBtn = '<button class="btn btn-primary btn-large" '.$submitDisabled.' id="btSubmitSurvey"><i class="icon-ok icon-white"></i> ' . $submitButton . '</button>';
                }else{
                    $finishBtn = '<a class="btn btn-primary btn-large" '.$submitDisabled.' id="btSubmitSurvey"><i class="icon-ok icon-white"></i> ' . $submitButton . '</a>';
                }
                //load fiedset for each step
                $liNavi = '';
                $tmpIndex = array();
                foreach ($outsideContent as $idx => $content) {
                    /**
                     *create step navigation
                     */
                    if($controls_per_page > 1){
                        if($z==0 && !in_array($z, $tmpIndex)){
                            $x++;
                            $liNavi .= '<li class="active"><a href="#">Step '.$x.'</a></li>';
                        }elseif((($z> 0 && $z%$numOfControls == 0)) &&  !in_array($z, $tmpIndex)) {
                            $x++;
                            $liNavi .= '<li><a href="#">Step '.$x.'</a></li>';
                        }
                    }

                    /**
                     * Create each step content
                     */
                    if($z%$numOfControls == 0 && !in_array($z, $tmpIndex)){
                        $fieldSet .= '<fieldset class="step"><div class="fieldset-content" style="min-height:'.$setHeight.'px">';
                        //pr(h('<fieldset class="step">'));
                    }

                    if(isset($sectionBreaks[$idx]) && !empty($sectionBreaks[$idx])){
                        $fieldSet .= $sectionBreaks[$idx];
                    }
                    $fieldSet .= $content;

                    $showBackBtn = ($x==1) ? $backDisabledBtn : $backBtn;
                    $showBackBtn = ($controls_per_page > 1) ? $showBackBtn : '';

                    $showNextBtn = $nextBtn;
                    $captcha = '';
                    if($z+1==$total_controls){
                        $showNextBtn = $finishBtn;

                        $captcha .= '<div id="survey-captcha" class="btn btn-large disabled">
                                       <span id="surveyCaptcha"></span><span id="captchaSign">=</span>&nbsp;<input type="number" value="" name="security_code"  id="security_code" class="span1" style="padding:0; margin:0;">
                                     </div>';
                    }

                    if(!empty($content) || $content != null){
                        $z++;
                    }else{
                        $tmpIndex[] = $z;
                    }

                    if((($z> 0 && $z%$numOfControls == 0) || $z==$total_controls) &&  !in_array($z, $tmpIndex)) {
                        $fieldSet .= '</div><div class="form-actions"><div class="btn-group">'.$showBackBtn.$captcha.$showNextBtn.'</div></div></fieldset>';
                        //pr(h('</fieldset>'));
                    }

                }
                $navigation = sprintf($navigation, $liNavi);
                $navigation = ($liNavi == '') ? '' : $navigation;
            }

            $html = '<div id="sliding-form-content"><a name="top" id="anchor-top"></a>';
            $html .= '<div id="wrapper">'.$navigation.'<div id="steps">' . "\n";
            $html .= '<form class="form-horizontal" id="surveyForm" method="post" action="' . $form_action . '">' . "\n";
            $html .= $fieldSet;

            //load tab content
            $tabbableHTML = '';
            if (!empty($tabHeader) && !empty($tabContent)) {

                $tabHeaderContent = '<ul class = "nav nav-tabs">';
                foreach ($tabHeader as $idx => $val) {
                    if (isset($tabContent[$idx]) && !empty($tabContent[$idx])) {
                        $active = ($idx == 1) ? 'active' : '';
                        $tabHeaderContent .= sprintf($val, $active, $idx); //replace tab ID
                    }
                }
                $tabHeaderContent .= '</ul>';


                $tabBodyContent = '<div class = "tab-content">';
                foreach ($tabContent as $idx => $fields) {
                    $active = ($idx == 1) ? 'active' : '';
                    $tab = '<div class = "tab-pane %s" id = "%s">%s</div>';
                    $generateField = null;
                    foreach ($fields as $field) {
                        $generateField .= $field;
                    }
                    $tab = sprintf($tab, $active, $idx, $generateField);
                    $tabBodyContent .= $tab;
                }
                $tabBodyContent .= '</div>';

                $tabbableHTML = sprintf('<div class = "tabbable">%s %s</div>', $tabHeaderContent, $tabBodyContent);
            }

            $html .= $tabbableHTML;

            $formStructure = (isset($form_data['Survey']['form_structure']) && !empty($form_data['Survey']['form_structure'])) ? $form_data['Survey']['form_structure'] : null;
            $html .= '<input id="formstructure" type="hidden" name="form_structure" value="' . base64_encode($formStructure) . '">';
            $html .= '<input id="formhash" type="hidden" name="form_hash" value="' . md5(base64_encode($formStructure) . Configure::read('Security.salt')) . '">';

            $html .= '</form>' . "\n";
            $html .= '</div>' . "\n";
            $html .= '</div>' . "\n";
            $html .= '</div>' . "\n";


            $html .= '<div class="modal hide fade" id="errorModal" style="display: none;"><div class="modal-header"><a data-dismiss="modal" class="close modal-close">×</a><h3>Error!</h3>
            </div><div class="modal-body"><p><i class="icon-exclamation-sign"></i> '.$this->_warning_message.'</p>
            </div><div class="modal-footer"><a data-dismiss="modal" class="btn modal-close" href="#">Close</a></div></div>';
            if($submitDisabled){
                $html .= '<script type="text/javascript">';
                $html .= '$(function(){
                            $("#btSubmitSurvey").unbind("click");
                         });';
                $html .= '</script>';
            }
        }

        return $html;
    }

    /**
     * Parses the POST data for the results of the speific form values. Checks
     * for required fields and returns an array of any errors.
     *
     * @access public
     * @returns array
     */
    public function process($postData=null) {

        $error = array();
        $results = array();

        // Put together an array of all expected indices
        if (is_array($this->_form_array['form_structure'])) {
            foreach ($this->_form_array['form_structure'] as $field) {

                $field = (array) $field;

                $field['required'] = (isset($field['required']) && $field['required'] == 'checked') ? 'required' : false;

                if ($field['cssClass'] == 'input_text' || $field['cssClass'] == 'textarea' || $field['cssClass'] == 'date_picker') {
                    $field['values'] = (!empty($field['values'])) ? $field['values'] : __('Undefined', true);
                    $elementID = $field['id'];

                    $val = $this->getPostValue($elementID);

                    if ($field['required'] && empty($val)) {
                        $error[$elementID] = 'Please complete the ' . $field['values'] . ' field.';
                    } else {
                        $results[$elementID] = $val;// htmlentities ($val, ENT_COMPAT, "UTF-8");
                    }
                } elseif ($field['cssClass'] == 'radio' || $field['cssClass'] == 'select') {
                    $elementID = $field['id'];
                    $val = $this->getPostValue($elementID);
                    if(is_array($val)){
                        $val = $this->array_filter_recursive($val);
                    }

                    if ($field['required'] && empty($val)) {
                        $error[$elementID] = 'Please complete the ' . $field['title'] . ' field.';
                    } else {
                        $results[$elementID] = $val;// htmlentities ($val, ENT_COMPAT, "UTF-8");
                    }
                } elseif ($field['cssClass'] == 'checkbox') {
                    $field['values'] = (array) $field['values'];
                    $elementID = $field['id'];
//                    pr($_POST[$elementID]);
//                    pr($field);
                    if (is_array($field['values']) && !empty($field['values'])) {

                        $at_least_one_checked = false;

                        $i=0;
                        foreach ($field['values'] as $item) {
                            $i++;
                            $item = (array) $item;
                            if(empty($item['value'])){
                                $item['value'] = __('Undefined Checkbox', true) . $i;
                            }
                            //$elem_id = $this->elemId($field['title'],$item['value']);
                            $val = (isset($_POST[$elementID][$this->elemId($item['value'])])
                                    && !empty($_POST[$elementID][$this->elemId($item['value'])]))
                                    ? $_POST[$elementID][$this->elemId($item['value'])] : false;//$this->getPostValue($elem_id);

                            if (!empty($val)) {
                                $at_least_one_checked = true;
                            }

                            $results[$elementID][$this->elemId($item['value'])] = $val;// htmlentities ($val, ENT_COMPAT, "UTF-8");

                        }

                        if (!$at_least_one_checked && $field['required']) {
                            $error[$elementID] = 'Please check at least one ' . $field['title'] . ' choice.';
                        }
                    }
                } else {

                }
            }
        }

        $success = empty($error);

        return array('success' => $success, 'results' => $results, 'errors' => $error);
    }

    //+++++++++++++++++++++++++++++++++++++++++++++++++
    // NON-PUBLIC FUNCTIONS
    //+++++++++++++++++++++++++++++++++++++++++++++++++

    /**
     * Loads a new field based on its type
     *
     * @param array $field
     * @access protected
     * @return string
     */
    protected function loadField($field, $results=null) {
        if (is_array($field) && isset($field['cssClass'])) {

            switch ($field['cssClass']) {

                case 'tabbable':
                    return $this->loadTabbable($field);
                    break;
                case 'section_break':
                    return $this->loadSectionBreak($field);
                    break;
                case 'input_text':
                    return $this->loadInputText($field, $results);
                    break;
                case 'date_picker':
                    return $this->loadDatePicker($field, $results);
                    break;
                case 'textarea':
                    return $this->loadTextarea($field, $results);
                    break;
                case 'checkbox':
                    return $this->loadCheckboxGroup($field, $results);
                    break;
                case 'radio':
                    return $this->loadRadioGroup($field, $results);
                    break;
                case 'select':
                    return $this->loadSelectBox($field, $results);
                    break;
            }
        }

        return false;
    }

    /**
     * Returns html for an tabble
     *
     * @param array $field Field values from database
     * @access protected
     * @return string
     */
    //protected $tabbable = null;

    protected function loadTabbable($field) {

        $field['values'] = (isset($field['values'])) ? $field['values'] : '';
        $html = '';
        if ($field) {
            $title = (!empty($field['values'])) ? $field['values'] : __('Undefined', true);
            $html .= '<li class="%s"><a href= "#%s" data-toggle = "tab">' . $title . '</a></li>';
            //$this->tabbable['tab_header'][$tabID]  = sprintf('<li class="%s"><a href= "#%s" data-toggle = "tab">%s</a></li>', $active, $tabID,$title);
            //$this->tabbable['tab_content'][$tabID] = '<div class = "tab-pane '.$active.'" id = "1">%s</div>';
        }
        return $html;
    }

    /**
     * Returns html for an section break
     *
     * @param array $field Field values from database
     * @access protected
     * @return string
     */
    protected function loadSectionBreak($field) {

        $field['values'] = (isset($field['values'])) ? $field['values'] : '';
        $field['help'] = (isset($field['help'])) ? $field['help'] : '';
        $html = '';
        if ($field) {
            $title = (!empty($field['values'])) ? $field['values'] : __('Undefined', true);
            $help = (!empty($field['help'])) ? $field['help'] : '';
            $html = sprintf('<div class="page-header"><h3>%s <small>%s</small></h3></div>', $title, $help);
        }
        return $html;
    }

    /**
     * Returns html for an input type="text" with date picker
     *
     * @param array $field Field values from database
     * @access protected
     * @return string
     */
    protected function loadDatePicker($field, $results=null) {

        $field['required'] = (isset($field['required']) && $field['required'] == 'checked') ? ' required' : false;
        $field['values'] = (!empty($field['values'])) ? $field['values'] : __('Undefined', true);
        $help = (isset($field['help'])) ? $field['help'] : '';
        if (!empty($help)) {
            $help = sprintf('<span class="help-inline"><a rel="tooltip" href="javascript:;;" data-original-title="%s"><i class="icon-question-sign"></i></a></span>', $help);
        }

        $fieldID = $this->elemId($field['values']) . "_" . uniqid();
        $html = '';
        $elemId = $field['id'];
        $validation = $results['errors'];
        $error = (isset($validation[$elemId]) && !empty($validation[$elemId])) ? 'error' : '';
        $errorMessage = null;
        if($error){
            $errorMessage = '<span class="help-inline">'.$validation[$elemId].'</span>';
        }
        $html .= sprintf('<div class="%s%s control-group %s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $error, $this->elemId($field['values']));
        $html .= sprintf('<label class="control-label" for="%s">%s</label>' . "\n", $this->elemId($field['values']), $field['values']);
        $html .= sprintf('<div class="controls"><div class="input-append date datepickerField" id="%s"  data-date="' . date('m-d-Y') . '" data-date-format="mm-dd-yyyy"><input readonly type="text" id="%s" name="%s" value="%s" />' . "<span class=\"add-on\"><i class=\"icon-calendar\"></i></span>%s</div>%s</div>\n",
                $fieldID,
                $elemId,
                $elemId,
                $this->getPostValue($this->elemId($field['values'])),
                $help,
                $errorMessage);

        $html .= '</div>'; //. "<script type=\"text/javascript\">$(function(){ $('#" . $fieldID . "').datepicker();});</script>\n";

        return $html;
    }

    /**
     * Returns html for an input type="text"
     *
     * @param array $field Field values from database
     * @access protected
     * @return string
     */
    protected function loadInputText($field, $results=null) {
        $field['required'] = (isset($field['required']) && $field['required'] == 'checked') ? ' required' : false;
        $field['values'] = (!empty($field['values'])) ? $field['values'] : __('Undefined', true);
        $help = (isset($field['help'])) ? $field['help'] : '';
        if (!empty($help)) {
            $help = sprintf('<span class="help-inline"><a rel="tooltip" href="javascript:;;" data-original-title="%s"><i class="icon-question-sign"></i></a></span>', $help);
        }

        $html = '';

        $elemId = $field['id'];
        $validation = $results['errors'];
        $error = (isset($validation[$elemId]) && !empty($validation[$elemId])) ? 'error' : '';
        $errorMessage = null;
        if($error){
            $errorMessage = '<span class="help-inline">'.$validation[$elemId].'</span>';
        }

        $html .= sprintf('<div class="%s%s control-group %s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $error,$elemId);
        $html .= sprintf('<label class="control-label" for="%s">%s</label>' . "\n", $elemId, $field['values']);
        $html .= sprintf('<div class="controls"><input type="text" class="input-xlarge" id="%s" name="%s" value="%s" />' . "%s%s</div>\n", $elemId, $elemId, $this->getPostValue($elemId), $help, $errorMessage);
        $html .= '</div>' . "\n";

        return $html;
    }

    /**
     * Returns html for a <textarea>
     *
     * @param array $field Field values from database
     * @access protected
     * @return string
     */
    protected function loadTextarea($field, $results=null) {

        $field['required'] = (isset($field['required']) && $field['required'] == 'checked') ? ' required' : false;
        $field['values'] = (!empty($field['values'])) ? $field['values'] : __('Undefined', true);
        $help = (isset($field['help'])) ? $field['help'] : '';
        if (!empty($help)) {
            $help = sprintf('<span class="help-inline"><a rel="tooltip" href="javascript:;;" data-original-title="%s"><i class="icon-question-sign"></i></a></span>', $help);
        }

        $html = '';

        $elemId = $field['id'];
        $validation = $results['errors'];
        $error = (isset($validation[$elemId]) && !empty($validation[$elemId])) ? 'error' : '';
        $errorMessage = null;
        if($error){
            $errorMessage = '<span class="help-inline">'.$validation[$elemId].'</span>';
        }

        $html .= sprintf('<div class="%s%s control-group %s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $error, $elemId);
        $html .= sprintf('<label class="control-label" for="%s">%s</label>' . "\n", $elemId, $field['values']);
        $html .= sprintf('<div class="controls"><textarea id="%s" name="%s" rows="5" class="input-xlarge">%s</textarea>' . "%s%s</div>\n", $elemId, $elemId, $this->getPostValue($elemId), $help,$errorMessage);
        $html .= '</div>' . "\n";

        return $html;
    }

    /**
     * Returns html for an <input type="checkbox"
     *
     * @param array $field Field values from database
     * @access protected
     * @return string
     */
    protected function loadCheckboxGroup($field, $results=null) {

        $field['required'] = (isset($field['required']) && $field['required'] == 'checked') ? ' required' : false;
        $field['title'] = (!empty($field['title'])) ? $field['title'] : __('Undefined', true);
        $help = (isset($field['help'])) ? $field['help'] : '';
        if (!empty($help)) {
            $help = sprintf('<span class="help-inline"><a rel="tooltip" href="javascript:;;" data-original-title="%s"><i class="icon-question-sign"></i></a></span>', $help);
        }

        $html = '';
        //$html .= sprintf('<div class="%s%s control-group" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $this->elemId($field['title']));
        $elemId = $field['id'];
        $validation = $results['errors'];
        $error = (isset($validation[$elemId]) && !empty($validation[$elemId])) ? 'error' : '';
        $errorMessage = null;
        if($error){
            $errorMessage = '<span class="help-inline">'.$validation[$elemId].'</span>';
        }

        $html .= sprintf('<div class="control-group %s %s" id="fld-%s">' . "\n", $field['required'], $error, $elemId);

        if (isset($field['title']) && !empty($field['title'])) {
            $html .= sprintf('<label class="control-label">%s</label>' . "\n", $field['title']);
        }

        $field['values'] = (array) $field['values'];
        if (isset($field['values']) && is_array($field['values'])) {
            $html .= sprintf('<div class="controls">') . "\n";
            $i = 0;
            foreach ($field['values'] as $id => $item) {
                $i++;

                $item = (array) $item;

                $item['value'] = (!empty($item['value'])) ? $item['value'] : __('Undefined Checkbox', true) . $i;

                // set the default checked value
                $checked = (isset($item['baseline']) && $item['baseline'] == 'checked') ? true : false;
                $checked = (isset($results['results'][$this->elemId($item['value'])]) && $results['results'][$this->elemId($item['value'])] == $item['value']) ? true : $checked;

                // load post value
                //$val = $this->getPostValue($this->elemId($item['value']));
                //$checked = !empty($val);
                // if checked, set html
                $checked = $checked ? ' checked="checked"' : '';

                if($i==1){
                    $checkbox = '<label class="checkbox" for="%s-%s"><input type="checkbox" name="%s[%s]" id="%s-%s" value="%s"%s />%s&nbsp;%s</label>' . "\n";
                    $html .= sprintf($checkbox, $elemId, $this->elemId($item['value']), $elemId, $this->elemId($item['value']), $elemId, $this->elemId($item['value']), $id, $checked, $item['value'], $help);
                }else{
                    $checkbox = '<label class="checkbox" for="%s-%s"><input type="checkbox" name="%s[%s]" id="%s-%s" value="%s"%s />%s</label>' . "\n";
                    $html .= sprintf($checkbox, $elemId, $this->elemId($item['value']), $elemId, $this->elemId($item['value']), $elemId, $this->elemId($item['value']), $id, $checked, $item['value']);

                }
            }
            $html .= sprintf('%s</div>', $errorMessage) . "\n";
        }

        $html .= '</div>' . "\n";

        return $html;
    }

    /**
     * Returns html for an <input type="radio"
     * @param array $field Field values from database
     * @access protected
     * @return string
     */
    protected function loadRadioGroup($field, $results=null) {

        $field['required'] = (isset($field['required']) && $field['required'] == 'checked') ? ' required' : false;
        $help = (isset($field['help'])) ? $field['help'] : '';
        if (!empty($help)) {
            $help = sprintf('<span class="help-inline"><a rel="tooltip" href="javascript:;;" data-original-title="%s"><i class="icon-question-sign"></i></a></span>', $help);
        }

        $html = '';

        $elemId = $field['id'];
        $validation = $results['errors'];
        $error = (isset($validation[$elemId]) && !empty($validation[$elemId])) ? 'error' : '';
        $errorMessage = null;
        if($error){
            $errorMessage = '<span class="help-inline">'.$validation[$elemId].'</span>';
        }

        //$html .= sprintf('<div class="%s%s control-group" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $this->elemId($field['title']));
        $html .= sprintf('<div class="control-group %s %s" id="fld-%s">' . "\n", $field['required'], $error, $elemId);

        $field['title'] = (!empty($field['title'])) ? $field['title'] : __('Undefined', true);
        if (isset($field['title']) && !empty($field['title'])) {
            $html .= sprintf('<label class="control-label">%s</label>' . "\n", $field['title']);
        }
        $field['values'] = (array) $field['values'];
        if (isset($field['values']) && is_array($field['values'])) {
            $html .= sprintf('<div class="controls">') . "\n";
            $i = 0;
            foreach ($field['values'] as $id => $item) {
                $i++;

                $item = (array) $item;

                $item['value'] = (!empty($item['value'])) ? $item['value'] : __('Undefined Radio', true) . $i;

                // set the default checked value
                $checked = (isset($item['baseline']) && $item['baseline'] == 'checked') ? true : false;
                $checked = (isset($results['results'][$elemId]) && $results['results'][$elemId] == $item['value']) ? true : $checked;
                // load post value
                //$val = $this->getPostValue($elemId);
                //$checked = !empty($val) ? true : false;
                // if checked, set html
                $checked = $checked ? ' checked="checked"' : '';

                if($i==1){
                    $radio = '<label class="radio" for="%1$s-%2$s"><input type="radio" id="%s-%s" name="%1$s" value="%s"%s />%s&nbsp;%s</label>' . "\n";
                    $html .= sprintf($radio, $elemId, $this->elemId($item['value']), $id, $checked, $item['value'], $help);
                }else{
                    $radio = '<label class="radio" for="%1$s-%2$s"><input type="radio" id="%s-%s" name="%1$s" value="%s"%s />%s</label>' . "\n";
                    $html .= sprintf($radio, $elemId, $this->elemId($item['value']), $id, $checked, $item['value']);
                }
            }
            $html .= sprintf('%s</div>', $errorMessage) . "\n";
        }

        $html .= '</div>' . "\n";

        return $html;
    }

    /**
     * Returns html for a <select>
     *
     * @param array $field Field values from database
     * @access protected
     * @return string
     */
    protected function loadSelectBox($field, $results=null) {
        $field['required'] = (isset($field['required']) && $field['required'] == 'checked') ? ' required' : false;
        $field['title'] = (!empty($field['title'])) ? $field['title'] : __('Undefined', true);
        $help = (isset($field['help'])) ? $field['help'] : '';
        if (!empty($help)) {
            $help = sprintf('<span class="help-inline"><a rel="tooltip" href="javascript:;;" data-original-title="%s"><i class="icon-question-sign"></i></a></span>', $help);
        }

        $html = '';

        $elemId = $field['id'];
        $validation = $results['errors'];
        $error = (isset($validation[$elemId]) && !empty($validation[$elemId])) ? 'error' : '';
        $errorMessage = null;
        if($error){
            $errorMessage = '<span class="help-inline">'.$validation[$elemId].'</span>';
        }

        $html .= sprintf('<div class="control-group %s%s %s" id="fld-%s">' . "\n", $this->elemId($field['cssClass']), $field['required'], $error, $this->elemId($field['title']));

        if (isset($field['title']) && !empty($field['title'])) {
            $html .= sprintf('<label class="control-label" for="%s">%s</label>' . "\n", $this->elemId($field['title']), $field['title']);
        }
        $field['values'] = (array) $field['values'];
        if (isset($field['values']) && is_array($field['values'])) {
            $multiple = (isset($field['multiple']) && $field['multiple'] == 'checked') ? ' multiple="multiple"' : '';
            $html .= sprintf('<div class="controls"><select class="input-xlarge" name="%s[]" id="%s"%s>' . "\n", $elemId, $elemId, $multiple);
            //if ($field['required']) {
                //$html .= '<option value="">Select '.$field['title'].'</label>';
            if(isset($field['multiple']) && $field['multiple'] == "checked"){
                //$html .= '<option value="">'.__('Please select at least one option', true).'</label>';
            }else{
                $html .= '<option value="">'.__('Please select one option', true).'</option>';
            }
            //}

            foreach ($field['values'] as $id => $item) {

                $item = (array) $item;

                $item['value'] = (!empty($item['value'])) ? $item['value'] : __('Undefined', true);

                // set the default checked value
                $checked = (isset($item['baseline']) && $item['baseline'] == 'checked') ? true : false;
                $checked = (isset($results['results'][$elemId]) && $results['results'][$elemId] == $item['value']) ? true : $checked;
                // load post value
                //$val = $this->getPostValue($this->elemId($field['title']));
                //$checked = !empty($val);
                // if checked, set html
                $checked = $checked ? 'selected' : '';

                $option = '<option value="%s"%s>%s</option>' . "\n";
                $html .= sprintf($option, $id, $checked, $item['value']);
            }

            $html .= '</select>' . "\n";
            $html .= sprintf('%s%s</div>', $help, $errorMessage) . "\n";
            $html .= '</div>' . "\n";
        }

        return $html;
    }

    /**
     * Generates an html-safe element id using it's label
     *
     * @param string $label
     * @return string
     * @access protected
     */
    protected function elemId($label, $prepend = false) {
        if (is_string($label)) {
            $prepend = is_string($prepend) ? $this->elemId($prepend) . '-' : false;

            $label = md5(Sanitize::clean($label, array('remove_html'=>true)));

            $prepend = $prepend . strtolower(preg_replace("/[^A-Za-z0-9_]/", "", str_replace(" ", "_", $label)));
            return $prepend;
        }
        return false;
    }

    /**
     * Attempts to load the POST value into the field if it's set (errors)
     *
     * @param string $key
     * @return mixed
     */
    protected function getPostValue($key) {
        return array_key_exists($key, $_POST) ? $_POST[$key] : false;
    }

    /**
     * Converts an object into an array
     * @param type $object
     * @return type
     */
    protected function objectToArray($object) {
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                if (is_object($value)) {
                    $array[$key] = $this->objectToArray($value);
                } else {
                    $array[$key] = Sanitize::clean($value, array('remove_html'=>true));
                }
            }
        } else if (is_array($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $this->objectToArray($value);
            }
        } else {
            $array = $object;
        }
        return $array;
    }
    /**
     * remove item = 0 or null
     */
    function array_filter_recursive($input) {
        if(empty($input)) return false;

        foreach ($input as &$value) {
            if (is_array($value)) {
                $value = $this->array_filter_recursive($value);
            }
        }
        return array_filter($input);
    }
}

?>