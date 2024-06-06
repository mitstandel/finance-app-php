<?php
@session_start();
@set_time_limit(0);
@date_default_timezone_set('Asia/Kolkata');
@ini_set('upload_max_filesize', '30M');
@ini_set('post_max_size', '30M');

if (isset($_SERVER['HTTPS'])) {
  $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
} else {
  $protocol = 'http';
}

$virtualHost = 'finance/';

define('VHOST', $virtualHost);
define('SITE_PATH', __DIR__ . "/");

set_include_path(implode(PATH_SEPARATOR, array(
  realpath(SITE_PATH . 'lib'),
  get_include_path(),
)));

require_once SITE_PATH . 'conn/conn.php';
require_once 'functions.php';

ini_set('error_reporting', E_ALL);
error_reporting(E_ALL);
ini_set('log_errors', TRUE);
ini_set('html_errors', FALSE);
ini_set('error_log', SITE_PATH . 'logs/error.log');
ini_set('display_errors', TRUE);

define('SITE_URL',  $protocol . '://' . $_SERVER['HTTP_HOST'] . '/' . VHOST);
define('PASSWORD_HASH', '3658sd4fg65s4df65sd6f54');
