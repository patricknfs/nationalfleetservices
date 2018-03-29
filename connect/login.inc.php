<html>
<head>
<link rel="stylesheet" type="text/css" href="login_css.css">
<link href="login-box.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="login_wrapper">
<div id="main">

<?

session_start();

$ref = $_SERVER['HTTP_REFERER'];

// User is already logged in, they don't need to se this page.

if(isset($_SESSION['username'])) {

	include('header.php');
	echo '<div class="error_message">Attention! You are already logged in.</div>';
	echo "<h2>What to do now?</h2><br>";
	echo "Go <a href='javascript:history.go(-1)'>back</a> to the page you were viewing before this.</li>";
	include('footer.php');
	
	exit();
}

// Has an error message been passed to login.php?
$error = $_GET['e'];

if($error == 1) {
    $error = '<div class="error_message">Attention! You must be logged in to view this page.</div>';
}

// Only process if the login form has been submitted.

if(isset($_POST['login'])) {

	$username = $_POST['username']; 
	$password = $_POST['password']; 

	// Check that the user is calling the page from the login form and not accessing it directly 
	// and redirect back to the login form if necessary 
	if (!isset($username) || !isset($password)) { 
	header( "Location: index.php" ); 
	exit();
	
	} 
	// Check that the form fields are not empty, and redirect back to the login page if they are 
	elseif (empty($username) || empty($password)) { 
	header( "Location: index.php" );
	exit();
	
	} else { 
	
	//Convert the field values to simple variables 
	
	// Add slashes to the username and md5() the password 
	$user = addslashes($_POST['username']); 
	$pass = md5($_POST['password']); 
	
	
	$sql = "SELECT * FROM login_users WHERE username='$user' AND password='$pass'"; 
	$result = mysql_query($sql);
	
	// Check that at least one row was returned 
	$rowCheck = mysql_num_rows($result); 
	
	if($rowCheck > 0) { 
	while($row = mysql_fetch_array($result)) { 
	
	  // Start the session and register a variable 
	
	  session_start();
	  //session_register('username'); // session_register() has been depreciated in PHP5
	  $_SESSION["username"] = $user;
	
	  //  Successful login code will go here... 
	  
	  header( "Location: ".$ref); 
	  exit();
	
	  } 
	
	  } else { 
	
	  // If nothing is returned by the query, unsuccessful login code goes here... 
	
	  $error = '<div class="error_message">Incorrect username or password.</div>'; 
	  } 
	}
}

if(stristr($_SERVER['PHP_SELF'], 'admin')) {
	include('../loginheader.php');
} else {
	include('loginheader.php');
}

echo $error;

?>











<div>

<div id="title"><img src="img/logo.png" /></div>

<div id="login-box">

<H2>Login</H2>
Fleet Street Connect is a CRM tool built specifically for Fleet Street Associates.
<br />
<br />
<div id="login-box-name" style="margin-top:20px;">Username:</div>
<div id="login-box-field" style="margin-top:20px;">
<form method="POST" action="" autocomplete="off"> 
<input name="username" class="form-login" title="Username" value="" size="30" maxlength="2048" autocomplete="off" />
</div>

<div id="login-box-name">Password:</div>
<div id="login-box-field">
<input name="password" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" autocomplete="off" />
</div>

<br />
<span class="login-box-options"><a href="mailto:sam@fleetstreetltd.co.uk" style="margin-left:4px;">Forgot password?</a></span>
<br />
<br />
<input type="submit" value="Login" name="login">
</form>

</div>

</div>













</div>

<div id="clear"></div></div>

</body></html>

<?
//if(stristr($_SERVER['PHP_SELF'], 'admin')) {
//	include('../loginfooter.php');
//} else {
//	include('loginfooter.php');
//}
?>

