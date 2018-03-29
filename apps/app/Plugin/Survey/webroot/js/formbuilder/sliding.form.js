$(function() {
    $('.datepickerField').datepicker();
    if($.browser.msie){
        $('#wrapper').attr('style', 'border:1px solid #E9E9E9;');
    }

    /*
	number of fieldsets
	*/
    var fieldsetCount = $('#surveyForm').children().length;

    /*
	current position of fieldset / navigation link
	*/
    var current 	= 1;

    /*
	sum and save the widths of each one of the fieldsets
	set the final sum as the total width of the steps element
	*/
    var stepsWidth	= 0;
    var widths 		= new Array();
    $('#steps .step').each(function(i){
        var $step 		= $(this);
        widths[i]  		= stepsWidth;
        stepsWidth	 	+= $step.width();
    });
    $('#steps').width(stepsWidth);

    /*
	to avoid problems in IE, focus the first input of the form
	*/
    $('#surveyForm').children(':first').find(':input:first').focus();

    /*
	show the navigation bar
	*/
    $('#navigation').show();

    /*
	when clicking on a navigation link
	the form slides to the corresponding fieldset
	*/
//    var fieldSet = {
//        slide : function(current){
//            /*
//            animate / slide to the next or to the corresponding
//            fieldset. The order of the links in the navigation
//            is the order of the fieldsets.
//            Also, after sliding, we trigger the focus on the first
//            input element of the new fieldset
//            If we clicked on the last link (confirmation), then we validate
//            all the fieldsets, otherwise we validate the previous one
//            before the form slided
//            */
//           prev = current - 1;
//            $('#steps').stop().animate({
//                marginLeft: '-' + widths[current-1] + 'px'
//            },500,function(){
//                if(current == fieldsetCount)
//                    validateSteps();
//                else
//                    validateStep(prev);
//                $('#surveyForm').children(':nth-child('+ parseInt(current) +')').find(':input:first').focus();
//            });
//        }
//    };

    function spoil(id){
        var divid = document.getElementById(id);
        divid.style.display = 'block';
        divid.scrollIntoView(true);
        return false;
    }
    $('#navigation a').bind('click',function(e){
        var $this	= $(this);
        var prev	= current;
        $this.closest('ul').find('li').removeClass('active');
        $this.parent().addClass('active');
        /*
                we store the position of the link
                in the current variable
                */
        current = $this.parent().index() + 1;
        /*
        animate / slide to the next or to the corresponding
        fieldset. The order of the links in the navigation
        is the order of the fieldsets.
        Also, after sliding, we trigger the focus on the first
        input element of the new fieldset
        If we clicked on the last link (confirmation), then we validate
        all the fieldsets, otherwise we validate the previous one
        before the form slided
        */
        //hide all fieldset
        $fieldsets = $('#steps fieldset');
        $fieldsets.each(function(idx, item){
            if(!$(this).hasClass('first-fieldset')){
                $(this).find('.fieldset-content').addClass('hidden');
            }
        });

        $fieldset = $('#steps fieldset')[current-1];
        $($fieldset).find('.fieldset-content').removeClass('hidden');

        $('#steps').stop().animate({
            marginLeft: '-' + widths[current-1] + 'px'
        },500,function(){
            if(current == fieldsetCount)
                validateSteps();
            else
                validateStep(prev);
            $('#formElem').children(':nth-child('+ parseInt(current) +')').find(':input:first').focus();

            return spoil('anchor-top');
        });
        e.preventDefault();
    });
    /*
	clicking on the tab (on the last input of each fieldset), makes the form
	slide to the next step
	*/
    $('#surveyForm > fieldset').each(function(){
        var $fieldset = $(this);
        var $element =  $fieldset.children(':last');

        $element.find('.next-step').click(function(){
            var error = validateStep(parseInt(current));
            if(error > 0){
                $('#navigation li:nth-child(' + (parseInt(current)+1) + ') a').click();
            }
        });

        $element.find('.prev-step').click(function(){
            $('#navigation li:nth-child(' + (parseInt(current)-1) + ') a').click();
//            current = parseInt(current)-1;
//            if(current > 0){
//                fieldSet.slide(current);
//            }
        });
    });

    /*
	validates errors on all the fieldsets
	records if the Form has errors in $('#surveyForm').data()
	*/
    function validateSteps(){
        var FormErrors = false;
        for(var i = 1; i < fieldsetCount; ++i){
            var error = validateStep(i);
            if(error == -1)
                FormErrors = true;
        }
        $('#surveyForm').data('errors',FormErrors);
    }

    /*
	validates one fieldset
	and returns -1 if errors found, or 1 if not
	*/
    function validateStep(step){
        if(step == fieldsetCount) return;

        var error = 1;
        $form = $("#surveyForm");
        $hasError = false;
        $form.children(':nth-child('+ parseInt(step) +')').find(".required").each(function(){
            $inputContainer = $(this);
            $hasButtonList = false;
            $isChecked = false;
            $inputContainer.find(":input:not(button)").each(function(){
                var $this = $(this);

                if($this.attr("type") == "radio" || $this.attr("type") == "checkbox"){
                     $hasButtonList = true;
                    if($this.is(":checked")){
                        $isChecked = true;
                    }
                }else{
                    var valueLength = jQuery.trim($this.val()).length;
                    if(valueLength == 0){
                        $hasError = true;
                        if( $this.parent().find(".tmp-check-required").length == 0){
                            $this.parent().append("<span class=\'help-inline tmp-check-required\'>Required</span>");
                        }
                        $this.closest('.required').addClass("error");
                    }else{
                        $this.parent().find(".tmp-check-required").remove();
                        $this.closest('.required').removeClass("error");
                    }
                }
            });

            if($isChecked == false && $hasButtonList){
                $hasError = true;
                if($inputContainer.find(".tmp-check-required").length == 0){
                    $inputContainer.find('.controls').append("<span class=\'help-inline tmp-check-required\'>Required</span>");
                }
                $inputContainer.addClass("error");
            }else if($hasButtonList && $isChecked){
                $inputContainer.find(".tmp-check-required").remove();
                $inputContainer.removeClass("error");
            }
        });

        var $link = $('#navigation li:nth-child(' + parseInt(step) + ') a');
        $link.parent().find('.error,.checked').remove();

        var valclass = 'checked';
        if($hasError){
            //$("#errorModal").modal("show");
            error = -1;
            valclass = 'error';
        }

        $('<span class="'+valclass+'"></span>').insertAfter($link);

        return error;
    }
    /**
     * Load captcha
     */
    $('#surveyCaptcha').load(BASE_URL+'/survey/surveys/captcha?'+Math.random(), function(){
        $('#survey-captcha').unbind('hover');
    });
    /*
	if there are errors don't allow the user to submit
	*/
    $('#btSubmitSurvey').bind('click',function(){
        $obj = $(this);
        $obj.button('loading');
        var error = validateStep(parseInt(current));
        if(error > 0){
           $secureForm = $('#security_code');
           $captcha = $('#security_code').val();
           if($captcha == ''){
                $secureForm.val('');
                $secureForm.addClass('error');
                $obj.button('reset');
           }else{
                $.get(BASE_URL+'/survey/surveys/captcha/'+$captcha, function(response){
                    if(response == 1){
                        $('#surveyForm').submit();
                    }else{
                        $secureForm.val('');
                        $secureForm.parent().parent().addClass('error');
                        $obj.button('reset');
                    }
                });
           }
        }else{
            $("#errorModal").modal("show");
            return false;
        }
    });

    $('.modal-close').bind('click', function(){
        $obj.button('reset');
    });
});