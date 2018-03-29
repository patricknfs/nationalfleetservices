<?php

/********************************* BASIC **************************************/

//------ logo ------//
if( $this->params->get( 'vg_logo' ) ){
	$vg_logo = $this->baseurl . '/' . $this->params->get( 'vg_logo' );
}else{
	$vg_logo = $this->baseurl . '/templates/' . $this->template . '/images/bg-logo.png';
}

//------ logo hd ------//
if( $this->params->get( 'vg_logo_2x' ) ){
	$vg_logo_2x = $this->baseurl . '/' . $this->params->get( 'vg_logo_2x' );
}else{
	$vg_logo_2x = $this->baseurl . '/templates/' . $this->template . '/images/bg-logo@2x.png';
}

//------ analytics ------//
$vg_analytics = $this->params->get( 'vg_analytics' );

//------ custom css ------//
$vg_css = $this->params->get( 'vg_css' );

//------ copy ------//
$vg_copy = $this->params->get( 'vg_copy' );

//------ top link ------//
$vg_toplink = $this->params->get( 'vg_toplink', 1 );


//------ preloader ------//
$vg_preload = $this->params->get( 'vg_preload', 1 );

/*
//------ scroll ------//
$vg_scroll = $this->params->get( 'vg_scroll', 1 );
*/
/********************************** FONTS *************************************/

//------ fontlink 1 ------//
$vg_fontlink_1 = $this->params->get( 'vg_fontlink_1', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,700,600,800' );

//------ fontfamily 1 ------//
$vg_fontfamily_1 = $this->params->get( 'vg_fontfamily_1', '\'Open Sans\'' );

//------ fontlink 3 ------//
/*$vg_fontlink_3 = $this->params->get( 'vg_fontlink_3', 'http://fonts.googleapis.com/css?family=Lato:400,700,900,300' );

//------ fontfamily 3 ------//
$vg_fontfamily_3 = $this->params->get( 'vg_fontfamily_3', '\'Lato\', sans-serif' );
*/

/********************************** COLORS *************************************/

//------ bg content image ------//
$vg_bgcontentimage = $this->params->get( 'vg_bgcontentimage' );

//------ bg content area ------//
$vg_bgcontent = $this->params->get( 'vg_bgcontent', '#000' );

//------ bg header area ------//
$vg_bgheader = $this->params->get( 'vg_bgheader', '#0B0B0B' );

//------ bg footer area ------//
$vg_bgfooter = $this->params->get( 'vg_bgfooter', '#0B0B0B' );

/********************************* ADVANCED ***********************************/

//------ menu one page ------//
$vg_menu_one_page = $this->params->get( 'vg_menu_one_page', 'mainmenu' );

//------ load active menu data ------//
$db = JFactory::getDBO();
$query = "SELECT * FROM #__menu WHERE menutype = '" . $vg_menu_one_page . "' AND type = 'url' AND published = 1 ORDER BY lft ASC";
	$db->setQuery( $query );
	$results = $db->loadObjectList();	

//------ alerts for one page custom modules ------//
$vg_alert_one_page = $this->params->get( 'vg_alert_one_page', 1 );
	
/*
//------ color ------//
$vg_color = $this->params->get( 'vg_color', '0,170,170' );
if( $vg_color == 'custom' ){
	//colorcustom
	$vg_colorcustom = $this->params->get( 'vg_colorcustom', '0,0,0' );
}else{
	//color
	$vg_colorcustom = $vg_color;
}
//custom color from url. EXAMPLE: ?vg_color=0,0,0
$vg_colorswitch = $this->params->get( 'vg_colorswitch', 1 );
if( $_GET['vg_color'] && $vg_colorswitch == 1 ){
	//colorcustom
	$vg_colorcustom = $_GET['vg_color'];
}
//custom js
/*$vg_js = $this->params->get( 'vg_js' );*/
?>