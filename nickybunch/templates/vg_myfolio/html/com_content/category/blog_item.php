<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;?>
<?php
// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
$canEdit = $this->item->params->get('access-edit');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.framework');
$images  = json_decode($this->item->images);
?>
<?php if ($this->item->state == 0) : ?>
	<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
<?php endif; ?>

<div class="n_color">
	<?php echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>
</div>

<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>

<?php // Todo Not that elegant would be nice to group the params ?>
<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') ); ?>

<?php if ($useDefList) : ?>
	<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
<?php endif; ?>

<?php //echo JLayoutHelper::render('joomla.content.content_intro_image', $this->item); ?>
<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
	<?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
	<div class="pull-<?php echo htmlspecialchars($imgfloat); ?> item-image"> <img
	<?php if ($images->image_intro_caption):
		echo 'class="caption"'.' title="' .htmlspecialchars($images->image_intro_caption) . '"';
	endif; ?>
	src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>"/> </div>
<?php endif; ?>

	<?php  if ( $images->image_intro_caption != '' ) ://<-- VIMEO-YOUTUBE-SLIDER-MAP	?>
	
		<?php //get if is vimeo, youtube or slider ?>
		<?php 
		$vg_caption_cont = explode( ':', $images->image_intro_caption );
		
		switch( $vg_caption_cont[0] ){
			case 'vimeo':
				echo '
					<iframe class="VimeoPlayer" width="100%" height="400" src="http://player.vimeo.com/video/' . $vg_caption_cont[1] . '?portrait=0&amp;color=ffffff"></iframe>
				
				<div class="clearfix"></div>
				<div class="vg-spacer-slideshow"></div>';
			break;
			case 'youtube':
				echo '
					<iframe class="VimeoPlayer" width="100%" height="400" src="http://www.youtube.com/embed/' . $vg_caption_cont[1] . '?hd=1&wmode=opaque&autohide=1&showinfo=0"></iframe>
				
				<div class="clearfix"></div>
				<div class="vg-spacer-slideshow"></div>';
			break;
			
			case 'slide':
				
				echo '<div class="n_carousel_with_captions_wrapper vg-slideshow-article vg-slide-article-wrapper-' . $this->item->id . '">
					<div class="n_carousel_with_captions vg-slide-article-' . $this->item->id . '">';
					
						//images
						$directorio = $vg_caption_cont[1];
						$handle = opendir($directorio);
						while ($file = readdir($handle)) {
							if($file!= "." && $file != ".." && $file!="Thumbs.db"){
								$validar = explode('.',$file);//Que sólo sean imagenes
								if($validar[1] == 'jpg' || $validar[1] == 'gif' || $validar[1] == 'png'){ 
									echo '<div class="n_bgcolor">
										<a href="javascript:void(0)"><img src="' . JURI::base() . $directorio . $file . '" alt="' . htmlspecialchars( $article->title ) . '" /></a>
										<a href="#"></a>
									</div>';
								}
							}
						}
						
						
					echo '</div>
				</div>
				<div class="n_bgcolor">
					<a href="#"><i class="icon-angle-left"></i></a>
					<a href="#"><i class="icon-angle-right"></i></a>
				</div>
				<div class="clearfix"></div>
				<div class="vg-spacer-slideshow"></div>
				<script>
				jQuery(document).ready(function($){
					$(".vg-slide-article-' . $this->item->id . '").carouFredSel({
						responsive: true,
							prev: {
							button : function(){
							return $(".vg-slide-article-wrapper-' . $this->item->id . '").next().children("a:first-child")
						}
					},
					next:{
						button : function(){
							return $(".vg-slide-article-wrapper-' . $this->item->id . '").next().children("a:last-child")
						}
					},
					width: "100%",
					circular: false,
					infinite: true,
					auto: {
						play : true,
						pauseDuration: 0,
						duration: 2000
					},
					scroll: {
						items: 1,
						duration: 400,
						wipe: true
					},
					items: {
						visible: {
							min: 1,
							max: 1  },
						/*width: 243,*/
						height: "auto"
						}
					});
				});
				</script>';
				
			break;
			
			case 'map':
				echo '
					<iframe class="MapPlayer" width="100%" height="400" src="https://maps.google.com.mx/maps?q=' . $vg_caption_cont[1] . '&num=1&gl=mx&t=m&z=10&amp;output=embed"></iframe>
				
				<div class="clearfix"></div>
				<div class="vg-spacer-slideshow"></div>';
			break;
		}
			?>
		
	<?php endif;//VIMEO-YOUTUBE-SLIDER-MAP --> ?>
	
<?php if (!$params->get('show_intro')) : ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $this->item->event->beforeDisplayContent; ?> 

<?php if ($params->get('show_intro')) : ?>
	<?php echo $this->item->introtext; ?>
<?php endif; ?>

<?php if ($useDefList) : ?>
	<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
<?php  endif; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif; ?>

	<p class="readmore-disabled"><a class="n_color" href="<?php echo $link; ?>"> <span class="icon-chevron-right"></span>

	<?php if (!$params->get('access-view')) :
		echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
	elseif ($readmore = $this->item->alternative_readmore) :
		echo $readmore;
		if ($params->get('show_readmore_title', 0) != 0) :
		echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif;
	elseif ($params->get('show_readmore_title', 0) == 0) :
		echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
	else :
		echo JText::_('COM_CONTENT_READ_MORE');
		echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
	endif; ?>

	</a></p>

<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
</div>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent; ?>
