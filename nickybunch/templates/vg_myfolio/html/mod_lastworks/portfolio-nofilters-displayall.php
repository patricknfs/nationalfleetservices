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

if(count($articles)) {//<-- A1.

	/*echo '<div class="' . $moduleclass_sfx . ' element clearfix col1-3 all menu-portfolio-' . $id_ . ' section-' . $module->position . '">
      <div class="images"><img src="templates/vg_myfolio/images/portfolio.jpg" alt="" /></div>
      <div class="white-bottom">';
	  
		//title
        if( $module->showtitle ){
			echo '<h2>' . $module->title . '</h2>';
        }
		
		//categories
		echo '<p>' . JText::_('VG_WHOLE_PORTFOLIO') . '</p>';
			
			echo '<p class="small">';
			
				//get each category
				foreach($categories as $category_) {//<--A2.
					echo '<a href="#filter=.category-' . $category_ . '-module-' . $id_ . ',+.menu-portfolio-' . $id_ . '">' . modLastWorksHelper::getCategoryLW( $category_ ) . ' <span class="arrow">&rarr;</span></a><br />';
				}
				echo '<a href="#filter=.section-' . $module->position . ',+.menu-portfolio-' . $id_ . '">' . JText::_('VG_VIEW_ALL') . ' <span class="arrow">&rarr;</span></a>
			</p>
      </div>
	</div>';*/

	foreach($articles as $article) {//<--A5.
	
		$images = json_decode($article->images);
		if( $images->image_intro ){
			//intro image from article
			$vg_img_ = '<img src="' . JURI::base() . $images->image_intro .'" alt="" />';
		}else{
			//default one as alert message
			$vg_img_ = '<img src="' . JURI::base() . 'templates/vg_myfolio/images/slideshow.jpg" alt="" />';
		}
		
		//full image
		if( $images->image_fulltext ){ 
			$vg_image_full_ = '<a class="popup" href="' . JURI::base() . $images->image_fulltext . '">';
			$vg_icon_ = '<div class="icons quote"></div>';
		}else{
			$vg_image_full_ = '<a class="popup" href="javascript:void(0)">';
			$vg_icon_ = '';
		}
					
		//in case vimeo:id or youtube:id exist in fulltext caption field
		if ( $images->image_fulltext_caption ){
			$vg_caption_cont = explode( ':', $images->image_fulltext_caption );
			if( $vg_caption_cont[0] == 'vimeo' ){
				$vg_image_full_ = '<a class="video-popup tippy" href="http://player.vimeo.com/video/' . $vg_caption_cont[1] . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&autoplay=1" title="" rel="group">';
				$vg_icon_ = '<div class="icons video"></div>';
			}
			if( $vg_caption_cont[0] == 'youtube' ){
				$vg_image_full_ = '<a class="video-popup tippy" href="http://www.youtube.com/embed/' . $vg_caption_cont[1] . '?autoplay=1" title="" rel="group">';
				$vg_icon_ = '<div class="icons video"></div>';
			}
		}
					
		echo '<div class="' . $moduleclass_sfx . ' element clearfix all col1-3 auto category-' . $article->catid . '-module-' . $id_ . ' section-' . $module->position . '"> 
			' . $vg_image_full_ . '
				<div class="images">
					' . $vg_img_ . '
					' . $vg_icon_ . '
					<div class="title">
						<div class="title-wrap">
							<h3> <span>' . $article->title . '</span></h3>
						</div>
					</div>
					<div class="subtitle">
						<div class="subtitle-wrap">
							<p> <span>' . modLastWorksHelper::getCategoryLW( $article->catid ) . '</span> </p>
						</div>
					</div>
				</div>
			</a> 
		</div>';
	
	}//.A5 -->

}// .A1 -->