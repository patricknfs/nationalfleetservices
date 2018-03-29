<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$id = (int) $url->get_item();


if (isset($_POST['ticket_id']) && !empty($_POST['ticket_id']) && $id != 0) {

	if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {

		$allowed = true;
		if ($auth->get('user_level') == 5) {
			if (!$tickets_support->can(array('action' => 'view', 'id' => (int) $_POST['ticket_id']))) {
				$allowed = false;
			}
		}

		if ($allowed) {
			$ticket_files->delete(array('columns' => array('file_id' => $id, 'ticket_id' => (int) $_POST['ticket_id'])));
		}

	}
}

?>