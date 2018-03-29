<ul class="breadcrumb">
    <li>
        <?php echo $this->Html->link(__('Manage Survey'), array('controller'=>'surveys', 'action'=>'index'));?>
        <span class="divider">/</span>
    </li>
    <li class="active"><?php echo $response['Survey']['name']; ?></li>
</ul>

<div class="bcContent form">
    <?php if(!empty($response)):?>
    <div class="page-header">
        <h3>
            <?php
            if(isset($response)){
                echo sprintf(__("Response for \"%s\""),  h($response['Survey']['name']));
            }
            ?>
        </h3>
    </div>
    <?php
        $form_label = array_values($form_label);
        $contents = unserialize($response['SurveyResponse']['content']);
    ?>
    <?php
        $i=0;
        foreach ($contents as $field => $content):
            if(is_array($content)){
                if(empty($content)){
                    continue;
                }

                $print = null;
                $z=0;;
                foreach($content as $data){
                    if(!$data){
                        continue;
                    }
                    $z++;
                    if(isset($form_structure[$i][$data])){
                        $data = (isset($form_structure[$i][$data]) && !empty($form_structure[$i][$data])) ? $form_structure[$i][$data] : sprintf(__('Undefined %s', true), $z);
                    }
                    $print .= "<li>".$data."</li>";
                }
                $content = ($print) ? "<ul>".$print."</ul>" : '';
            }else{
                if(isset($form_structure[$i]) && is_array($form_structure[$i])){
                    $content = (isset($form_structure[$i][$content])) ? $form_structure[$i][$content] : $content;
                    $content = ($content) ? "<ul><li>".$content."</li></ul>" : "";
                }else{
                    $content = ($content) ? "<ul><li>".h($content)."</li></ul>" : "";
                }
            }

            if(empty($content)){
                $content = __("(No Response was provided)", true);
            }


            $label = (isset($form_label[$i]) && !empty($form_label[$i])) ? $form_label[$i] : sprintf(__('Undefined %s', true), $i+1);
            $i++;
    ?>

        <table class="table table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th class="header"><?php echo $label;?></td>
                </tr>
            </thead>
            </tbody>
                <tr>
                    <td><em><?php echo $content;?></em></td>
                </tr>
            </tbody>
        </table>

    <?php endforeach; ?>


    <div class="form-actions">
        <?php
            $response_list = array_keys($responseList);
            // Find the index of the current item
            $current_index = array_search($current_id, $response_list);
            // Find the index of the next/prev items
            $next = $current_index + 1;
            $prev = $current_index - 1;

            $pClass = 'disabled';
            $nClass = 'disabled';
            $previous = '#';
            $forward = '#';
            if ($prev >= 0){
                $pClass = '';
                $previous = $this->Html->url('/survey/survey_responses/view/'.$response_list[$prev].'/'.$survey_id);
            }

            if($next < count($response_list)){
                $nClass = '';
                $forward = $this->Html->url('/survey/survey_responses/view/'.$response_list[$next].'/'.$survey_id);
            }

            $nextURL = ($forward != '#') ? base64_encode($forward) : null;
        ?>
        <table style='width:100%'>
            <tr>
                <td style="width:150px;">
                     <a href="<?php echo $previous;?>" class="btn <?php echo $pClass;?>" title="Previous" ><i class="icon-chevron-left"></i> previous</a>
                </td>
                <td style="width: 250px;padding-top: 10px;">
                    <?php echo $this->Form->input(__('ResponseList'), array('options'=>  $responseList, 'div'=>false, 'label'=>false, 'value'=>$current_id,
                                                                          'onchange'=>'javascript: window.location.href="'.$this->Html->url('/survey/survey_responses/view/').'"+this.value+"/'.$response['SurveyResponse']['survey_id'].'";'
                                                                    ));?>
                </td>
               <td style="width:150px;">
                    <?php echo $this->Html->link('<i class="icon-trash icon-white"></i> '.__('Delete', true), array('action' => 'delete', $current_id, $response['SurveyResponse']['survey_id'], $nextURL), array('escape'=>false, 'class'=>'btn btn-danger', 'style'=>'color:white'), __('Are you sure you want to delete ?', true)); ?>
                </td>
                <td>
                    <a href="<?php echo $forward;?>" class="btn <?php echo $nClass;?>" title="Next" >next <i class="icon-chevron-right"></i></a>
                </td>
            </tr>
        </table>

    </div>
    <?php
        else:
            echo "<h3>".__("No contain found.", true)."</h3>";
        endif;
    ?>
</div>
<?php
$this->append('script');
echo $this->Html->css(array('/survey/css/formbuilder/jquery.formbuilder.min'));
$this->end();
?>
