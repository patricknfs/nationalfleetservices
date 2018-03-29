<?php
namespace sts;

/**
 * 	Themes Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

class themes {

	private $theme_array = array();
	private $system_folder 	= NULL;
	private $user_folder 	= NULL;
	private $current_theme	= NULL;
	private $theme_location	= NULL;
	private $theme			= NULL;

	function __construct() {
		$this->user_folder 		= USER . '/themes/';
		$this->current_theme	= $this->sanitize_name(CURRENT_THEME);
		$this->theme_location	= $this->user_folder . $this->current_theme . '/' . $this->current_theme . '.theme.php';
	}
	
	function sanitize_name($theme) {
		$theme = strtolower($theme);
		$theme = preg_replace('([^0-9a-z_\/])', '', $theme);
		return $theme;
	}	
	
	function load() {	
		if (file_exists($this->theme_location)) {
			
			$array = explode('.', basename($this->theme_location));					
			
			$class = __NAMESPACE__ . '\\themes\\' . $array[0];
			
			if (!class_exists($class)) {
				include($this->theme_location);
				if (class_exists($class)) {
					$this->theme = new $class;
					if (method_exists($this->theme, 'load')) {
						$this->theme->load();
					}
				}
			}
		}
	}
	
	function get_type() {
		if (isset($this->theme)) {
			if (method_exists($this->theme, 'meta_data')) {
				$array = $this->theme->meta_data();
				if (isset($array['type'])) {
					return $array['type'];
				}
			}
		}
		return 'standard';
	}
	
	function get() {
		
		$theme_info 		= array();
		$theme_info_temp 	= array();
		$theme_folders 		= array();

		if (is_dir($this->user_folder)) {
			$folder = opendir($this->user_folder);
			while (false !== ($dir_array = readdir($folder))) {
				if ($dir_array != '.' && $dir_array != '..') {
					if(is_dir($this->user_folder . $dir_array)) {
						if ($this->sanitize_name($dir_array) == $dir_array) {
							$theme_folders[] = $dir_array . '/';
						}
					}
				}
			}
			closedir($folder);
		}
		
		foreach($theme_folders as $theme_folder) {			
			$theme_folder_full = $this->user_folder . $theme_folder;
			if (is_dir($theme_folder_full)) {
				$folder = opendir($theme_folder_full);
				while (false !== ($file_array = readdir($folder))) {
					if ($file_array != '.' && $file_array != '..') {
						if(filetype($theme_folder_full . $file_array) == 'file') {
							if(preg_match("/^([a-z0-9_\/]+).theme.php$/", $file_array, $matches) > 0){

								$theme_info[$matches[1]] =
									array (
										'file_name' 				=> $matches[1],
										'name' 						=> $matches[1],
										'description' 				=> '',
										'update_check_url' 			=> '',
										'author' 					=> '',
										'author_website' 			=> '',
										'website' 					=> '',
										'version' 					=> '',
										'min_supported_version' 	=> '',
										'max_supported_version' 	=> '',
										'type'						=> 'standard',
										'sub_themes'				=> array()
									);
								
								$class = __NAMESPACE__ . '\\themes\\' . $matches[1];

								if (!class_exists($class)) {
									include($theme_folder_full . $matches[1] . '.theme.php');
								}
								
								if (class_exists($class)) {	
									$theme_info_temp[$matches[1]] = new $class;
									if (method_exists($theme_info_temp[$matches[1]], 'meta_data')) {
										$theme_info[$matches[1]] = array_merge($theme_info[$matches[1]], $theme_info_temp[$matches[1]]->meta_data());
										$theme_info[$matches[1]]['file_name'] = $matches[1];
									}
								}	
							}
						}
					}
				}
				closedir($folder);
			}
		}
		
		ksort($theme_info);
		
		return $theme_info;
	}

}

?>