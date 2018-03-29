<?php
echo '<!-- begin Space Between Contents -->
<div class="block-between-contents">
	<div class="content container twelve columns">
		<div id="section-' . $link[1] . '" class="anchor-menu">';
		
			//title & subtitle
			//if( $menu_params->menu_text == 1 || $result->note != '' ){
			if( $menu_params->menu_text == 1 ){//<-- B1.
					
				//title
				if($menu_params->menu_text == 1 ){//<-- E1.
				
					if( $menu_params->{'menu-anchor_title'} != '' ){
						//menu anchor title
						echo '<p class="page-title"><span>' . $menu_params->{'menu-anchor_title'} . '</span></p>';
					}else{
						//menu item title
						echo '<p class="page-title"><span>' . $result->title . '</span></p>';
					}
				
				}//E1. -->
				
			}//.B1 -->
			
		echo '</div>
	</div>
</div>
<!-- end Space Between Contents -->';

echo '<!-- begin -->
<div class="content-block section vg-color-' . $centinela . '">
	<div class="container"></div>
	<div class="content container">
		<div class="line"></div>
			<div class="page-content">';
					
				//generation a module position based in link. Example: link like '#section-link' converts into 'link' position
				echo '<jdoc:include type="modules" name="' . $link[1] . '" style="blocks" />';
				
				//advice the user that there is no modules for this position
				if( $this->countModules($link[1]) == 0 ){
					echo '<p class="vg-alert-onepage">' . JText::_('VG_BM_MODULE_POSITION_ONEPAGE') . ' <strong>' . $link[1] . '</strong></p>';
				}

			echo '</div>
		</div>
    <div class="clear"></div> 
</div>
<!-- end -->';// .D1 -->
?>