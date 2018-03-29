<?php
//echo '<div class="element  clearfix col2-3 all section-' . $link[1] . '">';//<-- A1.

	//generation a module position based in link. Example: link like '#section-link' converts into 'link' position
	echo '<jdoc:include type="modules" name="' . $link[1] . '" style="blocks" />';
				
	//advice the user that there is no modules for this position
	if( $this->countModules($link[1]) == 0 ){
		echo '<div class="element  clearfix col2-3 all section-' . $link[1] . '">
			<p class="vg-alert-onepage">' . JText::_('VG_MODULE_POSITION_ONEPAGE') . ' <strong>' . $link[1] . '</strong></p>
		</div>';
	}
	  
//echo '</div>';//.A1 -->
?>