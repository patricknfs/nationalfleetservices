<?php

//just centinela
$centinela = 2;
	
//get every custom link from mainmenu (in db, table #_menu)
foreach( $results as $result ) ://<--C1.
						
		//check if the link has '#', if not just ignoring
		if( strstr($result->link,'#section-') ){
							
			//split # from complete link. Example: '#link' turns into: 'link'.
			$link = explode( '#section-', $result->link );
			
			//menu item params (Link Title Attribute, Link CSS Style, Link Image, Add Menu Title)
			$menu_params = json_decode($result->params);
			
			//load module variations based on Link CSS Style field
			switch( $menu_params->{'menu-anchor_css'} ){
				//default
				default:
				case 'vg-style-1':
					$vg_style_ = 'style1.php';
				break;
			}
			
			switch( $vg_alert_one_page ){//<-- A4.
			
				//if not exist a module in this position, don't display
				default:
				case 0:
					if( $this->countModules($link[1]) ){
						include('onepage_modules_styles' . DS . $vg_style_ );//module style based on menu-anchor_css field on menu item
					}
				break;
				//show the module or alert
				case 1:
					include('onepage_modules_styles' . DS . $vg_style_ );//module style based on menu-anchor_css field on menu item
				break;
				
			}// .A4 -->
			
			//just switching centinela
			if( $centinela == 1 ){ $centinela = 2; }else{ $centinela = 1; }
		
		}
		
		
		
endforeach;//.C1-->

?>