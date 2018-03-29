<?php
App::uses('PollsAppModel', 'Polls.Model');
class Survey extends SurveyAppModel {
    var $name = 'Survey';
    var $actsAs = array(
        'Upload.Upload' => array(
                'header_logo'=>array(
                    'fields' => array(
                        'dir' => 'header_logo_dir'
                    ),
                    'path'=>'webroot{DS}files{DS}surveys{DS}',
                    'deleteOnUpdate' => true,
                    'mimetypes' => array('image/jpeg', 'image/gif'),
                    'extensions' => array('jpg', 'jpeg', 'gif'),
                    'maxSize' => 2097152
                    //'thumbnailMethod' => 'php'
                )
        )
    );

    public function afterSave($created, $options = array()) {
        parent::afterSave($created, $options);

        Cache::clear();
        clearCache();
    }

    public function  afterDelete() {
        parent::afterDelete();

        Cache::clear();
        clearCache();
    }

    public function getSurveyById($id){
        if (($survey = Cache::read('getSurveyById'.$id)) === false) {
            $survey = $this->find('first', array('conditions' => array('Survey.id'=>$id),
                                    'fields' => array(  'Survey.name', 'Survey.form_structure', 'Survey.header_text', 'Survey.header_logo',
                                                        'Survey.header_logo_dir', 'Survey.thankyou_content', 'Survey.thankyou_url',
                                                        'Survey.error_message', 'Survey.send_responses_email', 'Survey.submit_button_text',
                                                        'Survey.controls_per_page', 'Survey.published'
                                        ) ));
            Cache::write('getSurveyById'.$id, $survey);
        }
        return $survey;
    }

}
?>