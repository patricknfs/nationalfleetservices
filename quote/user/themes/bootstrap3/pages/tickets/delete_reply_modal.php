<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$id 		= (int) $url->get_item();
$ticket_id 	= (int) $_POST['ticket_id'];

if (isset($_POST['delete'])) {
	if ((int) $ticket_id != 0) {

		if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {

			$allowed = true;
			if ($auth->get('user_level') == 5) {
				if (!$tickets_support->can(array('action' => 'view', 'id' => $ticket_id))) {
					$allowed = false;
				}
			}

			if ($allowed) {
				$ticket_notes->delete(array('id' => $id, 'ticket_id' => $ticket_id));
			}

		}
	}
}

?>