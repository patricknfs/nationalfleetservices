jQuery(document).ready(function(){
 
	 jQuery('.title-wrap, .subtitle-wrap').each(function() {
        jQuery(this).data('wrapping', jQuery(this).width());
        jQuery(this).css('width', 0);
      });

      jQuery('div.images').bind('mouseenter', function() {
        jQuery(this).find('.title-wrap').stop().each(function() {
          jQuery(this).animate({
            width: jQuery(this).data('wrapping')
          }, 400);
        });

        jQuery(this).find('.subtitle-wrap').stop().each(function() {
          jQuery(this).delay(200).animate({
            width: jQuery(this).data('wrapping')
          }, 400);
        });
      });

      jQuery('div.images').bind('mouseleave', function() {
        jQuery(this).delay(200).find('.title-wrap').stop().each(function() {
          jQuery(this).animate({
            width: 0
          }, 400);
        });

        jQuery(this).find('.subtitle-wrap').stop().each(function() {
          jQuery(this).animate({
            width: 0
          }, 400);
        });
      });
});