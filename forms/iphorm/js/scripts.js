jQuery(document).ready(function($) {
	$('form.iphorm').iPhorm({
    successStart: function() {
        window.location = 'http://www.fleetstreetltd.co.uk/thanks.php';
    }
});
	
	// Tooltip settings
	if ($.isFunction($.fn.qtip)) {
		$('.iphorm-tooltip').qtip({
			content: {
				text: false
			},
			style: {
				classes: 'ui-tooltip ui-tooltip-shadow',
				width: '180px'
			},
			position: {
				my: 'left center',
				at: 'right center'
			}
		});
	}
	
	// Changes subject to a text field when 'Other' is chosen
	var subjectHtml = $('.subject-input-wrapper').html();	
	$('#subject').live('change', function () {		
		if ($(this).val() == 'Other') {
			$('.subject-input-wrapper').empty();
			newHtml = $('<input name="subject" type="text" id="subject" value="" />');
			$('.subject-input-wrapper').html(newHtml);
			$cancelOther = $('<a>').click(function () {
				$('.subject-input-wrapper').empty();
				$('.subject-input-wrapper').append(subjectHtml);
				$(this).remove();
				return false;
			}).attr('href', '#').addClass('cancel-button').attr('title', 'Cancel');
			newHtml.after($cancelOther);
		}
	});
}); // End document ready

//Image preloader
var images = new Array(
	'iphorm/images/close.png',
	'iphorm/images/success.png'
);
var imageObjs = new Array();
for (var i in images) {
	imageObjs[i] = new Image();
	imageObjs[i].src = images[i];
}