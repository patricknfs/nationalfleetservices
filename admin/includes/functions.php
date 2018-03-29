<?

function user_levels() {
	
	// Standard limit for User Levels is 15, feel free to change this limit below.
	$sql = "SELECT * FROM login_levels LIMIT 0, 15"; 
	$result = mysql_query($sql);
	
	// Check that at least one row was returned 
	$rowCheck = mysql_num_rows($result); 
	
	if($rowCheck > 0) { 
	
	// Show recently registered users
	
	echo "<ul class='column_result'>";
	
		echo '<li><span class="result_column" style="width: 15%;">User Level</span><span class="result_column" style="width: 20%;">Authority Level</span><span class="result_column" style="width: 20%;">Active Users</span><span class="result_column" style="width: 15%;">Status</span></li>';
	
		while($row = mysql_fetch_array($result)) { 
		
			$level = $row['level_level'];
			
			// Find the current amount of active users in the group.
		
			$sql2 = "SELECT user_level FROM login_users WHERE user_level = '$level'";
			$result2 = mysql_query($sql2); 
			$count = mysql_num_rows($result2);
			
			// If buts and maybes for the list
		
			if($row['level_level'] == 1) { $admin = " <span style='color: #08c;'>*</span>"; }
			if($row['level_disabled'] == 0) { $status = "Active"; } else { $status = "<span style='color: #8a1f11;'>Disabled</span>"; }
		
			echo '<li><a href="level_edit.php?lid='.$row['id'].'"><span class="result_column" style="width: 15%;">'.$row['level_name']. $admin .'</span><span class="result_column" style="width: 20%;">'.$row['level_level'].'</span><span class="result_column" style="width: 20%;">'.$count.'</span><span class="result_column" style="width: 15%;">'.$status.'</span></a></li>';
			
			// Clear the variables
			
			$level = "";
			$admin = "";
			$status = "";
			
		}
	
	echo "</ul>";	
	
	}

}

function recently_reg() {

	echo "<h2>5 Recently Registered</h2>";
	
	$sql = "SELECT * FROM login_users ORDER BY timestamp DESC LIMIT 0, 5"; 
	$result = mysql_query($sql);
	
	// Check that at least one row was returned 
	$rowCheck = mysql_num_rows($result); 
	
	if($rowCheck > 0) { 
	
	// Show recently registered users
	
	echo "<ul class='column_result'>";
	
		echo '<li><span class="result_column" style="width: 15%;">Username</span><span class="result_column" style="width: 25%;">Real Name</span><span class="result_column" style="width: 35%;">E-Mail Address</span><span class="result_column">Registered Date</span></li>';
	
		while($row = mysql_fetch_array($result)) { 
		
			if($row['user_level'] == 1) { $admin = " <span style='color: #08c;'>*</span>"; }
			if($row['restricted'] == 1) { $restrict = " <span style='color: #8a1f11;'>*</span>"; }

			$timestamp = strtotime($row['timestamp']);
			$reg_date = date('d M y @ H:i' ,$timestamp);
		
			echo '<li><a href="user_edit.php?uid='.$row['user_id'].'"><span class="result_column" style="width: 15%;">'. $row['username'] . $admin . $restrict .'</span><span class="result_column" style="width: 25%;">'.$row['fname'].' '.$row['lname'].'</span><span class="result_column" style="width: 35%;">'.$row['email'].'</span><span class="result_column">'.$reg_date.'</span></a></li>';
			
			// Clear the variable
			
			$admin = "";
			$restrict = "";
		
		}
	
	echo "</ul>";	
	
	} else { echo "Sorry, there are no recently registered users."; }
	
}

function usr_total() {
	
	$sql = "SELECT COUNT(*) FROM login_users"; 
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	return '<span class="totals"><i><b>'.$row['COUNT(*)'].'</b> Members</i></span>';
	
}

function usr_active_total() {
	
	$sql = "SELECT COUNT(*) FROM login_users WHERE restricted = '0'"; 
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	return '<span class="totals"><i><b>'.$row['COUNT(*)'].'</b> Active Members</i></span>';
	
}

function usr_levels_total() {
	
	$sql = "SELECT level_name, level_level FROM login_levels"; 
	$result = mysql_query($sql);
	
	while($row = mysql_fetch_array($result)) {
	echo '<div class="totals"><i><b>'.level_total($row['level_level']).'</b> '.$row['level_name'].' Users</i></div>';
	}
	
}

function level_total($id) {

	$sql = "SELECT COUNT(*) FROM login_users WHERE user_level = '$id'"; 
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	return $row['COUNT(*)'];

}

?>