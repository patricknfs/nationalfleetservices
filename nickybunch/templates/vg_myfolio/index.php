<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.vg_anthe
 * @copyright	Copyright (C) 2013 Valentín García - http://www.valentingarcia.com.mx - All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
 
 // No direct access.
defined('_JEXEC') or die;

/****************************** IF DS DEPRECATED ******************************/

if( !defined('DS') ){
	define( 'DS', DIRECTORY_SEPARATOR );
}

/********************************* SITE DATA *********************************/

$app = JFactory::getApplication();
	$sitename = $app->getCfg('sitename');
	
  $itemid = JRequest::getVar('Itemid');
  $menu = &JSite::getMenu();
  $active = $menu->getItem($itemid);
  $params = $menu->getParams( $active->id );
  $pageclass = $params->get( 'pageclass_sfx' );

/****************************** MODULE POSITIONS ******************************/

require('includes' . DS . 'module_positions.php');

/********************************* PARAMS *************************************/

require('includes' . DS . 'template_params.php');

//jquery
JHtml::_('jquery.framework');
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"  dir="<?php echo $this->direction; ?>" lang="<?php echo $this->language; ?>"> <!--<![endif]-->
<head>
<!--script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script-->
<jdoc:include type="head" />
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS -->
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/reset.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/contact.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/flexslider.css" rel="stylesheet" type="text/css" media="screen">
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/jquery.fancybox.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if gt IE 8]><!--><link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/retina-responsive.css" rel="stylesheet" type="text/css" media="screen" /><!--<![endif]-->
<!--[if !IE]> <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/retina-responsive.css" rel="stylesheet" type="text/css" media="screen" /> <![endif]-->
<!--[if lt IE 9]> <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/styles-ie8.css" rel="stylesheet" type="text/css" media="screen" /> <![endif]-->
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/joomla.css" rel="stylesheet" type="text/css" media="screen" />

<link href='<?php echo $vg_fontlink_1; ?>' rel='stylesheet' type='text/css' />

<style type="text/css">
.icons{ z-index:1; }
h1#logo a { background-image:url(<?php echo $vg_logo; ?>); }
h1, h2, h3, h4, span.arrow, .title-wrap h3, .subtitle-wrap p, #options li a, .blockquote span{ font-family:<?php echo $vg_fontfamily_1; ?>; }
body{ 
	background-color:<?php echo $vg_bgcontent; ?>; 
	<?php if( $vg_bgcontentimage ){ ?>
		background-image:url(<?php echo JURI::base() . $vg_bgcontentimage; ?>); 

		background-attachment:fixed; 
	<?php } ?>
}
#wrapper{ background-color:<?php echo $vg_bgheader; ?>; }
footer{ background-color:<?php echo $vg_bgfooter; ?>; }

@media only screen and (-Webkit-min-device-pixel-ratio: 1.5),
only screen and (-moz-min-device-pixel-ratio: 1.5),
only screen and (-o-min-device-pixel-ratio: 3/2),
only screen and (min-device-pixel-ratio: 1.5) {
	h1#logo a {
		background-image: url(<?php echo $vg_logo_2x; ?>);
	}
}
<?php echo $vg_css; ?> 
</style>
	
<!-- JS -->
<!--script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script-->
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery-easing-1.3.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/modernizr.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/retina.js" type="text/javascript"></script>
<!--<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.gomap-1.3.2.min.js" type="text/javascript"></script>-->
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.isotope.min.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.ba-bbq.min.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.isotope.load_home.js" type="text/javascript"></script>
<!--script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.form.js" type="text/javascript"></script-->
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/input.fields.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/responsive-nav.js" type="text/javascript"></script>
<!--script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.jtweetsanywhere-1.3.1.min.js" type="text/javascript"></script-->
<script defer src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.flexslider-min.js"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/image-hover.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/scrollup.js" type="text/javascript"></script>

<?php if( $vg_preload == 1 ){ ?>
	<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/preloader.js" type="text/javascript"></script>
<?php } ?>

<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/mousewheel.js" type="text/javascript"></script>
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>
<body class="<?php echo $pageclass; ?>">

<?php if( $vg_preload == 1 ){ ?>
	<!-- Preloader -->
	<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>
<?php } ?>

<header id="wrapper">
  <div class="container clearfix">
    <h1 id="logo"><a href="index.php" title="<?php echo htmlspecialchars( $sitename ); ?>"><?php echo $sitename; ?></a></h1>
    
	<?php if( $this->countModules('menu') )://START MAIN MENU ?>
		<jdoc:include type="modules" name="menu" style="mymenu" />		
	<?php else: ?>
		<p class="vg-alert"><?php echo JText::_('VG_MENU_ALERT'); ?></p>	
	<?php endif;//END MAIN MENU ?>
	
  </div>
</header>
<!-- end header -->

<div class="container">
  <div id="container" class="clearfix">
    
		<!-- COMPONENT TOP -->
		<?php if(  $this->countModules('component-top-a') ){// START CONTENT TOP A ?>
			<div class="element auto clearfix <?php echo $contenttop[0]; ?> all" id="vg-top-module-a">
				<div class="white-bottom-module">
	  
					<jdoc:include type="modules" name="component-top-a" style="top" />
					
				<div class="clear"></div>
				</div>
			</div>
		<?php }// END CONTENT TOP A ?>
		<?php if(  $this->countModules('component-top-b') ){// START CONTENT TOP B ?>
			<div class="element auto clearfix <?php echo $contenttop[1]; ?> all" id="vg-top-module-b">
				<div class="white-bottom-module">
	  
					<jdoc:include type="modules" name="component-top-b" style="top" />
					
				<div class="clear"></div>
				</div>
			</div>
		<?php }// END CONTENT TOP B ?>
		<?php if(  $this->countModules('component-top-c') ){// START CONTENT TOP C ?>
			<div class="element auto clearfix <?php echo $contenttop[2]; ?> all" id="vg-top-module-c">
				<div class="white-bottom-module">
	  
					<jdoc:include type="modules" name="component-top-c" style="top" />
					
				<div class="clear"></div>
				</div>
			</div>
		<?php }// END CONTENT TOP C ?>
		<!-- /COMPONENT TOP -->
	
	<?php if( $pageclass != 'hide-component' ){//<--A8. ?>
		<div class="element auto clearfix col1-1 all home-page" id="vg-mainbody">
			<div class="white-bottom-component">
	  
				<jdoc:include type="message" />
				<jdoc:include type="component" />
				
			<div class="clear"></div>
			</div>
		</div>
	<?php }//.A8--> ?>
	
		<!-- COMPONENT BOTTOM -->
		<?php if(  $this->countModules('component-bottom-a') ){// START CONTENT BOTTOM A ?>
			<div class="element auto clearfix <?php echo $contentbottom[0]; ?> all" id="vg-bottom-module-a">
				<div class="white-bottom-module">
	  
					<jdoc:include type="modules" name="component-bottom-a" style="top" />
					
				<div class="clear"></div>
				</div>
			</div>
		<?php }// END CONTENT BOTTOM A ?>
		<?php if(  $this->countModules('component-bottom-b') ){// START CONTENT BOTTOM B ?>
			<div class="element auto clearfix <?php echo $contentbottom[1]; ?> all" id="vg-bottom-module-b">
				<div class="white-bottom-module">
	  
					<jdoc:include type="modules" name="component-bottom-b" style="top" />
					
				<div class="clear"></div>
				</div>
			</div>
		<?php }// END CONTENT BOTTOM B ?>
		<?php if(  $this->countModules('component-bottom-c') ){// START CONTENT BOTTOM C ?>
			<div class="element auto clearfix <?php echo $contentbottom[2]; ?> all" id="vg-bottom-module-c">
				<div class="white-bottom-module">
	  
					<jdoc:include type="modules" name="component-bottom-c" style="top" />
					
				<div class="clear"></div>
				</div>
			</div>
		<?php }// END CONTENT BOTTOM C ?>
		<!-- /COMPONENT BOTTOM -->
		
	<?php require('includes' . DS . 'onepage_modules.php');//create onepage modules automatically based on menu External Links with syntax #section-customname ?>
	
		<!-- FOOTER -->
		<?php if(  $this->countModules('footer-a') ){// START CONTENT BOTTOM A ?>
			<div class="element auto clearfix <?php echo $contentfooter[0]; ?> all" id="vg-footer-module-a">
				<div class="white-bottom-module">
	  
					<jdoc:include type="modules" name="footer-a" style="top" />
					
				<div class="clear"></div>
				</div>
			</div>
		<?php }// END CONTENT BOTTOM A ?>
		<?php if(  $this->countModules('footer-b') ){// START CONTENT BOTTOM B ?>
			<div class="element auto clearfix <?php echo $contentfooter[1]; ?> all" id="vg-footer-module-b">
				<div class="white-bottom-module">
	  
					<jdoc:include type="modules" name="footer-b" style="top" />
					
				<div class="clear"></div>
				</div>
			</div>
		<?php }// END CONTENT BOTTOM B ?>
		<?php if(  $this->countModules('footer-c') ){// START CONTENT BOTTOM C ?>
			<div class="element auto clearfix <?php echo $contentfooter[2]; ?> all" id="vg-footer-module-c">
				<div class="white-bottom-module">
	  
					<jdoc:include type="modules" name="footer-c" style="top" />
					
				<div class="clear"></div>
				</div>
			</div>
		<?php }// END CONTENT BOTTOM C ?>
		<!-- /FOOTER -->
		
  </div>
</div>
<!-- end header -->
<footer>
  <div class="container">
    <div class="centered">
      
	  <jdoc:include type="modules" name="footer-d" style="blocks" />
	  
      <div class="small"><?php echo $vg_copy; ?></div>
    </div>
  </div>
</footer>

<?php if( $vg_toplink ){//<--A7. ?>
<!-- BACK TO TOP BUTTON -->
<div id="backtotop">
  <ul>
    <li><a id="toTop" href="#" onClick="return false"><?php echo JText::_('VG_TOP'); ?></a></li>
  </ul>
</div>
<?php }//.A7--> ?>

<?php if( $vg_analytics ){//<--A4. ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $vg_analytics; ?>']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<?php }//A4.--> ?>

</body>
</html>