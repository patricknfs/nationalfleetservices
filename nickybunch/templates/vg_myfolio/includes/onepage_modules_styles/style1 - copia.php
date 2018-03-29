<?php
echo '<div class="element  clearfix col1-1 all section-' . $link[1] . '">';//<-- A1.

	echo '<!--div class="col1-1 white-right">
        <h2>Taking pictures</h2>
        <p>Is my passion sapien massa, a imperdiet diam. Aliquam erat volutpat. Sed consectetur suscipit nunc et rutrum. </p>
        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer commodo tristique odio, quis fringilla ligula aliquet utpisci. </p>
        <p class="small bottom"><a href="#filter=.blog">Visit my blog <span class="arrow">?</span></a></p>
      </div>
     <div class="clear"></div-->';
	  
	//generation a module position based in link. Example: link like '#section-link' converts into 'link' position
	echo '<jdoc:include type="modules" name="' . $link[1] . '" style="blocks" />';
				
	//advice the user that there is no modules for this position
	if( $this->countModules($link[1]) == 0 ){
		echo '<div class="col1-1">
			<p class="vg-alert-onepage">' . JText::_('VG_MODULE_POSITION_ONEPAGE') . ' <strong>' . $link[1] . '</strong></p>
		</div>';
	}
	  
echo '</div>';//.A1 -->
?>