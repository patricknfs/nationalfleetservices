<?php

$my_email = "carmel.rouse@nationalfleetservices.net";

/*

Enter the continue link to offer the user after the form is sent.  If you do not change this, your visitor will be given a continue link to your homepage.

If you do change it, remove the "/" symbol below and replace with the name of the page to link to, eg: "mypage.htm" or "http://www.elsewhere.com/page.htm"

*/

$continue = "http://www.nationalfleetservices.net";

/*

Step 3:

Save this file (FormToEmail.php) and upload it together with your webpage containing the form to your webspace.  IMPORTANT - The file name is case sensitive!  You must save it exactly as it is named above!  Do not put this script in your cgi-bin directory (folder) it may not work from there.

THAT'S IT, FINISHED!

You do not need to make any changes below this line.

*/

$errors = array();

// Remove $_COOKIE elements from $_REQUEST.

if(count($_COOKIE)){foreach(array_keys($_COOKIE) as $value){unset($_REQUEST[$value]);}}

// Check all fields for an email header.

function recursive_array_check_header($element_value)
{

global $set;

if(!is_array($element_value)){if(preg_match("/(%0A|%0D|\n+|\r+)(content-type:|to:|cc:|bcc:)/i",$element_value)){$set = 1;}}
else
{

foreach($element_value as $value){if($set){break;} recursive_array_check_header($value);}

}

}

recursive_array_check_header($_REQUEST);

if($set){$errors[] = "You cannot send an email header";}

unset($set);

// Validate email field.

if(isset($_REQUEST['email']) && !empty($_REQUEST['email']))
{

if(preg_match("/(%0A|%0D|\n+|\r+|:)/i",$_REQUEST['email'])){$errors[] = "Email address may not contain a new line or a colon";}

$_REQUEST['email'] = trim($_REQUEST['email']);

if(substr_count($_REQUEST['email'],"@") != 1 || stristr($_REQUEST['email']," ")){$errors[] = "Email address is invalid";}else{$exploded_email = explode("@",$_REQUEST['email']);if(empty($exploded_email[0]) || strlen($exploded_email[0]) > 64 || empty($exploded_email[1])){$errors[] = "Email address is invalid";}else{if(substr_count($exploded_email[1],".") == 0){$errors[] = "Email address is invalid";}else{$exploded_domain = explode(".",$exploded_email[1]);if(in_array("",$exploded_domain)){$errors[] = "Email address is invalid";}else{foreach($exploded_domain as $value){if(strlen($value) > 63 || !preg_match('/^[a-z0-9-]+$/i',$value)){$errors[] = "Email address is invalid"; break;}}}}}}

}

// Check referrer is from same site.

if(!(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && stristr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))){$errors[] = "You must enable referrer logging to use the form";}

// Check for a blank form.

function recursive_array_check_blank($element_value)
{

global $set;

if(!is_array($element_value)){if(!empty($element_value)){$set = 1;}}
else
{

foreach($element_value as $value){if($set){break;} recursive_array_check_blank($value);}

}

}

recursive_array_check_blank($_REQUEST);

if(!$set){$errors[] = "You cannot send a blank form";}

unset($set);

// Display any errors and exit if errors exist.

if(count($errors)){foreach($errors as $value){print "$value<br>";} exit;}

if(!defined("PHP_EOL")){define("PHP_EOL", strtoupper(substr(PHP_OS,0,3) == "WIN") ? "\r\n" : "\n");}

// Build message.

function build_message($request_input){if(!isset($message_output)){$message_output ="";}if(!is_array($request_input)){$message_output = $request_input;}else{foreach($request_input as $key => $value){if(!empty($value)){if(!is_numeric($key)){$message_output .= str_replace("_"," ",ucfirst($key)).": ".build_message($value).PHP_EOL.PHP_EOL;}else{$message_output .= build_message($value).", ";}}}}return rtrim($message_output,", ");}

$message = build_message($_REQUEST);

$message = $message . PHP_EOL.PHP_EOL."-- ".PHP_EOL."This email was generated from the National Fleet Services quote request form.";

$message = stripslashes($message);

$subject = "Webform Licence Check Request";

$headers = "From: " . $_REQUEST['email'];



mail($my_email,$subject,$message,$headers);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>
<meta http-equiv="Content-Language" content="en-gb">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Thanks for your enquiry - National Fleet Services Ltd</title>

	<style>
	body { margin:0; padding:0; border:0; color:#1F1F1F; font-family:lucida grande,verdana,helvetica,sans-serif; }
	table { border:0; font-size: 12px; }
	p { margin-top : 0px; margin-bottom : 12px; line-height:1.3; }
	ul { list-style : square; margin-top : 0px; margin-bottom : 8px; }
	ol { margin-top : 0px; margin-bottom : 8px; }
	a:link, a:visited, a:hover, a:active { font-weight:normal; text-decoration:underline; color:#325DB5; }
	a:visited { color:#553885; }
	a:hover { text-decoration:none; }
	.loginBox { border: 1px solid #DEDEDE; }
	.loginHeader { color: #FFFFFF; background: #888888; font-size: 16px; }
	.mid { font-size: 11px; }
	.header { background: #B3B3B3; color: 000; font-weight: bold; }
	</style>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36502282-4']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0">

<!-- Google Code for Lead Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 987167000;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "CQ1HCMD7vgcQmPLb1gM";
var google_conversion_value = 0;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/987167000/?value=0&amp;label=CQ1HCMD7vgcQmPLb1gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


<table width="100%" height="100%" cellspacing="0" cellpadding="0" />
<tr>
    <td align="center">

	<table width="400" / cellspacing="0" cellpadding="10" bgcolor="#FFFFFF">
	<tr>
	    <td class="loginHeader">
		
	  	&nbsp;<strong>Thank You <?php print stripslashes($_REQUEST['name']); ?></strong>
		
		</td>
	</tr>
	</table>
		
	<table width="400" / cellspacing="0" cellpadding="15" bgcolor="#FFFFFF">

	<tr>
	    <td class="loginBox">
		
		<table cellspacing="0" cellpadding="0" />
		<tr>
		    <td valign="top"><img src="../images/tick.gif" alt="Thank You" width="45" height="36" /></td>
		    <td>
		
	    	<p><strong>A member of the National Fleet Services sales team will be in contact shortly.</p>
			<p><br /><a href="http://www.nationalfleetservices.net
			/">Back to website</a></p>

			
			</td>
		</tr>
		</table>
		
		</td>
	</tr>
	</table>

	
	<br /><br /><br /><br /><br />
	
	</td>

</tr>
</table>

</body>
</html>
