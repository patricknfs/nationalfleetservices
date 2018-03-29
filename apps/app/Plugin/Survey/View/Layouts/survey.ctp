<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Online Survey</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href='https://fonts.googleapis.com/css?family=Rationale' rel='stylesheet' type='text/css' />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->

      <!-- jquery -->
    <?php
        echo $this->Html->css(array('/survey/css/bootstrap/bootstrap.min', '/survey/css/bootstrap/bootstrap-datepicker'));
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style type="text/css">
        body{
            background: url(<?php echo $this->Html->url("/survey/img/dark_fish_skin.png");?>);
        }
    </style>
  </head>

  <body>
    <div id="survey-container" class="container">
        <div class="row">
            <div class="span12">
                <div class="form-content">
                    <?php
                    echo $this->element('surveys/top_survey');
                    ?>
                    <cake:nocache>
                    <?php
                    echo $this->Session->flash();
                    echo $this->Session->flash("auth");
                    ?>
                </cake:nocache>
                <?php
                echo $content_for_layout;
                ?>
            </div>
        </div>
    </div>
</div>
</body>

<?php
echo $this->Html->script(array('/survey/js/bootstrap/bootstrap.min.js', '/survey/js/bootstrap/bootstrap-datepicker.js','/survey/js/jquery/jquery.browser.min.js'));
?>
<script type="text/javascript">
$(function(){
    $('a[rel="tooltip"]').tooltip('hide');
});
</script>
</html>