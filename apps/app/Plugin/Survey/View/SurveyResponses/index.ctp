<ul class="breadcrumb">
    <li>
        <?php echo $this->Html->link(__('Manage Survey'), array('controller'=>'surveys', 'action'=>'index'));?>
        <span class="divider">/</span>
    </li>
    <li class="active"><?php echo $survey['Survey']['name']; ?></li>
</ul>

<div class="bcContent form">
    <div class="page-header">
        <h3>
            <?php
            if(isset($survey)){
                echo sprintf(__("Response for \"%s\""), h($survey['Survey']['name']));
            }
            ?>
        </h3>
    </div>

    <?php echo $this->element('surveys/view_results_toolbar');?>
<?php
//pr($form_label);
//pr($form_structure);
//pr($survey_responses);

if(!empty($survey_responses)):
$totalResponse  = $survey['Survey']['survey_response_count'];
$i=0;
$form_label = array_values($form_label);
foreach($survey_responses as $field => $values):
    $numOfResponse = count(array_filter($values));
    $label = (isset($form_label[$i]) && !empty($form_label[$i])) ? $form_label[$i] : Inflector::humanize($field);
?>
<div>
    <?php /*
    <ul class="breadcrumb">
        <li class="active"><strong><?php echo Inflector::humanize($field)?></strong></li>
        <li class="active pull-right">
            <strong>&nbsp;&nbsp;&nbsp;Responses (<?php echo $numOfResponse;?>)</strong>
        </li>
<!--        <li class="active pull-right">
            <strong>Percent (<?php //echo round(($numOfResponse/$totalResponse)*100, 2);?> %) </strong>
        </li>-->
    </ul>
     *
     */?>
    <div class="accordion">
        <div class="accordion-group">
            <div class="accordion-heading" style="background-color: #f0f0f0;">
                <a href="#collapse<?php echo $i;?>" data-toggle="collapse" class="accordion-toggle">
                    <i class="icon-folder-open"></i>
                    <strong><?php echo $this->Text->excerpt($label, null, 60);?></strong>
                    <span class="pull-right"><strong>&nbsp;&nbsp;&nbsp;Responses (<?php echo $numOfResponse;?>)</strong></span>
                </a>
            </div>
            <div class="accordion-body collapse" id="collapse<?php echo $i;?>" style="height: auto;">
                <div class="accordion-inner">
                      <table class="table table-bordered">
                        <?php
                            $statistic_options = array();
                            foreach ($values as $responseID => $value):
                                if(!$value) continue;

                                if(is_array($form_structure[$i])):
                                    if(is_array($value)):
                                        $value = array_values($value);
                                        $z = 0;
                                        foreach($form_structure[$i] as $idx => $initialVal):
                                            $z++;
                                            $initialVal = (empty($initialVal)) ? sprintf(__('Undefined %s', true), $z) : $initialVal;
                                            @$statistic_options[$initialVal] += 1;
                                            if(!in_array($idx, $value)){
                                                @$statistic_options[$initialVal] -= 1;
                                            }
                                        endforeach;
                                    else:
                                        $z = 0;
                                        foreach($form_structure[$i] as $idx => $initialVal):
                                            $z++;
                                            $initialVal = (empty($initialVal)) ? sprintf(__('Undefined %s', true), $z) : $initialVal;
                                            @$statistic_options[$initialVal] += 1;
                                            if($idx != $value){
                                                @$statistic_options[$initialVal] -= 1;
                                            }
                                        endforeach;

                                    endif;

                                else:
                        ?>
                                <tr>
                                    <td>
                                        <?php echo h($value);?>
                                    </td>
                                    <td width="1%" nowrap="">
                                        <?php echo $this->Html->link('<i class="icon-eye-open"></i>', array('action'=>'view', $responseID, $id) ,array('escape'=>false, 'rel'=>'tooltip', 'title'=>__('Browse', true)));?>
                                    </td>
                                </tr>

                        <?php
                                endif;
                            endforeach;

                            $totalPerQuestion = array_sum($statistic_options);
                            foreach($statistic_options as $opt => $val):
                                $percent = ($totalPerQuestion) ? round(($val/$totalPerQuestion)*100, 2) : 0;
                                $opt = (empty($opt)) ? __('Undefined', true) : $opt;
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $opt;?>
                                    </td>
                                    <td width="200px" nowrap="">
                                        <?php echo h($val);?>
                                    </td>
                                    <td width="1%" nowrap="">
                                        <?php echo $percent;?> %
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$i++;
endforeach;
else:
    echo "<h3>".__('No data found', true)."</h3>";
endif;
?>

</div>

<?php $this->append('script');?>
    <?php echo $this->Html->css(array('/survey/css/formbuilder/jquery.formbuilder.min'));  ?>
    <script type="text/javascript">
    $(function(){
       $('#collapse_all_responses').bind('click', {}, function(){
           $(".collapse").collapse('hide');
       });
       $('#expand_all_responses').bind('click', {}, function(){
           $(".collapse").collapse('show');
       });
    });
    <?php
        $script  = '$(".collapse").collapse(\'show\');';
        $script .= '$(\'.collapse\').on(\'shown\', function () {  $(this).prev("div").find(".icon-folder-close").removeClass("icon-folder-close").addClass("icon-folder-open");  });';
        $script .= '$(\'.collapse\').on(\'hidden\', function () {  $(this).prev("div").find(".icon-folder-open").removeClass("icon-folder-open").addClass("icon-folder-close");  });';
        echo $script;
    ?>
    </script>
<?php $this->end();?>