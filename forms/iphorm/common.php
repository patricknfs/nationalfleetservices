<?php

/**
 * iPhorm initialisation
 *
 * You shouldn't need to change this file unless there is a problem
 */

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit;
}

require_once IPHORM_ROOT . '/lib/iPhorm.php';
require_once IPHORM_ROOT . '/lib/Swift/swift_required.php';
require_once IPHORM_ROOT . '/lib/recaptchalib.php';
iPhorm::registerAutoload();
$form = new iPhorm();

function stripslashes_deep($value)
{
    if (is_array($value)) {
        $value = array_map('stripslashes_deep', $value);
    } else {
        $value = stripslashes($value);
    }
    return $value;
}

if (get_magic_quotes_gpc()) {
    $_POST = stripslashes_deep($_POST);
}