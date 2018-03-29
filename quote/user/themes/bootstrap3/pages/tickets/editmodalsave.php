<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;


$id = (int) $url->get_item();

if ($id == 0) {
	echo 'Error';
	exit;
}

if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {

}
else {
	echo 'Error';
	exit;
}

//admin and global mods
if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {
	//all tickets
}
//moderator
else if ($auth->get('user_level') == 5) {
	$t_array['department_or_assigned_or_user_id']	= $auth->get('id');
}
else if ($auth->get('user_level') == 4) {
	//staff
	$t_array['department_or_assigned_or_user_id']	= $auth->get('id');
}
//users and user plus
else if ($auth->get('user_level') == 3) {
	//select assigned tickets or personal tickets
	$t_array['assigned_or_user_id'] 		= $auth->get('id');
}
//sub
else {
	//just personal tickets
	$t_array['user_id'] 					= $auth->get('id');
}

$t_array['id']				= $id;
$t_array['get_other_data'] 	= true;
$t_array['limit']			= 1;

$tickets_array = $tickets->get($t_array);

if (count($tickets_array) == 1) {
	$ticket = $tickets_array[0];
}
else {
	echo 'Error';
	exit;
}

if (isset($_POST['save'])) {
		
	$ticket_edit['department_id'] 		= (int) $_POST['department_id'];	
	$ticket_edit['assigned_user_id'] 	= (int) $_POST['assigned_user_id'];	
	$ticket_edit['state_id'] 			= (int) $_POST['state_id'];	
	$ticket_edit['priority_id'] 		= (int) $_POST['priority_id'];	

	$ticket_edit['id'] 					= $ticket['id'];	
	
	$tickets->edit($ticket_edit);
	
	$notifications 	= &singleton::get(__NAMESPACE__ . '\notifications');
	
	if ($_POST['department_id'] != $ticket['department_id']) {
		$notifications->new_department_ticket($ticket);
	}
	
	if ($_POST['assigned_user_id'] != $ticket['assigned_user_id']) {
		$notifications->ticket_assigned_user($ticket);
	}
}