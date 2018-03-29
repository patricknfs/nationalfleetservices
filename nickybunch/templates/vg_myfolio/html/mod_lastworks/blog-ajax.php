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
		//$category = modLastWorksHelper::getCategoryLW( $article->catid );
		//intro image
		if( $images->image_intro ){ 
			$vg_icon_ = '<div class="icons aside"></div>';
			$vg_class_intro_ = '';
		}else{
			$vg_icon_ = '<div class="icons bubble"></div>';
			$vg_class_intro_ = 'white-bottom-none';
		}
					
		//in case vimeo:id or youtube:id exist in fulltext caption field
		if ( $images->image_intro_caption ){
			$vg_caption_cont = explode( ':', $images->image_intro_caption );
			if( $vg_caption_cont[0] == 'vimeo' ){
				$vg_icon_ = '<div class="icons video"></div>';
			}
			if( $vg_caption_cont[0] == 'youtube' ){
				$vg_icon_ = '<div class="icons video"></div>';
			}
		}
		
		//intro
		echo '<div class="' . $moduleclass_sfx . ' element clearfix auto col1-3 all blog-' . $article->id . '-module-' . $id_ . ' section-' . $module->position . '">
			<a href="#filter=.section-' . $module->position . '%3Anot(.blog-' . $article->id . '-module-' . $id_ . '),+.post-' . $article->id . '-module-' . $id_ . '">';
		
			//intro image
			if( $images->image_intro ){
				//intro image from article
				echo '<div class="images"><img src="' . JURI::base() . $images->image_intro . '" alt="' . htmlspecialchars( $article->title ) . '" /></div>';
			}else{
				//default one as alert message
				//echo '<div class="images"><img src="' . JURI::base() . 'templates/vg_myfolio/images/default.jpg" alt="' . htmlspecialchars( $article->title ) . '" /></div>';
			}
			
			//display icon when $vg_class_intro_ NOT like: 'white-bottom-none'
			if( $vg_class_intro_ != 'white-bottom-none' ){
				echo $vg_icon_ ;
			}
			
			echo '<div class="white-bottom ' . $vg_class_intro_ . '">
				<h2>' . $article->title . '</h2>
				' . $article->introtext . '
			</div>
			</a>
		</div>';
		
		//full
		echo '<div class="' . $moduleclass_sfx . ' element clearfix auto col2-3 post post-' . $article->id . '-module-' . $id_ . '">
			<a href="#filter=.section-' . $module->position . '%3Anot(.blog-' . $article->id . '-module-' . $id_ . '),+.post-' . $article->id . '-module-' . $id_ . '">';
		
			//intro image
			if( $images->image_fulltext ){
				//intro image from article
				echo '<div class="images"><img src="' . JURI::base() . $images->image_fulltext . '" alt="' . htmlspecialchars( $article->title ) . '" /></div>';
				$vg_class_full_ = '';
			}else{
				//default one as alert message
				$vg_class_full_ = 'white-bottom-none';
				//echo '<div class="images"><img src="' . JURI::base() . 'templates/vg_myfolio/images/default.jpg" alt="' . htmlspecialchars( $article->title ) . '" /></div>';
			}
			
			echo '<a href="#filter=.section-' . $module->position . '"><div class="icons close"></div></a>';
			
			echo '<div class="white-bottom ' . $vg_class_full_ . '">
				<h2>' . $article->title . '</h2>
				' . $article->introtext . '
				' . $article->fulltext . '
			</div>
			</a>
		</div>';
		
	}//.A2-->

}

echo '';