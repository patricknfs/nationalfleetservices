<?

include('header.php');
	
	if(isset($_SESSION['username'])) {
	echo "<div class='success_message'>Welcome back, you are logged in as <b>" . $_SESSION['username'] . "</b></div>";
	}
	
	echo "<h2>Get the most out of this Demo</h2>";
	echo "<p>So you get the most out of this preview of PHP Login, please work your way through this demo, it will give you a great insight into what we do best here at Jigowatt.</p>";
	
	echo "<h2>Login Credentials</h2>";
	echo "<p>For demonstration purposes we have setup 3 users, one to test each of the standard User Levels.</p>";
	
	echo "<div class='credentials'><h3>Log in as User</h3><p><strong>Username:</strong> user<br /> <strong>Password:</strong> user</p></div>";
	echo "<div class='credentials'><h3>Log in as Special</h3><p><strong>Username:</strong> special<br /> <strong>Password:</strong> special</p></div>";
	echo "<div class='credentials' style='border:none'><h3>Log in as Admin</h3><p><strong>Username:</strong> admin<br /> <strong>Password:</strong> admin</p></div>";
	
	echo "<br style='clear:both;' />";
	
	echo "<h2>Access admin panel and protected pages</h2>";
	echo "<p>Use the buttons below to access the various areas of the log in script. To visit the protected pages you will need to be logged in at certain levels.</p>";
	echo "<a href='admin/' class='admin'>Admin</a>";
	echo "<a href='protected.php' class='protected'>Protected (admin only)</a>";
	echo "<a href='protected_2.php' class='protected2'>Protected 2 (special user or admin)</a>";
	echo "<a href='protected_3.php' class='protected3'>Protected 3 (standard user)</a>";
	
	echo "<div style='clear: both;'></div>";
	echo "<h2>Register Yourself</h2>";
	echo "<p>If you register, you will be assigned the user level 'user' meaning you can view the 3rd protected page but no others. When logged in as an admin you can change the user level of each member individually.</p>";
	echo "<a href='sign_up.php' class='register'>Register as a User</a>";


include('footer.php');

?>