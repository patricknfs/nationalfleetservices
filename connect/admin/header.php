<?
include('../../check.php');
check_login(1);
?>

<html>
<head>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache"> <!-- Important for security -->
<META HTTP-EQUIV="Expires" CONTENT="-1">

<meta http-equiv="X-UA-Compatible" content="IE=7"> 
<script type="text/javascript" src="../calendar_db.js"></script>
<link rel="stylesheet" type="text/css" href="../css.css">
</head>

<body onload="javascript:otherSelect()">

<div id="header">

<div id="title"><a href="http://www.fleetstreetltd.co.uk/connect/admin"><img border="0" src="../img/logo.png" /></a></div>

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
<!--<li><a href="http://www.fleetstreetltd.co.uk/connect/admin/dash">Dashboard</a></li>//-->
<li><a href="http://www.fleetstreetltd.co.uk/connect/admin/">Connect</a></li>
<li><a href="http://www.fleetstreetltd.co.uk/connect/admin/live">Live Enquiries</a></li>
<li><a href="http://www.fleetstreetltd.co.uk/connect/admin/archived">Archived Enquiries</a></li>
<li><a href="http://www.fleetstreetltd.co.uk/connect/admin/add">Add Enquiry</a></li>
<li><a href="http://www.fleetstreetltd.co.uk/connect/admin/search.html">Search</a></li>
</ul>

</div>

</div>

<div id="wrapper">
<div id="main">

<div id="clear"></div>