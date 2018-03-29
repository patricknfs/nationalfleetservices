<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$id = (int) $url->get_item();

if ($auth->get('user_level') == 2 || $auth->get('user_level') == 6) {
	//all tickets
}
else if ($auth->get('user_level') == 5) {
	$t_array['department_or_assigned_or_user_id']	= $auth->get('id');
}
else if ($auth->get('user_level') == 4) {
	//staff
	$t_array['department_or_assigned_or_user_id']	= $auth->get('id');
}
else if ($auth->get('user_level') == 3) {
	//select assigned tickets or personal tickets
	$t_array['assigned_or_user_id'] 		= $auth->get('id');
}
else {
	//just personal tickets
	$t_array['user_id'] 					= $auth->get('id');
}

$t_array['get_other_data']	= true;
$t_array['id']				= $id;

$tickets_array = $tickets->get($t_array);

if (count($tickets_array) == 1) {
	$ticket = $tickets_array[0];
	
	if (isset($_POST['add'])) {
	
		//change ticket state
		if (isset($_POST['action_id']) && !empty($_POST['action_id'])) {
			if ($auth->get('user_level') == 2 || $auth->get('user_level') == 3 || $auth->get('user_level') == 4 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {
				$open_array['state_id']				= (int) $_POST['action_id'];
			}
			else {
				$open_array['state_id']				= 2;			
			}
			$open_array['id']					= (int) $ticket['id'];
			$open_array['date_state_changed']	= datetime();
			$tickets->edit($open_array);
		}
		else if (($auth->get('id') == $ticket['user_id']) && !$ticket['active']) {
			$open_array['state_id']				= 1;
			$open_array['id']					= (int) $ticket['id'];
			$open_array['date_state_changed']	= datetime();
			
			$tickets->edit($open_array);		
		}
		
		//assign ticket if not assigned
		if (empty($ticket['assigned_user_id']) && ($auth->get('id') != $ticket['user_id'])) {
			$ticket_array['id']					= (int) $ticket['id'];
			$ticket_array['assigned_user_id']	= $auth->get('id');
			
			$tickets->edit($ticket_array);
		}	
		
		$files_upload = array();
		if ($config->get('storage_enabled')) {
			if (isset($_FILES['file']) && is_array($_FILES['file'])) {
				$files_array = rearrange($_FILES['file']);	
				foreach($files_array as $file) {
					if ($file['size'] > 0) {
						$file_array['file']			= $file;
						$file_array['name']			= $file['name'];
						$file_array['user_id']		= $auth->get('id');												
						$file_id 					= $storage->upload($file_array);		
						if ($file_id) {
							$files_upload[] 		= $file_id;
							$storage->add_file_to_ticket(array('file_id' => $file_id, 'ticket_id' => (int) $ticket['id']));
							unset($file_id);
						}
					}
				}
			}
		}

		//add note!
		$note['private']		= $_POST['private'] ? 1 : 0;
		$note['description'] 	= $_POST['description'];
		$note['ticket_id'] 		= (int) $ticket['id'];
		$note['html']			= 0;
		
		if ($config->get('html_enabled')) {
			$note['html'] 		= 1;
		}	
		
		if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {
			if (isset($_POST['cc']) && (!empty($_POST['cc']))) {
				$note['cc']	= $_POST['cc'];
			}
		}
		
		if (!empty($files_upload)) {
			$note['attached_file_ids']	= $files_upload;
		}
			
		$ticket_notes->add($note);
		
		//transfer department or assign user
		if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {
		
			$notifications 	= &singleton::get(__NAMESPACE__ . '\notifications');

			if (!empty($_POST['department_id2']) || !empty($_POST['assigned_user_id2'])) {
				$transfer_array['id']					= (int) $ticket['id'];
				
				if (!empty($_POST['department_id2'])) {
					$transfer_array['department_id'] 		= (int) $_POST['department_id2'];	
				}
				
				if (!empty($_POST['assigned_user_id2'])) {
					$transfer_array['assigned_user_id'] 	= (int) $_POST['assigned_user_id2'];	
				}
				
				$tickets->edit($transfer_array);
				
				if (isset($_POST['department_id2']) && ($_POST['department_id2'] ==! '')) {
					if ($_POST['department_id2'] !== $ticket['department_id']) {
						$notifications->new_department_ticket($ticket);
					}
				}
				
				if ($_POST['assigned_user_id2'] != $ticket['assigned_user_id']) {
					$notifications->ticket_assigned_user($ticket);
				}
			}
		}
	}
	
	header('Location: ' . $config->get('address') . '/tickets/view/' . $ticket['id'] . '/#addnote');
}
else {
	header('Location: ' . $config->get('address') . '/tickets/');
}




?>