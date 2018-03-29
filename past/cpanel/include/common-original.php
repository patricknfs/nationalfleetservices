<?php
define("SITE_NAME", "Fleet Street");
define("SITE_FULL_NAME", "Fleet Street Ltd.");
define("SITE_PUNCH_LINE", "");
define("SITE_MANDATORY_FIELDS", "<font color='#ff0000' face='verdana' size='1'><b>*</b></font>");


define("SITE_URL", "http://www.fleetstreetltd.co.uk/");
//define("SITE_DOC_ROOT", "/nas32ent/domains/f/fleetstreetltd.co.uk/user/htdocs/");
//define("SITE_DOC_ROOT","\/\/nas32ent\/domains\/f\/fleetstreetltd.co.uk\/user\/htdocs\/");
define("SITE_DOC_ROOT","//nas32ent/domains/f/fleetstreetltd.co.uk/user/htdocs/");
define("SITE_INFO_EMAIL", "web@fleetstreetltd.co.uk");

define("SITE_IMAGES", SITE_URL . "images/");
define("SITE_USERS_URL", SITE_URL . "users/");
define("SITE_ADMIN_URL", SITE_URL . "cpanel/");

define("SITE_IMAGES_WS", SITE_DOC_ROOT . "images/");
define("SITE_OFFERS_IMAGES", SITE_URL . "offers/");
define("SITE_OFFERS_IMAGES_WS", SITE_DOC_ROOT . "offers/");
define("SITE_DEALER_LOGOS_WS", SITE_DOC_ROOT . "logos/");
define("SITE_CENTER_ADBANNER_WS", SITE_DOC_ROOT . "banners/");
define("SITE_CENTER_ADBANNER", SITE_URL . "banners/");
define("SITE_DEALER_LOGOS", SITE_URL . "logos/");
define("SITE_IMAGES_CATEGORY_WS", SITE_IMAGES_WS . "category/");

define("EMAIL_ID_REG_EXP_PATTERN", "/^[A-Za-z0-9-_]+(\.[A-Za-z0-9-_]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,3})$/");

define("SITE_INFO_EMAIL_ID", "web@fleetstreetltd.co.uk");
define("SITE_SUPPORT_EMAIL_ID", "web@fleetstreetltd.co.uk");
define("SITE_SUPPORT_TEL", "123 234 4903");

define("SITE_COOKIE_EXPIRATION_DAY", 7);
define("NO_IMAGE_FILE", "nofound.gif");
define("STATUS_ACTIVE", "<font color='#006600'>Active</font>");
define("STATUS_INACTIVE", "<font color='#FF0000'>In-Active</font>");
// hide errors
ini_set('display_errors','0');
?>