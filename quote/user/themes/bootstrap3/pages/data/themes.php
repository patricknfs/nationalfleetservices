<?php
namespace sts;
use sts as core;

if (!defined(__NAMESPACE__ . '\ROOT')) exit;

if ($auth->get('user_level') == 2) {
	echo json_encode($themes->get());
}
else {
	echo json_encode(array());
}
?>