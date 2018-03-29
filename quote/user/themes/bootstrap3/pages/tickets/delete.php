<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

$id = (int) $url->get_item();

if (isset($_POST['delete'])) {
	if ((int) $id != 0) {

		if ($auth->get('user_level') == 2 || $auth->get('user_level') == 5 || $auth->get('user_level') == 6) {

			$allowed = true;
			if ($auth->get('user_level') == 5) {
				if (!$tickets_support->can(array('action' => 'view', 'id' => $id))) {
					$allowed = false;
				}
			}

			if ($allowed) {
				$tickets->delete(array('id' => $id));
			}

		}
	}
}

?>