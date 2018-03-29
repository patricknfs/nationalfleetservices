<?php
/**
 * @autor       Valent�n Garc�a
 * @website     www.valentingarcia.com.mx
 * @package		Joomla.Site
 * @subpackage	mod_lastworks
 * @copyright	Copyright (C) 2012 Valent�n Garc�a. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

echo '<div class="' . $moduleclass_sfx . ' element clearfix col2-3 all section-' . $module->position . '">';

if(count($articles)) {

	echo '<div class="col1-1-disabled">
        <div class="flexslider">
          <div class="images">
            <ul class="slides">';
				
				//intro images as slides
				foreach($articles as $article) {//<--A5.
					
					$images = json_decode($article->images);
					if( $images->image_intro ){
						//intro image from article
						echo '<li><img src="' . JURI::base() . $images->image_intro .'" alt="' . htmlspecialchars( $article->title ) . '" /></li>';
					}else{
						//default one as alert message
						echo '<li><img src="' . JURI::base() . 'templates/vg_myfolio/images/slideshow.jpg" alt="' . htmlspecialchars( $article->title ) . '" /></li>';
					}
						
				}//.A5 -->
				
            echo '</ul>
          </div>
        </div>
      </div>';	  
	  
      echo '<div class="clear"></div>';

}

echo '</div>';