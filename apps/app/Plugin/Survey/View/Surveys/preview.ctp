<?php echo $this->Html->css('/survey/css/survey/slidingform');?>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<style>
/*@font-face {
  font-family: 'Droid Serif';
  font-style: normal;
  font-weight: 400;
  src: local('Droid Serif'), local('DroidSerif'), url(<?php echo $this->Html->url('/css/survey/font/droidserif.woff');?>) format('woff');
}
@font-face {
  font-family: 'Droid Sans';
  font-style: normal;
  font-weight: 400;
  src: local('Droid Sans'), local('DroidSans'), url(<?php echo $this->Html->url('/css/survey/font/droidsans.woff');?>) format('woff');
}*/
</style>
<?php echo $renderHTML;?>
<script type="text/javascript">
$(function(){
    /**
     * Load captcha
     */
    $('#surveyCaptcha').load('<?php echo $this->Html->url('/survey/surveys/captcha?');?>'+Math.random(), function(){
        $('#survey-captcha').unbind('hover');
    });
});
var BASE_URL = '<?php echo FULL_BASE_URL.$this->base;?>';
</script>
<?php echo $this->Html->script('/survey/js/formbuilder/sliding.form');?>