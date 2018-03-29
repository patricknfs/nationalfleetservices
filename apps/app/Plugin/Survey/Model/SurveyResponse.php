<?php
App::uses('SurveyAppModel', 'Survey.Model');
class SurveyResponse extends SurveyAppModel {

    public $belongsTo = array(
        'Survey' => array(
                'className' => 'Survey',
                'foreignKey' => 'survey_id',
                'fields' => '',
                'order' => '',
                'counterCache' => true
            )
    );

    public function afterSave($created, $option = array()) {
        parent::afterSave($created, $option);

        $id = ($this->getLastInsertID()) ? $this->getLastInsertID() : $this->id;
        if($id){
            Cache::delete('getResponseById'.$id);
        }
    }

    public function  afterDelete() {
        parent::afterDelete();

        $id = (isset($this->data['SurveyResponse']['id']) && $this->data['SurveyResponse']['id']) ? $this->data['SurveyResponse']['id'] : $this->id;
        if($id){
            Cache::delete('getResponseById'.$id);
        }
    }

    public function beforeDelete($cascade = true){
        parent::beforeDelete();

        $id = (isset($this->data['SurveyResponse']) && $this->data['SurveyResponse']['id']) ? $this->data['SurveyResponse']['id'] : $this->id;

        return true;
    }

    /**
     *  Get list of question to next, prev
     *
     * @param <type> $practice_test_id
     */
    public function getResponseList($survey_id=null) {
        $responseList = $this->find('list', array(
                    'order'=>array('SurveyResponse.created'=>'ASC'),
                    'conditions' => array('SurveyResponse.survey_id' => $survey_id)
                ));
        $res = null;
        $i=0;
        foreach($responseList as $id){
            $i++;
            $res[$id] = __('Response', true).' #'.$i;
        }
        return $res;
    }
    /**
     *  Get response by id
     *
     * @param <type> $practice_test_id
     */
    public function getResponseById($id=null, $survey_id=null) {

        $option = array('order'=>array('SurveyResponse.created'=>'ASC'), 'fields'=>array('Survey.name', 'Survey.form_structure', 'SurveyResponse.*'), 'limit'=>1);
        if($survey_id){
            $option['conditions'] = array('SurveyResponse.survey_id' => $survey_id);
        }
        if($id){
            $option = array('conditions' => array('SurveyResponse.id' => $id), 'fields'=>array('Survey.name', 'Survey.form_structure','SurveyResponse.*'));
        }
        $response = $this->find('first', $option);

        return $response;
    }
}
?>