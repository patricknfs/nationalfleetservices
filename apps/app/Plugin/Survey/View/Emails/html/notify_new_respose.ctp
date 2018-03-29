<table border="0" width="100%">
    <tr>
        <td>Hello,</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <h3>
            <?php
            if(isset($survey)){
                echo sprintf(__("Response for \"%s\"", true), $survey['Survey']['name']);
            }
            ?>
            </h3><hr/>
        </td>
    </tr>
    <?php
        $form_label = array_values($form_label);
    ?>    
    <?php
        $i=0;
        foreach ($contents as $field => $content):
            if(is_array($content)){        
                if(empty($content)){
                    continue;
                }
                
                $print = null;
                foreach($content as $data){
                    if(!$data){
                        continue;
                    }
                    
                    if(isset($form_structure[$i][$data])){
                        $data = $form_structure[$i][$data];
                    }
                    $print .= "<li>".$data."</li>";
                }
                $content = "<ul>".$print."</ul>";
            }else{                
                if(isset($form_structure[$i]) && is_array($form_structure[$i])){
                    $content = (isset($form_structure[$i][$content])) ? $form_structure[$i][$content] : $content;
                    $content = "<ul><li>".$content."</li></ul>";
                }else{
                    $content = "<ul><li>".h($content)."</li></ul>";
                }                
            }
            
            if(empty($content)){
                $content = __("(No Response was provided)", true);
            }            
            
            
            $label = (isset($form_label[$i]) && !empty($form_label[$i])) ? $form_label[$i] : Inflector::humanize($field);
            $i++;
    ?>

        <tr><td><strong><?php echo $label;?></strong></td></tr>
        <tr><td><?php echo $content;?></td></tr>

   <?php endforeach; ?>      
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Yours sincerely, <br>
             Support Team. </td>
    </tr>
</table>
<?php // /exit;?>