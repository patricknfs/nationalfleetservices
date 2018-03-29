<?

error_reporting(E_ALL ^ E_NOTICE);

include('config.php');

// Important Configuration Option
// e.g. dbconn('localhost','your_database','your_login','your_pass');

$db = dbconn("localhost",'sam_fle_5914uk_6620_main','sam_f_nfs','camp=Flam!');

// No need to edit below this line.
	
function dbconn($server,$database,$user,$pass){
	// Connect and select database.
	$db = mysql_connect($server,$user,$pass);
	$db_select = mysql_select_db($database,$db);
	return $db;
}
	
?>
