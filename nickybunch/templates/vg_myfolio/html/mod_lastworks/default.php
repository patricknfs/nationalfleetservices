<?php
/**
 * @autor       Valentín García
 * @website     www.valentingarcia.com.mx
 * @package		Joomla.Site
 * @subpackage	mod_lastworks
 * @copyright	Copyright (C) 2012 Valentín García. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

echo '';

if(count($articles)) {

	foreach($articles as $article) {//<--A2.
	
		$images = json_decode($article->images);
		$category = modLastWorksHelper::getCategoryLW( $article->catid );
		
		echo '<div class="' . $moduleclass_sfx . ' element clearfix auto col1-3 all section-' . $module->position . '">';
		
			//intro image
			if( $images->image_intro ){
				//intro image from article
				echo '<div class="images"><img src="' . JURI::base() . $images->image_intro . '" alt="' . htmlspecialchars( $article->title ) . '" /></div>';
				$vg_class_intro_ = '';
			}else{
				//default one as alert message
				//echo '<div class="images"><img src="' . JURI::base() . 'templates/vg_myfolio/images/default.jpg" alt="' . htmlspecialchars( $article->title ) . '" /></div>';
				$vg_class_intro_ = 'white-bottom-none';
			}
			
			echo '<div class="white-bottom ' . $vg_class_intro_ . '">
				<h2>' . $article->title . '</h2>
				' . $article->introtext . '
			</div>
		</div>';
		
	}//.A2-->

}

echo '';