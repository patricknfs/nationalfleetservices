<?php echo $this->Html->css('/survey/css/survey/slidingform');?>
<?php
if($this->Session->check('SurveyThankyouMessage')):
    echo '<h3>'.$this->Session->read('SurveyThankyouMessage').'</h3>';
else:
    echo '<h3>'.__('Thanks for filling in our survey. Your opinion is important to us.', true).'</h3>';
endif;
?>
