<? session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<title>PHP Login</title>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache"> <!-- Important for security -->
<META HTTP-EQUIV="Expires" CONTENT="-1">

<meta name="robots" content="index,follow">
<meta name="author" content="Christopher Balchin | Jigowatt">
<link rel="stylesheet" href="http://www.nationalfleetservices.net/login.css" /> <!-- Main Stylesheet -->

</head>
<body>

<div id="header">
    
<? 
	// If the user is logged in, display the logout link.
	if(session_is_registered('username')) {
    	echo "<div id='logout'><a href='logout.php'>Logout (".$_SESSION['username'].")</a></div>";
    } else {
    	echo "<div id='login'><a href='login.php'>Login</a></div>";
    }
?>

</div>

<div id="main">