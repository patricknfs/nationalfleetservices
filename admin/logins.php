<?
include('header.php');
	
	echo "<span class='add'><a href='user_add.php' title='Add User'>Add User</a></span>";
	echo "<span class='edit'><a href='user_edit.php' title='Edit User'>Edit User</a></span>";
	echo "<span class='manage'><a href='manage_levels.php' title='Manage Levels'>Manage Levels</a></span>";
	
	echo "<div style='height: 5px; clear: both;'></div> <!-- Spacer, to make it pretty -->";

	// Include the list of Recently Registered Users
	recently_reg();
	
	echo "<div style='height: 3px; clear: both;'></div> <!-- Spacer, to make it pretty -->";
	
	// User totals information
	echo usr_total();
	echo usr_active_total();
	echo usr_levels_total();
	

include('../footer.php');

?>