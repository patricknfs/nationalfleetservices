<?php if(isset($survey) && !empty($survey)):?>
<div class="navbar">
    <div>
        <div class="container">
            <a class="brand" href="#">
            <?php
                    if( (isset($survey['Survey']['logo']) || isset($survey['Survey']['header_logo']))  && isset($survey['Survey']['header_logo_dir']) &&
                    (!empty($survey['Survey']['logo']) || !empty($survey['Survey']['header_logo']))  && !empty($survey['Survey']['header_logo_dir'])):
                        $logo = (isset($survey['Survey']['logo'])) ? $survey['Survey']['logo'] : $survey['Survey']['header_logo'];
                        echo $this->Html->image('../files/surveys/'.$survey['Survey']['header_logo_dir'].'/'.$logo);
                    else:
                        echo "<h1>".$survey['Survey']['header_text']."</h1>";
                    endif;
            ?>
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
<hr/>