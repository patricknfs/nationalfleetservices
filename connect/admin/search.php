<?
include('../check.php');
check_login(1);
?>


<?php

/************************************************
	The Search PHP File
************************************************/


/************************************************
	MySQL Connect
************************************************/

// Credentials
$dbhost = "localhost";
$dbname = "db_fleetstreet";
$dbuser = "fs-admin";
$dbpass = "camp=Flam";

//	Connection
global $tutorial_db;

$tutorial_db = new mysqli();
$tutorial_db->connect($dbhost, $dbuser, $dbpass, $dbname);
$tutorial_db->set_charset("utf8");

//	Check Connection
if ($tutorial_db->connect_errno) {
    printf("Connect failed: %s\n", $tutorial_db->connect_error);
    exit();
}

/************************************************
	Search Functionality
************************************************/

// Define Output HTML Formating
$html = '';
$html .= '<li class="result">';
$html .= '<a target="_blank" href="urlString">';
$html .= '<h3>nameString ';
$html .= 'functionString</h3>';
$html .= '<h3>companyString</h3>';
$html .= '</a>';
$html .= '</li>';

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $tutorial_db->real_escape_string($search_string);

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query

	$query = 'SELECT * FROM enquiries WHERE en_ApplicantForenameName LIKE "%'.$search_string.'%" OR en_ApplicantSurname LIKE "%'.$search_string.'%" OR en_ApplicantCompany LIKE "%'.$search_string.'%"';

	// Do Search
	$result = $tutorial_db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

	// Check If We Have Results
	if (isset($result_array)) {
		foreach ($result_array as $result) {

			// Format Output Strings And Hightlight Matches
			$display_forename = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['en_ApplicantForenameName']);
			$display_surname = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['en_ApplicantSurname']);
			$display_company = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['en_ApplicantCompany']);
			$display_url = 'http://www.fleetstreetltd.co.uk/connect/admin/enquiry-'.urlencode($result['en_no']);

			// Insert Name
			$output = str_replace('nameString', $display_forename, $html);

			// Insert Function
			$output = str_replace('functionString', $display_surname, $output);
			
			// Insert Company
			$output = str_replace('companyString', $display_company, $output);

			// Insert URL
			$output = str_replace('urlString', $display_url, $output);

			// Output
			echo($output);
		}
	}else{

		// Format No Results Output
		$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', '<b>No Results Found.</b>', $output);
		$output = str_replace('functionString', 'Sorry :(', $output);
		$output = str_replace('companyString', 'Sorry :(', $output);


		// Output
		echo($output);
	}
}


/*
// Build Function List (Insert All Functions Into DB - From PHP)

// Compile Functions Array
$functions = get_defined_functions();
$functions = $functions['internal'];

// Loop, Format and Insert
foreach ($functions as $function) {
	$function_name = str_replace("_", " ", $function);
	$function_name = ucwords($function_name);

	$query = '';
	$query = 'INSERT INTO search SET id = "", function = "'.$function.'", name = "'.$function_name.'"';

	$tutorial_db->query($query);
}
*/
?>