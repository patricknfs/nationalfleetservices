/**
 * jQuery Form Builder Plugin
 * Copyright (c) 2009 Mike Botsko, Botsko.net LLC (http://www.botsko.net)
 * http://www.botsko.net/blog/2009/04/jquery-form-builder-plugin/
 * Originally designed for AspenMSM, a CMS product from Trellis Development
 * Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * Copyright notice and license must remain intact for legal use
 */
 (function ($) {
    $.fn.formbuilder = function (options) {
        // Extend the configuration options with user-provided
        var defaults = {
            save_url: false,
            load_url: false,
            preview_url: false,
            control_box_target: false,
            serialize_prefix: 'frmb',
            messages: null
        };

        var defaultMessages = {
            save				: "Save",
            add_new_field                   : "Add New Field...",
            text				: "Text Field",
            title				: "Title",
            paragraph			: "Paragraph",
            checkboxes			: "List of Checkboxes",
            radio				: "List of Radio",
            select				: "Select List",
            text_field			: "Single Line of Text",
            textarea			: "Paragraph of Text",
            datepicker                      : "Date Picker",
            label				: "Label",
            paragraph_field                 : "Paragraph Field",
            select_options                  : "Select Options",
            add				: "Add",
            checkbox_group                  : "Checkbox Group",
            remove_message                  : "Are you sure you want to remove this element?",
            remove				: "Remove",
            radio_group			: "Radio Group",
            selections_message              : "Allow Multiple Selections",
            hide				: "Hide",
            required			: "Required",
            show				: "Show",
            section_break                   : "Section Break",
            tabbable                        : "New Tab",
            untitled_label                  : "Untitled",
            help_label                      : "Click here to enter some optional help text"
        };

        var opts = $.extend(defaults, options);
        if(opts.messages != null){
            $.each(defaultMessages, function(index, value) {
                if(opts.messages[index] == undefined){
                    opts.messages[index] = value;
                }
            })
        }else{
            opts.messages = defaultMessages;
        }

        var frmb_id = 'frmb-' + $('ul[id^=frmb-]').length++;
        return this.each(function () {
            var ul_obj = $(this).append('<ul id="' + frmb_id + '" class="frmb"></ul>').find('ul');
            var field = '', field_type = '', last_id = 1, help, form_db_id;
            // Add a unique class to the current element
            $(ul_obj).addClass(frmb_id);
            // load existing form data
            if (opts.load_url) {
                theTime = new Date().getTime();
                $loadURL = opts.load_url+"?"+theTime;
                $.getJSON($loadURL, function(json) {
                    form_db_id = json.form_id;
                    fromJson(json.form_structure);
                });
            }
            // Create form control select box and add into the editor
            var controlBox = function (target) {
                var select = '';
                var box_content = '';
                var save_button = '';
                var box_id = frmb_id + '-control-box';
                var save_id = frmb_id + '-save-button';
                // Add the available options
                select += '<option value="0">' + opts.messages.add_new_field + '</option>';
                select += '<option value="input_text">' + opts.messages.text + '</option>';
                select += '<option value="textarea">' + opts.messages.paragraph + '</option>';
                select += '<option value="checkbox">' + opts.messages.checkboxes + '</option>';
                select += '<option value="radio">' + opts.messages.radio + '</option>';
                select += '<option value="select">' + opts.messages.select + '</option>';
                select += '<option value="section_break">' + opts.messages.section_break + '</option>';
                select += '<option value="date_picker">' + opts.messages.datepicker + '</option>';
                select += '<option value="tabbable">' + opts.messages.tabbable + '</option>';
                // Build the control box and search button content
                box_content = '<select style="display:none" id="' + box_id + '" class="frmb-control">' + select + '</select>';
                save_button = '<input type="submit" id="' + save_id + '" class="frmb-submit" value="' + opts.messages.save + '"/>';
                // Insert the control box into page
                if (!target) {
                    $(ul_obj).before(box_content);
                } else {
                    $(target).append(box_content);
                }
                // Insert the search button
                //$(ul_obj).after(save_button); //tammuz hide this

                // Set the form save action
                $('#save_survey_form').click(function () {
                    save($(this));
                    return false;
                });
                // Set the form preview action
                $('#preview_survey_form').click(function () {
                    preview();
                    return false;
                });

                $('#collapse_survey_form').click(function () {
                   $('.frm-holder').each(function(){
                       $this = $(this);
                       $this.parent().find('div[class="legend"]').find('.toggle-form').addClass('closed').removeClass('open').html(opts.messages.show);
                       $this.hide();
                   });

                   return false;
               });

                $('#expand_survey_form').click(function () {
                   $('.frm-holder').each(function(){
                       $this = $(this);
                       $this.parent().find('div[class="legend"]').find('.toggle-form').addClass('open').removeClass('closed').html(opts.messages.hide);
                       $this.show();
                   });

                   return false;
               });
                // Add a callback to the select element
                $('#' + box_id).change(function () {
                    appendNewField($(this).val());
                    $(this).val(0).blur();
                    // This solves the scrollTo dependency
                    $offset = $('#frm-' + (last_id - 1) + '-item').offset();
                    if($offset != null || $offset != undefined){
                        $('html, body').animate({
                            scrollTop: $offset.top
                        }, 500);
                    }
                    return false;
                });
            }(opts.control_box_target);
            // Json parser to build the form builder
            var fromJson = function (json) {
                var values = '';
                var options = false;
                // Parse json
                $(json).each(function () {
                    // checkbox type
                    if (this.cssClass === 'checkbox') {
                        options = [this.title];
                        values = [];
                        $.each(this.values, function () {
                            values.push([this.value, this.baseline]);
                        });
                    }
                    // radio type
                    else if (this.cssClass === 'radio') {
                        options = [this.title];
                        values = [];
                        $.each(this.values, function () {
                            values.push([this.value, this.baseline]);
                        });
                    }
                    // select type
                    else if (this.cssClass === 'select') {
                        options = [this.title, this.multiple];
                        values = [];
                        $.each(this.values, function () {
                            values.push([this.value, this.baseline]);
                        });
                    }
                    else {
                        values = [this.values];
                    }
                    appendNewField(this.cssClass, values, options, this.required, this.help);
                });
};
            // Wrapper for adding a new field
            var appendNewField = function (type, values, options, required, help) {
                field = '';
                field_type = type;
                if (typeof (values) === 'undefined') {
                    values = '';
                }
                switch (type) {
                    case 'tabbable':
                    appendTabbableInput(values);
                    break;
                    case 'section_break':
                    appendSectionBreakInput(values, help);
                    break;
                    case 'date_picker':
                    appendDatePickerInput(values, required, help);
                    break;
                    case 'input_text':
                    appendTextInput(values, required, help);
                    break;
                    case 'textarea':
                    appendTextarea(values, required, help);
                    break;
                    case 'checkbox':
                    appendCheckboxGroup(values, options, required, help);
                    break;
                    case 'radio':
                    appendRadioGroup(values, options, required, help);
                    break;
                    case 'select':
                    appendSelectList(values, options, required, help);
                    break;
                }
            };

            // new tab
            var appendTabbableInput = function (values) {
                field += '<div class="frm-elements">';
                //field += '<label>' + opts.messages.label + '</label>';
                field += '<input class="edit-in-place" name="title" placeholder="' + opts.messages.untitled_label + ' Tab'+ '" type="text" value="' + values + '" /></div>';
                appendFieldLi(opts.messages.tabbable, field, 'no');
            };


            // section break line
            var appendSectionBreakInput = function (values, help) {
                help = (help != undefined) ? help : '';
                field += '<div class="frm-elements">';
                field += '<input class="edit-in-place" name="title" type="text" placeholder="' + opts.messages.untitled_label + ' ' + opts.messages.section_break + '" value="' + values + '" /></div>';
                field += '<div class="frm-elements">';
                field += '<input class="edit-in-place" name="help" placeholder="' + opts.messages.help_label + '" type="text" value="' + help + '" /></div>';
                help = '';
                appendFieldLi(opts.messages.section_break, field, 'no');
            };
            // date picker
            var appendDatePickerInput = function (values, required, help) {
                help = (help != undefined) ? help : '';
                field += '<div class="frm-elements">';
                //field += '<label>' + opts.messages.label + '</label>';
                field += '<input class="edit-in-place" name="title" type="text" placeholder="' + opts.messages.untitled_label + ' ' + opts.messages.datepicker + '" value="' + values + '" /></div>';
                field += '<div class="frm-elements">';
                //field += '<label>' + opts.messages.help_label + '</label>';
                field += '<input class="edit-in-place" name="help" placeholder="' + opts.messages.help_label + '" type="text" value="' + help + '" /></div>';
                help = '';
                appendFieldLi(opts.messages.datepicker, field, required);
            };
            // single line input type="text"
            var appendTextInput = function (values, required, help) {
                help = (help != undefined) ? help : '';
                field += '<div class="frm-elements">';
                //field += '<label>' + opts.messages.label + '</label>';
                field += '<input class="edit-in-place" id="title-' + last_id + '" type="text" placeholder="' + opts.messages.untitled_label + ' ' + opts.messages.text_field + '" value="' + values + '" />';
                field += '</div>';
                field += '<div class="frm-elements">';
                //field += '<label>' + opts.messages.help_label + '</label>';
                field += '<input class="edit-in-place" name="help" placeholder="' + opts.messages.help_label + '" type="text" value="' + help + '" /></div>';
                help = '';
                appendFieldLi(opts.messages.text, field, required, help);
            };
            // multi-line textarea
            var appendTextarea = function (values, required, help) {
                help = (help != undefined) ? help : '';
                field += '<div class="frm-elements">';
                //field += '<label>' + opts.messages.label + '</label>';
                field += '<input type="text" class="edit-in-place" placeholder="' + opts.messages.untitled_label + ' ' + opts.messages.textarea + '" value="' + values + '" />';
                field += '</div>';
                field += '<div class="frm-elements">';
                //field += '<label>' + opts.messages.help_label + '</label>';
                field += '<input class="edit-in-place" name="help" placeholder="' + opts.messages.help_label + '" type="text" value="' + help + '" /></div>';
                help = '';
                appendFieldLi(opts.messages.paragraph_field, field, required, help);
            };
            // adds a checkbox element
            var appendCheckboxGroup = function (values, options, required, help) {
                var title = '';
                help = (help != undefined) ? help : '';
                if (typeof (options) === 'object') {
                    title = options[0];
                }
                field += '<div class="chk_group">';
                field += '<div class="frm-fld">';
                //field += '<label>' + opts.messages.title + '</label>';
                field += '<input type="text" name="title" class="edit-in-place" placeholder="' + opts.messages.untitled_label + ' ' + opts.messages.checkbox + '" value="' + title + '" /></div>';
                field += '<div class="frm-elements">';
                //field += '<label>' + opts.messages.help_label + '</label>';
                field += '<input class="edit-in-place" name="help" placeholder="' + opts.messages.help_label + '" type="text" value="' + help + '" /></div>';
                field += '<div class="false-label"><strong>' + opts.messages.select_options + '</strong></div>';
                field += '<div class="fields">';
                if (typeof (values) === 'object') {
                    for (i = 0; i < values.length; i++) {
                        field += checkboxFieldHtml(values[i]);
                    }
                }
                else {
                    field += checkboxFieldHtml('');
                }
                field += '<div class="add-area"><a href="#" class="add add_ck">' + opts.messages.add + '</a></div>';
                field += '</div>';
                field += '</div>';
                help = '';
                appendFieldLi(opts.messages.checkbox_group, field, required, help);
            };
            // Checkbox field html, since there may be multiple
            var checkboxFieldHtml = function (values) {
                var checked = false;
                var value = '';
                if (typeof (values) === 'object') {
                    value = values[0];
                    checked = ( values[1] === 'checked' ) ? true : false;
                }
                field = '';
                field += '<table style="width:100%"><tr>';
                field += '<td width="1%" nowrap=""><input title="Set Default Value" type="checkbox"' + (checked ? ' checked="checked"' : '') + ' /></td>';
                field += '<td><input type="text" class="edit-in-place" placeholder="' + opts.messages.untitled_label + '" value="' + value + '" />';
                field += '<a href="#" class="remove" title="' + opts.messages.remove_message + '">' + opts.messages.remove + '</a></td>';
                field += '</tr></table>';
                return field;
            };
            // adds a radio element
            var appendRadioGroup = function (values, options, required, help) {
                var title = '';
                help = (help != undefined) ? help : '';
                if (typeof (options) === 'object') {
                    title = options[0];
                }
                field += '<div class="rd_group">';
                field += '<div class="frm-fld">';
                //field += '<label>' + opts.messages.title + '</label>';
                field += '<input type="text" name="title" class="edit-in-place" placeholder="' + opts.messages.untitled_label + ' ' + opts.messages.radio + '" value="' + title + '" /></div>';
                field += '<div class="frm-elements">';
                //field += '<label>' + opts.messages.help_label + '</label>';
                field += '<input class="edit-in-place" name="help" placeholder="' + opts.messages.help_label + '" type="text" value="' + help + '" /></div>';
                field += '<div class="false-label"><strong>' + opts.messages.select_options + '</strong></div>';
                field += '<div class="fields">';
                if (typeof (values) === 'object') {
                    for (i = 0; i < values.length; i++) {
                        field += radioFieldHtml(values[i], 'frm-' + last_id + '-fld');
                    }
                }
                else {
                    field += radioFieldHtml('', 'frm-' + last_id + '-fld');
                }
                field += '<div class="add-area"><a href="#" class="add add_rd">' + opts.messages.add + '</a></div>';
                field += '</div>';
                field += '</div>';
                help = '';
                appendFieldLi(opts.messages.radio_group, field, required, help);
            };
            // Radio field html, since there may be multiple
            var radioFieldHtml = function (values, name) {
                var checked = false;
                var value = '';
                if (typeof (values) === 'object') {
                    value = values[0];
                    checked = ( values[1] === 'checked' ) ? true : false;
                }
                field = '';
                field += '<table><tr>';
                field += '<td width="1%" nowrap="">';
                field += '<input title="Set Default Value" type="radio"' + (checked ? ' checked="checked"' : '') + ' name="radio_' + name + '" />';
                field += '</td>';
                field += '<td>';
                field += '<input type="text" class="edit-in-place" placeholder="' + opts.messages.untitled_label + '" value="' + value + '" />';
                field += '<a href="#" class="remove" title="' + opts.messages.remove_message + '">' + opts.messages.remove + '</a>';
                field += '</td>';
                field += '</tr></table>';
                return field;
            };
            // adds a select/option element
            var appendSelectList = function (values, options, required, help) {
                var multiple = false;
                var title = '';
                help = (help != undefined) ? help : '';
                if (typeof (options) === 'object') {
                    title = options[0];
                    multiple = options[1] === 'checked' ? true : false;
                }
                field += '<div class="opt_group">';
                field += '<div class="frm-fld">';
                //field += '<label>' + opts.messages.title + '</label>';
                field += '<input type="text" name="title" class="edit-in-place" placeholder="' + opts.messages.untitled_label + ' ' + opts.messages.select_list + '" value="' + title + '" /></div>';
                field += '<div class="frm-elements">';
                //field += '<label>' + opts.messages.help_label + '</label>';
                field += '<input class="edit-in-place" name="help" placeholder="' + opts.messages.help_label + '" type="text" value="' + help + '" /></div>';
                field += '';
                field += '<div class="false-label"><strong>' + opts.messages.select_options + '</strong></div>';
                field += '<div class="fields">';
                field += '<input type="checkbox" name="multiple"' + (multiple ? 'checked="checked"' : '') + '>';
                field += '<label class="auto">' + opts.messages.selections_message + '</label>';
                if (typeof (values) === 'object') {
                    for (i = 0; i < values.length; i++) {
                        field += selectFieldHtml(values[i], multiple);
                    }
                }
                else {
                    field += selectFieldHtml('', multiple);
                }
                field += '<div class="add-area"><a href="#" class="add add_opt">' + opts.messages.add + '</a></div>';
                field += '</div>';
                field += '</div>';
                help = '';
                appendFieldLi(opts.messages.select, field, required, help);
            };
            // Select field html, since there may be multiple
            var selectFieldHtml = function (values, multiple) {
                if (multiple) {
                    return checkboxFieldHtml(values);
                }
                else {
                    return radioFieldHtml(values);
                }
            };
            // Appends the new field markup to the editor
            var appendFieldLi = function (title, field_html, required, help) {

                var li = '';
                //field_type = (field_type=='select') ? '' : field_type;
                li += '<li id="frm-' + last_id + '-item" class="' + field_type + '">';
                li += '<div class="legend">';
                li += '<a id="frm-' + last_id + '" class="toggle-form" title="show/hide" href="#">' + opts.messages.hide + '</a> ';
                li += '<a id="del_' + last_id + '" class="del-button delete-confirm" href="#" title="' + opts.messages.remove_message + '"><span>' + opts.messages.remove + '</span></a>';
                li += '<span class="label"><strong id="txt-title-' + last_id + '">' + title + '</strong></span></div>';
                li += '<div id="frm-' + last_id + '-fld" class="frm-holder">';
                li += '<div class="frm-elements">';
                li += field_html;
                if(required != 'no'){
                    if (required) {
                        required = required === 'checked' ? true : false;
                    }
                    li += '<div class="frm-fld">';
                    li += '<label class="checkbox" for="required-' + last_id + '"><input class="required" type="checkbox" value="1" name="required-' + last_id + '" id="required-' + last_id + '"' + (required ? ' checked="checked"' : '') + ' />&nbsp;' + opts.messages.required + '</label></div>';
                }

                li += '</div>';
                li += '</div>';
                li += '</li>';
                if($.browser.msie){
                    li += '<script>$(function(){ $(\'.edit-in-place\').placeholder();  $(\'.edit-in-place\').each(function(){ $this = $(this); if($this.val() == ""){$this.val($this.attr("placeholder"));} });  $(\'.edit-in-place\').bind("click", {}, function(){ $this = $(this); if($this.val() == $this.attr("placeholder")){ $this.val(""); } });  });</script>';
                }

                $(ul_obj).append(li);
                $('#frm-' + last_id + '-item').hide();
                $('#frm-' + last_id + '-item').animate({
                    opacity: 'show',
                    height: 'show'
                }, 'slow');
                last_id++;
            };

            // handle field delete links
            $(document).on('click', 'a.remove', function () {
                $(this).closest('table').animate({
                    opacity: 'hide',
                    height: 'hide',
                    marginBottom: '0px'
                }, 'fast', function () {
                    $(this).remove();
                });
                return false;
            });
            // handle field display/hide
            $(document).on('click', 'a.toggle-form', function () {
                var target = $(this).attr("id");

                if ($(this).hasClass('closed')) {
                    $(this).removeClass('closed').addClass('open').html(opts.messages.hide);
                    $('#' + target + '-fld').animate({
                        opacity: 'show',
                        height: 'show'
                    }, 'slow');

                }else{
                    $(this).removeClass('open').addClass('closed').html(opts.messages.show);
                    $('#' + target + '-fld').animate({
                        opacity: 'hide',
                        height: 'hide'
                    }, 'slow');

                }
                return false;
            });
            // // handle delete confirmation
            $(document).on('click', 'a.delete-confirm', function () {
                var delete_id = $(this).attr("id").replace(/del_/, '');
                if (confirm($(this).attr('title'))) {
                    $('#frm-' + delete_id + '-item').animate({
                        opacity: 'hide',
                        height: 'hide',
                        marginBottom: '0px'
                    }, 'slow', function () {
                        $(this).remove();
                    });
                }
                return false;
            });
            // // Attach a callback to add new checkboxes
            $(document).on('click', 'a.add_ck', function () {
                $(this).parent().before(checkboxFieldHtml());
                return false;
            });
            // // Attach a callback to add new options
            $(document).on('click', 'a.add_opt', function () {
                $(this).parent().before(selectFieldHtml('', false));
                return false;
            });
            // // Attach a callback to add new radio fields
            $(document).on('click','a.add_rd', function () {
                $(this).parent().before(radioFieldHtml(false, $(this).parents('.frm-holder').attr('id')));
                return false;
            });
            // saves the serialized data to the server
            var save = function ($obj) {
                if (opts.save_url) {
                    $obj.button('loading');
                    $.ajax({
                        cache: false,
                        type: "POST",
                        url: opts.save_url,
                        data: {'Survey': {'form_id' : form_db_id, 'form_structure' : $(ul_obj).serializeFormList({prepend: opts.serialize_prefix})}},
                        success: function (response) {
                            if(response == 0){
                                $obj.button('reset');
                            }else{
                                //$obj.button('reset');
                                $('#SurveyId').val($.trim(response));
                                $('#surveyForm').submit();
                            }
                        }
                    });
                }
            };
            // preview the serialized data to the server
            var preview = function () {
                if (opts.preview_url) {
                    _serializeString = $(ul_obj).serializeFormList({
                        prepend: opts.serialize_prefix
                    });

                    href = opts.preview_url+ _serializeString + "&form_id=" + form_db_id;
                    //window.open(opts.preview_url, '_blank');
                    $('#SurveyDesign').val(_serializeString);
                    var formData = $("#surveyForm").serialize();
                    $.post(opts.preview_url, formData, function(res) {
                        if (res == 1) {
                            window.open(opts.preview_url, 'preview');
                            //$('#previewSurveyForm').attr('target', '_blank');
                            //$('#previewSurveyForm').submit();
                        }
                    });
                    window.open(opts.preview_url, 'preview');
                    return false;
                }
            };
        });
};
})(jQuery);
/**
 * generate unique id
 */
 function S4() {
   return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
}
function guid() {
   return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}




/**
 * jQuery Form Builder List Serialization Plugin
 * Copyright (c) 2009 Mike Botsko, Botsko.net LLC (http://www.botsko.net)
 * Originally designed for AspenMSM, a CMS product from Trellis Development
 * Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * Copyright notice and license must remain intact for legal use
 * Modified from the serialize list plugin
 * http://www.botsko.net/blog/2009/01/jquery_serialize_list_plugin/
 */
(function ($) {
    $.fn.serializeFormList = function (options) {
        // Extend the configuration options with user-provided
        var defaults = {
            prepend: 'ul',
            is_child: false,
            attributes: ['class']
        };
        var opts = $.extend(defaults, options);
        var serialJson = {};
        serialJson[opts.prepend] = {};
        // Begin the core plugin
        this.each(function () {
            var ul_obj = this;
            var li_count = 0;
            var c = 1;
            $(this).children().each(function () {
                serialJson[opts.prepend][li_count] = {};
                for (att = 0; att < opts.attributes.length; att++) {
                    var key = (opts.attributes[att] === 'class' ? 'cssClass' : opts.attributes[att]);
                    serialJson[opts.prepend][li_count][key] = $(this).attr(opts.attributes[att]);

                    // append the form field values

                    if (opts.attributes[att] === 'class') {
                        serialJson[opts.prepend][li_count]['required'] = ($('#' + $(this).attr('id')).find('input.required').is(':checked')) ? "checked" : "";

                        switch ($(this).attr(opts.attributes[att])) {
                            case 'checkbox':
                                serialJson[opts.prepend][li_count]['id'] = guid();
                                serialJson[opts.prepend][li_count]['values'] = {};
                                c = 1;
                                $('#' + $(this).attr('id') + ' input[type=text]').each(function () {
                                    $val = $(this).val().replace(/(<([^>]+)>)/ig,"");
                                    if ($(this).attr('name') === 'title') {
                                        serialJson[opts.prepend][li_count]['title'] = $val;
                                    }else if ($(this).attr('name') === 'help') {
                                        serialJson[opts.prepend][li_count]['help'] = $val;
                                    }else {
                                        serialJson[opts.prepend][li_count]['values'][c] = {};
                                        serialJson[opts.prepend][li_count]['values'][c]['value'] = $val;
                                        serialJson[opts.prepend][li_count]['values'][c]['baseline'] = ($(this).parent().prev('td').find('input').is(':checked')) ? "checked" : "";
                                    }
                                    c++;
                                });
                                break;
                            case 'radio':
                                serialJson[opts.prepend][li_count]['id'] = guid();
                                serialJson[opts.prepend][li_count]['values'] = {};
                                c = 1;
                                $('#' + $(this).attr('id') + ' input[type=text]').each(function () {
                                    $val = $(this).val().replace(/(<([^>]+)>)/ig,"");
                                    if ($(this).attr('name') === 'title') {
                                        serialJson[opts.prepend][li_count]['title'] = $val;
                                    }else if ($(this).attr('name') === 'help') {
                                        serialJson[opts.prepend][li_count]['help'] = $val;
                                    }else {
                                        serialJson[opts.prepend][li_count]['values'][c] = {};
                                        serialJson[opts.prepend][li_count]['values'][c]['value'] = $val;
                                        serialJson[opts.prepend][li_count]['values'][c]['baseline'] = ($(this).parent().prev('td').find('input').is(':checked')) ? "checked" : "";
                                    }
                                    c++;
                                });
                                break;
                            case 'select':
                                serialJson[opts.prepend][li_count]['id'] = guid();
                                serialJson[opts.prepend][li_count]['values'] = {};
                                c = 1;
                                serialJson[opts.prepend][li_count]['multiple'] = ($('#' + $(this).attr('id') + ' input[name=multiple]').is(':checked')) ? "checked" : "";;


                                $('#' + $(this).attr('id')).find('input[type=text]').each(function () {
                                    $val = $(this).val().replace(/(<([^>]+)>)/ig,"");
                                    if ($(this).attr('name') === 'title') {
                                        serialJson[opts.prepend][li_count]['title'] = $val;
                                    }else if ($(this).attr('name') === 'help') {
                                        serialJson[opts.prepend][li_count]['help'] = $val;
                                    }else {
                                        serialJson[opts.prepend][li_count]['values'][c] = {};
                                        serialJson[opts.prepend][li_count]['values'][c]['value'] = $val;
                                        serialJson[opts.prepend][li_count]['values'][c]['baseline'] = ($(this).parent().prev('td').find('input').is(':checked')) ? "checked" : "";
                                    }
                                    c++;
                                });
                                break;
                            default:
                                $('#' + $(this).attr('id') + ' input[type=text]').each(function () {
                                    $val = $(this).val().replace(/(<([^>]+)>)/ig,"");
                                    serialJson[opts.prepend][li_count]['id'] = guid();
                                    if ($(this).attr('name') === 'help') {
                                        serialJson[opts.prepend][li_count]['help'] = $val;
                                    }else{
                                        serialJson[opts.prepend][li_count]['values'] = $val;
                                    }
                                });
                                break;
                        }
                    }
                }
                li_count++;
            });
        });

        return (JSON.stringify(serialJson));
    };
})(jQuery);