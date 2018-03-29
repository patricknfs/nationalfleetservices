<ul class="breadcrumb">
    <li>
        <?php echo $this->Html->link(__('Manage Survey'), array('action'=>'index'));?>
        <span class="divider">/</span>
    </li>
    <li class="active"><?php echo __('New Survey'); ?></li>
</ul>

<?php echo $this->Form->create('Survey', array('class' => 'form-horizontal', "type" => "file", "id"=>"surveyForm")); ?>
<?php
    echo $this->Form->input('id', array());
    echo $this->Form->hidden('preview', array());
    echo $this->Form->hidden('design', array());
?>
<div class="bclcont overView form">
    <?php echo $this->element('surveys/design_toolbar');?>
    <div class="tabbable">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#1" data-toggle="tab">Survey Design</a></li>
            <li><a href="#2" data-toggle="tab">Survey Settings</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="1">
                    <div id="my-form-builder" style="min-height:200px;"></div>
            </div>
            <div class="tab-pane" id="2">
                <fieldset>
                    <div class="page-header"><h4>Display & Feedback Options</h4></div>
                    <div class="control-group">

                        <label class="control-label" for="inputEmail"><?php echo __('Survey Name');?></label>
                        <div class="controls">
                            <?php echo $this->Form->input('name', array('label' => false, 'div'=> false,'class'=>'input-xxlarge', 'placeholder' => __('Untitled', true))); ?>
                        </div>

                        <label class="control-label">&nbsp;</label>
                        <div class="controls">
                            <label class="radio">
                                <input type="radio" checked="" value="header_text" id="text_or_logo1" name="data[Survey][text_or_logo]">
                                <label for="text_or_logo1" style="display: inline; float: none;">Display text at the top of the survey <a href="javascript:;;" rel="tooltip" title="<?php echo __('The text you type here will be shown at the top of the survey.', true);?>"><i class="icon-question-sign"></i></a></label>
                            </label>

                            <span class="header_hidden_container">
                                <?php
                                    echo $this->Form->input('header_text', array('label' => false, 'div'=> false,'class'=>'input-xxlarge', 'after'=>'', 'before'=>'', 'placeholder' => __('Untitled', true) ));
                                ?>
                            </span>
                             <label class="radio">
                                <input type="radio" value="header_logo" id="text_or_logo2" name="data[Survey][text_or_logo]">
                                <label for="text_or_logo2" style="display: inline; float: none;">
                                    Display my logo at the top of the survey
                                    <a href="javascript:;;" rel="tooltip" title="<?php echo __('You can upload your logo image to be displayed at the top of the survey. Uploaded image will not be resized and both GIF and JPG images are supported, and must be equal or less than 2MB', true);?>"><i class="icon-question-sign"></i></a>
                                </label>
                            </label>
                            <span class="header_hidden_container" style="display: none;">
                                <?php
                                    echo $this->Form->input('header_logo', array('type'=>'file','label' => false, 'div'=> false,'class'=>'input-xxlarge', 'after'=>'', 'before'=>'', 'value' => ''));
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><?php echo __('When completed');?></label>
                        <div class="controls">
                            <label class="radio">
                                <input type="radio" checked="" value="thankyou_content" id="thankyou1" name="data[Survey][thankyou]">
                                Display this text as the thank you page <a href="javascript:;;" rel="tooltip" title="<?php echo __('When a contact completes the survey they will be taken to the web page you type here. Alternatively you can show them a thank you message by selecting the option above instead.', true);?>"><i class="icon-question-sign"></i></a>
                            </label>
                            <span class="header_hidden_container">
                                <?php
                                    echo $this->Form->input('thankyou_content', array('label' => false, 'div'=> false,'class'=>'input-xxlarge', 'after'=>'', 'before'=>'', 'value' => __('Thanks for filling in our survey. Your opinion is important to us', true) ));
                                ?>
                            </span>
                            <label class="radio">
                                <input type="radio" value="thankyou_url" id="thankyou2" name="data[Survey][thankyou]">
                                Take them to a particular web page <a href="javascript:;;" rel="tooltip" title="<?php echo __('When a contact completes the survey they will be taken to the web page you type here. Alternatively you can show them a thank you message by selecting the option above instead.', true);?>"><i class="icon-question-sign"></i></a>
                            </label>
                            <span class="header_hidden_container" style="display: none;">
                                <?php
                                    echo $this->Form->input('thankyou_url', array('label' => false, 'div'=> false,'class'=>'input-xxlarge', 'after'=>'', 'before'=>'', 'value' => ''));
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><?php echo  __('Email responses to me');?></label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('send_responses_email', array('label' => false, 'div'=> false,'class'=>'input-xxlarge', 'div'=>false, 'placeholder'=>'Your Email'));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><?php echo __('Break per questions');?></label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('controls_per_page', array('label' => false, 'div'=> false,'class'=>'input-xxlarge', 'value'=>10));
                            ?>
                          <span class="help-inline">
                                <a href="javascript:;;" rel="tooltip" title="<?php echo __('This option is to break your survey after number of questions you specified. For example, you entered 10 then your survey will break and move to the next page after every 10 questions.');?>"><i class="icon-question-sign"></i></a>
                            </span>
                        </div>
                    </div>
                    <div class="page-header"><h4>Advance options</h4></div>
                    <div class="control-group">
                        <label class="control-label"><?php echo __('Error Message');?></label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('error_message', array('value' => __('Oops... something went wrong when trying to save your survey responses. Take a look at the errors below and try again.', true), 'label' => false, 'div'=> false,'class'=>'input-xxlarge'));
                            ?>
                             <spa class="help-inline"><a href="javascript:;;" rel="tooltip" title="<?php echo __('If something goes wrong when trying to save survey responses your contacts will be shown this error message.');?>"><i class="icon-question-sign"></i></a></spa>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><?php echo __('Submit Form');?></label>
                        <div class="controls">
                            <?php
                            echo $this->Form->input('submit_button_text', array('value' => __('Submit Form', true), 'label' => false, 'div'=> false,'class'=>'input-xxlarge'));
                            ?>
                            <span class="help-inline">
                                <a href="javascript:;;" rel="tooltip" title="<?php echo __('This text will be shown on the button at the bottom of the page. Subscribers can click the button when they\'re done filling in your survey.')?>"><i class="icon-question-sign"></i></a>
                            </span>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>

<?php $this->append('script');?>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js"></script>
<?php echo $this->Html->css(array('/survey/css/formbuilder/jquery.formbuilder.css')); ?>
<?php echo $this->Html->script(array('/survey/js/jquery/json2','/survey/js/jquery/jquery.browser.min.js','/survey/js/formbuilder/jquery.formbuilder', '/survey/js/formbuilder/surveys_design', '/survey/js/jquery/jquery.placeholder.min')); ?>
    <script type="text/javascript">
        $(function(){

            $('#my-form-builder').formbuilder({
                'save_url': '<?php echo $this->Html->url('/survey/surveys/save_design'); ?>',
                'preview_url': '<?php echo $this->Html->url('/survey/surveys/preview'); ?>',
                'useJson' : true,
                'messages':{
                    add                     : "<span class='btn'><i class=\"icon-plus\"></i> Add</span>",
                    hide                    : '<i class="icon-folder-open"></i>',
                    show                    : '<i class="icon-folder-close"></i>',
                    remove                  : '<i class="icon-remove"></i>'
                },
                'is_child' : false
            });

            $('input, textarea').placeholder();
        });
    </script>
<?php $this->end();?>