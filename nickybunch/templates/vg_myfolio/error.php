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

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"  dir="<?php echo $this->direction; ?>" lang="<?php echo $this->language; ?>"> <!--<![endif]-->
<head>
<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS -->
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/reset.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if gt IE 8]><!--><link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/retina-responsive.css" rel="stylesheet" type="text/css" media="screen" /><!--<![endif]-->
<!--[if !IE]> <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/retina-responsive.css" rel="stylesheet" type="text/css" media="screen" /> <![endif]-->
<!--[if lt IE 9]> <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/styles-ie8.css" rel="stylesheet" type="text/css" media="screen" /> <![endif]-->
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/joomla.css" rel="stylesheet" type="text/css" media="screen" />

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,700,600,800' rel='stylesheet' type='text/css' />

<style type="text/css">
h1#logo a { background-image:url(<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/bg-logo.png); }
h1, h2, h3, h4, span.arrow, .title-wrap h3, .subtitle-wrap p, #options li a, .blockquote span{ font-family:'Open Sans'; }
<?php echo $vg_css; ?> 
</style>
	
<!-- JS -->
<!--script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script-->
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/modernizr.js" type="text/javascript"></script>
<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/retina.js" type="text/javascript"></script>

<script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/mousewheel.js" type="text/javascript"></script>
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>
<body class="">

<header id="wrapper">
  <div class="container clearfix">
    <h1 id="logo"><a href="index.php" title=""> </a></h1>
  </div>
</header>
<!-- end header -->

<div class="container">
  <div id="container" class="clearfix">

		<div class="element auto clearfix col1-1 all home-page" id="vg-mainbody">
			<div class="white-bottom-component-404">
	  
				<p>
					<h1 style="font-size:80px;">404</h1>
					<?php echo JText::_('VG_404'); ?>
					<br/>
					<a class="vg-color" href="<?php echo $this->baseurl; ?>">&raquo; <?php echo Jtext::_('VG_404_HOME'); ?></a> or <a href='javascript:history.go(-1)' class="vg-color">&raquo; <?php echo Jtext::_('VG_404_RETURN'); ?></a>
					<br/><br/><br/>
				</p>
				
				<div class="clear"></div>
			</div>
		</div>

		
  </div>
</div>
<!-- end header -->

</body>
</html>