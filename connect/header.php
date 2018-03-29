<?
include('../check.php');
check_login(3);
?>

<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache"> <!-- Important for security -->
<META HTTP-EQUIV="Expires" CONTENT="-1">

<meta http-equiv="X-UA-Compatible" content="IE=7"> 
<script type="text/javascript" src="calendar_db.js"></script>
<link rel="stylesheet" type="text/css" href="css.css">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

</head>
<body>
</head>

<body onload="javascript:otherSelect()">

<div id="header">

<div id="title"><a href="http://www.fleetstreetltd.co.uk/connect"><img border="0" src="img/logo.png" /></a></div>

<? 
	// If the user is logged in, display the logout link.
	if(session_is_registered('username')) {
    	echo "<div id='logout'><a href='http://www.fleetstreetltd.co.uk/connect/logout'>Logout (".$_SESSION['username'].")</a></div>";
    } else {
    	echo "<div id='login'><a href='login.php'>Login</a></div>";
    };

?>

<div id="headerright">

<ul id="menu">
<li><a href="http://www.fleetstreetltd.co.uk/connect">Connect</a></li>
<li><a href="http://www.fleetstreetltd.co.uk/connect/live">Live Enquiries</a></li>
<li><a href="http://www.fleetstreetltd.co.uk/connect/archived">Archived Enquiries</a></li>
<li><a href="http://www.fleetstreetltd.co.uk/connect/add">Add Enquiry</a></li>
</ul>

</div>

</div>

<div id="wrapper">
<div id="main">

<div id="clear"></div>