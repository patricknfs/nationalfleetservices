<?php
/**
 * @package		Joomla.Site
 * @subpackage	Templates.vg_myfolio
 * @copyright	Copyright (C) 2012 Valentín García - http://www.valentingarcia.com.mx - All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

//mymenu
function modChrome_mymenu($module, &$params, &$attribs){

	echo $module->content;
	
}

//blocks
function modChrome_blocks($module, &$params, &$attribs){

	echo $module->content;
	
}

//top
function modChrome_top($module, &$params, &$attribs){

	$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
	
	echo '<div class="vg-component-top ' . $moduleclass_sfx . '">';
	
		/*if( $module->showtitle ){
			echo '<h2>' . $module->title . '</h2>';
		}*/
		
		echo $module->content;
		
	echo '</div>';
	
}
