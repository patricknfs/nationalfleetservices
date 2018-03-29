	var $j = jQuery.noConflict();
	$j(document).ready(function(){
		$j('#scrollItems').cycle({
			fx: 'scrollUp',
			speed: 500,
			timeout: 5000,
			pause: 1,
			next: '#HomeOfferScroller #controls .next',
			pager:'#HomeOfferScroller #controls #pager'
		});
	});