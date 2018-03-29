<?php
/**
 * @package     CakePHP Survey Plugin
 * @author      Vu Khanh Truong
 */

App::uses('SurveyAppController', 'Survey.Controller');
App::uses('Sanitize', 'Utility');
App::import('Vendor', 'Survey.Formbuilder', array('file' => 'formbuilder.php'));
App::uses('CakeEmail', 'Network/Email');
/**
 * @property Survey $Survey
 */
class SurveysController extends SurveyAppController {

    public $name = "Surveys";
    public $components = array("Survey.MathCaptcha", "RequestHandler", "Cookie");
    public $helpers = array('Number', 'Cache');
    public $uses = array('Survey.Survey', 'Survey.SurveyResponse');

    public $cacheAction  = array(
        'response' =>  48000
    );

    function beforeFilter() {
        parent::beforeFilter();

        if($this->Security){
            $this->Security->validatePost = false;
            $this->Security->csrfCheck = false;
        }

        if($this->Auth):
            $this->Auth->allow("response", "save_response", "captcha", "thankyou");
            if ($this->Session->check('Auth.User.id')):
                $this->Auth->allow("index", "add", "edit", "preview", "save_design", "load_design", "error", "delete", "toggle", "sendemail");
            endif;
        endif;
    }


    protected function __unserializeFormStructure($formStructure){
            $formStructure = unserialize($formStructure);
            $form = new Formbuilder($formStructure);
            $form_structure = $form->getArrayFormStructure();

            $FormStructure = null;
            $FormLabel = null;
            if(!empty($form_structure['form_structure'])){
                $y=0;
                foreach($form_structure['form_structure'] as $idx => $fs):
                    if(in_array($fs['cssClass'], array('tabbable', 'section_break'))):
                        continue;
                    endif;

                    if(in_array($fs['cssClass'], array('radio', 'checkbox', 'select'))):
                        //$FormStructure[] = Set::extract('/value', $fs['values']);//array($fs['cssClass'] => Set::extract('/value', $fs['values']));
                        foreach ($fs['values'] as $key => $value) {
                            $FormStructure[$y][$key] = $value['value'];
                        }

                        $FormLabel[$idx] = $content = html_entity_decode($fs['title'], ENT_COMPAT, "UTF-8");
                    else:
                        $FormStructure[] = $fs['cssClass'];
                        $FormLabel[] = html_entity_decode($fs['values'], ENT_COMPAT, "UTF-8");
                    endif;

                    $y++;
                endforeach;
            }

            return array($FormStructure, $FormLabel);
    }

    public function index() {
        $conditions = null;
        $this->paginate = array('conditions' => $conditions, 'order' => array('Survey.created' => 'DESC'));

        $this->Survey->recursive = 0;
        $this->set('surveys', $this->paginate());
    }


    public function add() {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->data['Survey']['name'] = (isset($this->request->data['Survey']['name']) && !empty($this->request->data['Survey']['name'])) ? $this->request->data['Survey']['name'] : __('Untitled', true);
            $this->request->data['Survey']['id'] = trim($this->request->data['Survey']['id']);
            $this->Survey->id = $this->request->data['Survey']['id'];
            if ($this->Survey->save($this->request->data)) {
                $this->redirect('edit/'.$this->Survey->id);
            }
        }
    }

    public function edit($id=null) {
        if (!$id) {
            return false;
        }
        $this->set(compact('id'));

        if ($this->request->is('post') || $this->request->is('put')) {
            $text_logo = $this->request->data['Survey']['text_or_logo'];
            if($text_logo == 'header_text'){
                @unlink(WWW_ROOT.'/files/surveys/'.$this->request->data['Survey']['header_logo_dir'].'/'.$this->request->data['Survey']['logo']);
                $this->request->data['Survey']['header_logo_dir'] = null;
                $this->request->data['Survey']['header_logo'] = null;
            }

            $thankyou = $this->request->data['Survey']['thankyou'];
            if($thankyou=='thankyou_content'){
                $this->request->data['Survey']['thankyou_url'] = null;
            }

            if ($this->Survey->save($this->request->data)) {
                $this->redirect('index');
            }
        } else {
            $this->request->data = $this->Survey->find('first', array('conditions'=>array('Survey.id'=>$id)));
        }
    }

    public function load_design($id) {
        $this->autoRender = false;

        if ($this->RequestHandler->isAjax()) {
            $formStructure = $this->Survey->field('Survey.form_structure', array('Survey.id' => $id));
            $formStructure = unserialize($formStructure);
            $form = new Formbuilder($formStructure);
            $form->render_json();
        }

        return false;
    }

    public function save_design($id=null) {
        $this->autoRender = false;

        if ($this->request->is('post') || $this->request->is('put')) {
            $form_structure = json_decode($this->request->data['Survey']['form_structure'], true);
            // pr($this->request->data);
            //pr($form_structure);exit;
            $params['form']['frmb'] = $form_structure['frmb'];
            $form = new Formbuilder($params['form']);
            $for_db = $form->get_encoded_form_array();

            if($id){
                $this->request->data['Survey']['id'] = $id;
            }

            $this->request->data['Survey']['form_structure'] = serialize($for_db);
            if ($this->Survey->save($this->request->data)) {
                $ID = ($this->Survey->getLastInsertID()) ? $this->Survey->getLastInsertID() :   $this->Survey->id;
                Cache::delete('export_csv_data_'.$ID);
                return $ID;
            }
            return true;
        }
        return false;
    }

    public function preview($id=null, $results=null, $skipPreview=false) {
        $this->layout = 'Survey.survey';
        if($this->RequestHandler->isAjax()){
            $this->autoRender = false;
            //preview settings
            if(isset($this->request->data['Survey']) && !empty($this->request->data['Survey'])){
                $this->Session->write('Preview.Design', $this->request->data['Survey']);
                return true;
            }
        }

        $survey = null;
        if ($id) {
            $survey = $this->Survey->getSurveyById($id);
        }
        $msg = ($survey['Survey']['error_message']) ? $survey['Survey']['error_message'] : __('Oops...something went wrong when trying to save your survey responses. Take a look at the errors below and try again.', true);

        $this->set(compact('survey', 'id'));

        if($this->Session->check('Preview') && !$skipPreview){
            $survey['Survey'] = $this->Session->read('Preview.Design');
            $this->set(compact('survey'));

            $this->request->data['Survey'] = $this->Session->read('Preview.Design');
        }

        if (!empty($this->request->data)) {
            $params = null;
            if (isset($this->request->data['Survey']['frmb']) && !empty($this->request->data['Survey']['frmb'])) {
                $params = unserialize($this->request->data['Survey']['frmb']);
                $form = new Formbuilder($params);
                $form->setMessage($msg);
                $form->setControlPerPage($survey['Survey']['controls_per_page']);
                $this->set('renderHTML', $form->render_html('save_form', $survey, $results));
            }else{
                if (isset($this->request->data['Survey']['design']) && !empty($this->request->data['Survey']['design'])) {
                    $params = json_decode($this->request->data['Survey']['design'], true);
                    $form = new Formbuilder($params);
                    $for_db = $form->get_encoded_form_array();
                    $form = new Formbuilder($for_db);
                    $form->setMessage($msg);
                    $form->setControlPerPage($survey['Survey']['controls_per_page']);
                    $form->setPreviewState(true);
                    $this->set('renderHTML', $form->render_html('/surveys/save_response/'.$id, $survey, $results));
                }
            }
        } else {
            if($survey){
                $formStructure = unserialize($survey['Survey']['form_structure']);
                $form = new Formbuilder($formStructure);
                $form->setMessage($msg);
                $form->setControlPerPage($survey['Survey']['controls_per_page']);
                $this->set('renderHTML', $form->render_html(FULL_BASE_URL.$this->base.'/survey/survey_responses/save_response/'.$id, $survey, $results));
            }else{
                $this->set('renderHTML', null);
            }
        }
    }

    public function response($id=null){
        $this->layout = 'Survey.survey';

        if(!$id){
            return false;
        }

        $survey = $this->Survey->getSurveyById($id);
        $msg = ($survey['Survey']['error_message']) ? $survey['Survey']['error_message'] : __('Oops...something went wrong when trying to save your survey responses. Take a look at the errors below and try again.', true);
        if($survey['Survey']['published']==0){
            $this->layout = 'ajax';
            $this->render('unpublished_survey');
            return false;
        }

        if($id){
            $results = (isset($results)) ? $results : null;
            if(isset($results['errors']) && !empty($results['errors'])){
                $this->Session->setFlash($msg, 'alert/error');
            }
            $this->preview($id, $results, true);
        }
        $this->render('preview');
    }

    public function thankyou($survey=null){
        $this->layout = 'Survey.survey';
    }


    public function delete($id=null){
        if($this->Survey->delete($id)){
            $this->loadModel('SurveyResponse');
            $this->SurveyResponse->deleteAll(array('SurveyResponse.survey_id'=>$id));

            $this->Session->setFlash(__('Survey deleted', true), 'alert/success');
            $nextId = ($nextId) ? $nextId : 0;
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Oops...something went wrong when trying to delete responses.', true), 'alert/error');
        $this->redirect(array('action' => 'index'));
    }

    /**
     *  Active/Inactive
     *
     * @param int $id
     * @param int $status
     */
    public function toggle($id, $status, $field = 'published') {
        $this->autoRender = false;

        if ($id) {
            $status = ($status) ? 0 : 1;
            $this->Survey->id =$id;
            $data['Survey'] = array('id' => $id, $field => $status);
            if ($this->Survey->save($data['Survey'], false)) {
                $base = $this->base;
                $url = $base.'/survey/' . Inflector::tableize($this->name) . '/toggle/' . $id . '/' . $status . '/' . $field;
                $src = $base.'/survey/img/allow-' . $status . '.png';

                return "<img id=\"status-{$id}\" onclick=\"published.toggle('status-{$id}', '{$url}');\" src=\"{$src}\">";
            }
        }

        return false;
    }


    public function captcha($checkValue=false){
        $this->autoRender = false;
        if(!$checkValue){
            return $this->MathCaptcha->generateEquation();
        }else{
            return $this->MathCaptcha->validates($checkValue);
        }
    }
}

?>