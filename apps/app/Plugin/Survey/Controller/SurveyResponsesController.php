<?php
/**
 * @package     CakePHP Survey Plugin
 * @author      Vu Khanh Truong
 */

App::import('Controller', 'Survey.Surveys');
App::import('Vendor', 'Survey.Formbuilder', array('file' => 'formbuilder.php'));
App::import('Vendor', 'Survey.Excel_XML', array('file' => 'php-excel.class.php'));
App::import('Vendor', 'Survey.Flatfile', array('file'=>'flatfile.php'));

/**
 * @property Survey $Survey
 */
class SurveyResponsesController extends SurveysController {

    var $name = "SurveyResponses";

    function beforeFilter() {
        parent::beforeFilter();

        Configure::write('DonotShowProjectName', true);
        Configure::write("MenuSelect.surveys", true);

        if($this->Auth):
            $this->Auth->allow("view");
            if ($this->Session->check('Auth.User.id')):
                $this->Auth->allow("index", "delete", "export");
            endif;
        endif;
    }

    private function checkExistIP($id){
        //initial flatfile database
        $ff = new Flatfile();
        $ff->datadir = TMP.DS.'cache'.DS;
        $ip_file = $id.'.txt';

        //check ip already access this page?
        $ip_result = $ff->selectUnique($ip_file, 0, $_SERVER['REMOTE_ADDR']);
        //if the first time visit this page -> save in the list
        if (empty($ip_result)) {

            $ip[0] = $_SERVER['REMOTE_ADDR'];
            $ff->insert($ip_file, $ip);

            return false;
        }

        return true;
    }

    public function save_response($id){
        $this->autoRender = false;

        //check IP before save
        if($this->checkExistIP($id) && $this->Cookie->read('survey_id') == $id){
            $this->Session->write('SurveyThankyouMessage', __('Hey Dude! You had already submitted this survey.'));
            $this->redirect(array('controller'=>'surveys','action' => 'thankyou'));
        }

        $this->loadModel('Survey.Survey');
        $survey = $this->Survey->getSurveyById($id);
        $msg = ($survey['Survey']['error_message']) ? $survey['Survey']['error_message'] : __('Oops...something went wrong when trying to save your survey responses. Take a look at the errors below and try again.', true);
        if($survey['Survey']['published']==0){
            $this->redirect(array('action' => 'response', $id));
            return false;
        }

        $results = null;
        if ($this->request->is('post') || $this->request->is('put')) {
            //check validate captcha
            if ($this->MathCaptcha->validates($this->request->data['security_code'])){
                $form_structure = $survey['Survey']['form_structure'];
                $form = new Formbuilder(unserialize($form_structure));
                $results = $form->process($this->request->data);
                if($results['success'] == 1){
                    $this->request->data['SurveyResponse']['survey_id'] = $id;
                    $this->request->data['SurveyResponse']['content'] = serialize($results['results']);
                    if($this->SurveyResponse->save($this->request->data['SurveyResponse'])){
						Cache::delete('survey_responses_'.$id);
                        if(!empty($survey['Survey']['send_responses_email'])){
                            $Email = new CakeEmail();
                            $Email->viewVars(compact('survey'));
                            $contents = $results['results'];
                            $Email->viewVars(compact('contents'));
                            list($form_structure, $form_label) = $this->__unserializeFormStructure($form_structure);
                            $Email->viewVars(compact('form_label', 'form_structure'));
							
                            $Email->template('Survey.notify_new_respose');
                            $Email->emailFormat('html');
                            $Email->from(array('support@yoursite.com' => 'Your Site'));
                            $Email->to($survey['Survey']['send_responses_email']);
                            $Email->subject(__('New Survey Response'));
                            $Email->send();
                        }
						
                        if(isset($survey['Survey']['thankyou_url']) && !empty($survey['Survey']['thankyou_url'])):
                            $this->redirect($survey['Survey']['thankyou_url']);
                        elseif(isset($survey['Survey']['thankyou_content']) && !empty($survey['Survey']['thankyou_content'])):
                            $this->Session->write('SurveyThankyouMessage', $survey['Survey']['thankyou_content']);
                            $this->redirect(array('controller'=>'surveys','action' => 'thankyou'));
                        endif;
                    }
                }
            }else{
                $this->Session->setFlash(__('Please enter the correct answer to the math question.', true), 'alert/error');
                $this->redirect(array('action' => 'response', $id));
            }
        }

        if(isset($results['errors']) && !empty($results['errors'])){
            $this->Session->setFlash($msg, 'alert/error');
            $this->redirect(array('action' => 'response', $id));
        }
    }

    public function index($id=null){
        if (!$id) {
            return false;
        }
		parent::index();
        $this->set(compact('id'));

        if (($survey = Cache::read('get_survey_by_id_'.$id)) === false) {
            $survey = $this->SurveyResponse->Survey->find('first', array('conditions'=>array('Survey.id'=>$id), 'fields'=>array('Survey.name', 'Survey.form_structure', 'Survey.survey_response_count')));
            Cache::write('get_survey_by_id_'.$id, $survey);
        }

        if(empty($survey)){
            return false;
        }

        if(!empty($survey)){
            $formStructure = $survey['Survey']['form_structure'];
            list($FormStructure, $FormLabel) = $this->__unserializeFormStructure($formStructure);
        }
        $this->set('form_structure', $FormStructure);
        $this->set('form_label', $FormLabel);
        $this->set('survey', $survey);

        if (($survey_responses = Cache::read('survey_responses_'.$id)) === false) {
            $this->SurveyResponse->unbindModel(array('belongsTo'=>array('Survey')), false);
            $survey_responses = $this->SurveyResponse->find('all', array('conditions'=>array('SurveyResponse.survey_id'=>$id), 'order'=>array('SurveyResponse.created'=> 'DESC'), 'fields'=>array()));
            $arrResponses = null;
            foreach($survey_responses as $survey_response):
                $responses = unserialize($survey_response['SurveyResponse']['content']);

                $i=0;
                foreach($responses as $field => $value):
                    $label = (isset($FormLabel[$i]) && !empty($FormLabel[$i])) ? $FormLabel[$i] : sprintf(__('Undefined %s', true), ($i+1));
                    $arrResponses[$label][$survey_response['SurveyResponse']['id']] = $value;
                    $i++;
                endforeach;
            endforeach;
            $survey_responses = $arrResponses;
            Cache::write('survey_responses_'.$id, $survey_responses);
        }
        $this->set('survey_responses', $survey_responses);
    }

    public function view($id=null, $survey_id=null){
        $response = $this->SurveyResponse->getResponseById($id, $survey_id);
        $responseList = null;
        $FormStructure = null;
        $FormLabel = null;
        if(!empty($response)){
            $id = $response['SurveyResponse']['id'];
            $responseList = $this->SurveyResponse->getResponseList($response['SurveyResponse']['survey_id']);


            $formStructure = $response['Survey']['form_structure'];
            list($FormStructure, $FormLabel) = $this->__unserializeFormStructure($formStructure);

        }
        $this->set('form_structure', $FormStructure);
        $this->set('form_label', $FormLabel);
        $this->set('response', $response);
        $this->set('responseList', $responseList);
        $this->set('current_id', $id);
        $this->set('survey_id', $survey_id);
    }

    public function delete($id=null, $survey_id=null,$nextURL=null){
        $this->autoRender = false;


        if($this->SurveyResponse->delete($id)){
            $this->Session->setFlash(__('Response deleted', true), 'alert/success');
            $nextURL = ($nextURL) ? base64_decode($nextURL) : array('action' => 'view', 0, $survey_id);
        }else{
            $this->Session->setFlash(__('Oops...something went wrong when trying to delete responses.', true), 'alert/error');
        }
        $nextURL = ($nextURL) ? $nextURL : array('action' => 'view', $id, $survey_id);
        $this->redirect($nextURL);
    }


    public function export($survey_id=null, $type='csv'){
        $this->autoRender = false;
        //Configure::write('debug', 0);
        if(!$survey_id){
            return null;
        }

        //get survey data
        $survey = $this->Survey->getSurveyById($survey_id);
        $form_structure = $survey['Survey']['form_structure'];
        list($FormStructure, $FormLabel) = $this->__unserializeFormStructure($form_structure);
        $FormLabel = array_values($FormLabel);
        //print data to csv
        if (($survey_responses = Cache::read('export_survey_responses_'.$survey_id)) === false) {
            $this->SurveyResponse->unbindModel(array('belongsTo'=>array('Survey')), false);
            $survey_responses = $this->SurveyResponse->find('all', array('conditions'=>array('SurveyResponse.survey_id'=>$survey_id), 'fields'=>array()));
            Cache::write('export_survey_responses_'.$survey_id, $survey_responses);
        }

        if (($csvData = Cache::read('export_'.$type.'_data_'.$survey_id)) === false) {
            $i=0;
            $header = null;
            $csv = null;
            $excel = array(1=>$FormLabel);

            foreach($survey_responses as $response){
                $contents = unserialize($response['SurveyResponse']['content']);
                $headers = array_keys($contents);
                $contents = array_values($contents);


                $order_list = null;
                //foreach ($contents as $field => $content){
                foreach ($FormLabel as $y => $header){
                    $content = isset($contents[$y]) ? $contents[$y] : __("(No Response)", true);

                    if(is_array($content)){
                        $arrContent = array_filter($content);
                        $arrContent = array_values($arrContent);
                        $content = null;
                        foreach($arrContent as $data){
                            if(isset($FormStructure[$y][$data])){
                                $data = $FormStructure[$y][$data];
                            }
                            $data = ($data) ? $data : sprintf(__('Undefined', true), $y);
                            $content .= "|".$data."";
                        }
                        $content = substr($content, 1);
                    }else{
                        if(isset($FormStructure[$y]) && is_array($FormStructure[$y])){
                            $content = (isset($FormStructure[$y][$content])) ? $FormStructure[$y][$content] : $content;
                        }
                        $content = ($content) ? $content : sprintf(__('Undefined', true), $y);
                    }

                    $content = html_entity_decode($content, ENT_COMPAT, "UTF-8");

                    $order_list[] = $content;
                }

                if($type=='csv'){
                    $csv .= join(",", $order_list)."\n";
                }elseif ($type=='excel') {
                    $excel[] = $order_list;
                }

                $i++;
            }
            if($type=='csv'){
                $header = join(",", $FormLabel)."\n";
                if(mb_detect_encoding($header) == 'UTF-8' && mb_detect_encoding($csv) == 'UTF-8'){
                    $header = html_entity_decode($header, ENT_COMPAT, "UTF-8");
                    $header = str_replace(",", "\t", $header);
                    $csv = html_entity_decode($csv, ENT_COMPAT, "UTF-8");
                    $csv = str_replace(",", "\t", $csv);
                }
                $csvData = $header.$csv;
                if(!empty($csvData)){
                    Cache::write('export_'.$type.'_data_'.$survey_id, $csvData);
                }
            }else{
                $csvData = $excel;
                if(!empty($csvData)){
                    Cache::write('export_'.$type.'_data_'.$survey_id, $csvData);
                }
            }
        }
        if($type == 'csv'){
            header('Content-Description: File Transfer');
            header('Content-Encoding: UTF-8');
            header('Content-type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename='.'survey_'.  date('Ymd_His').'.csv');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            @ob_clean();
            flush();
            echo "\xEF\xBB\xBF";
            echo $csvData;
        }else{
            // generate file (constructor parameters are optional)
            $xls = new Excel_XML('UTF-8', false, $survey['Survey']['name']);
            $xls->addArray($csvData);
            $xls->generateXML('survey_'.date('Ymd_His'));
        }

    }

}

?>