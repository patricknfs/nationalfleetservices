<?php
/**
 * @autor       Valentín García
 * @website     www.valentingarcia.com.mx
 * @package		Joomla.Site
 * @subpackage	mod_circle_contact
 * @copyright	Copyright (C) 2012 Valentín García. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
	  
//library
jimport('joomla.application.module.helper');

//vars
$moduleclass_sfx	= htmlspecialchars($params->get('moduleclass_sfx'));
//$c_emailto = explode( '@', $params->get('emailto') );
$c_emailto = $params->get('emailto');
$c_subject = $params->get('subject');
$c_justdata = $params->get('justdata');
//$c_justdata2 = $params->get('justdata2');
//$c_justdata3 = $params->get('justdata3');

echo '<div class="' . $moduleclass_sfx . ' col2-3 element clearfix all section-' . $module->position . '">
	<div class="col1-3 connect">
        <div class="images"><img src="' . JURI::base() . 'templates/vg_myfolio/images/contact.jpg" alt="" /></div>
      </div>
      <div class="white-right2 col1-3 vg-contact-module">';
	
        if ($module->showtitle) {
			echo '<h2>' . $module->title . '</h2>';
		}
		
    echo '<div id="contact">
          <div id="message"></div>
          <form method="post" action="' . JURI::base() . 'modules/mod_circle_contact/ajax/send.php" name="contactform" id="contactform" autocomplete="off">
            <input type="hidden" name="emailto" id="emailto" value="' . $c_emailto . '" />
			<input type="hidden" name="subject" id="subject" value="' . $c_subject . '" />
			
			<fieldset>
            <div class="alignleft padding-right">
              <label for="name" accesskey="U"><span class="required">' . JText::_('VG_CONTACT_NAME') . '</span></label>
              <input name="name" type="text" id="name" size="30" value="' . JText::_('VG_CONTACT_NAME') . ' *" onblur="if (this.value==\'\') this.value=\'' . JText::_('VG_CONTACT_NAME') . ' *\';" onfocus="if (this.value==\'' . JText::_('VG_CONTACT_NAME') . ' *\') this.value=\'\';" />
              <label for="email" accesskey="E"><span class="required">' . JText::_('VG_CONTACT_EMAIL') . '</span></label>
              <input name="email" type="text" id="email" size="30" value="' . JText::_('VG_CONTACT_EMAIL') . ' *" onblur="if (this.value==\'\') this.value=\''.JText::_('VG_CONTACT_EMAIL').' *\';" onfocus="if (this.value==\''.JText::_('VG_CONTACT_EMAIL').' *\') this.value=\'\';" />
            </div>
            <label for="comments" accesskey="C"><span class="required">' . JText::_('VG_CONTACT_MESSAGE') . '</span></label>
            <textarea name="comments" cols="40" rows="3" id="comments" onblur="if (this.value==\'\') this.value=\''.JText::_('VG_CONTACT_MESSAGE').' *\';" onfocus="if (this.value==\''.JText::_('VG_CONTACT_MESSAGE').' *\') this.value=\'\';" >' . JText::_('VG_CONTACT_MESSAGE') . ' *</textarea>
            <input type="submit" class="submit" id="submit" value="&raquo; ' . JText::_('VG_CONTACT_SEND') . '" />
            </fieldset>
          </form>
        </div>
	</div>
</div>';		
?>

<script>
// mail-form
jQuery(document).ready(function(){

jQuery('#contactform').submit(function(){

var action = jQuery(this).attr('action');

jQuery("#message").slideUp(750,function() {
jQuery('#message').hide();

 	jQuery('#submit')
.after('<img src="<?php echo JURI::base(); ?>templates/vg_myfolio/images/ajax-loader.gif" class="loader" />')
.attr('disabled','disabled');

jQuery.post(action, {
emailto: jQuery('#emailto').val(),
subject: jQuery('#subject').val(),
name: jQuery('#name').val(),
email: jQuery('#email').val(),
comments: jQuery('#comments').val()
},
function(data){
document.getElementById('message').innerHTML = data;
jQuery('#message').slideDown('slow');
jQuery('#contactform img.loader').fadeOut('slow',function(){jQuery(this).remove()});
jQuery('#submit').removeAttr('disabled');
//if(data.match('success') != null) jQuery('#contactform').slideUp('slow');
jQuery('#message').has('.error_message').mousemove(function() {
jQuery(this).hide();
});
jQuery('#message').has('#success_page').hover(function() {
jQuery(this).show();
});
jQuery('#message').has('#success_page').mousemove(function() {
jQuery(this).show();
});

}
);

});

return false;

});

});
</script>