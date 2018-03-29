jQuery(document).ready(function(){

jQuery('#contactform').submit(function(){

var action = jQuery(this).attr('action');

jQuery("#message").slideUp(750,function() {
jQuery('#message').hide();

 	jQuery('#submit')
.after('<img src="images/ajax-loader.gif" class="loader" />')
.attr('disabled','disabled');

jQuery.post(action, {
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