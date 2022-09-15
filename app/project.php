<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

session_start();
date_default_timezone_set('Europe/London');
define('DIR', $_SERVER['DOCUMENT_ROOT']);

define('SITENAME', 'CodeLighter');

define("EMAIL_NAME", "");
define("EMAIL_HOST", "");
define("EMAIL_USERNAME", "");
define("EMAIL_PASSWORD", "");

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'BelaRuza');

\CodeLighter\Core::init(json_decode(file_get_contents('../public/template.json'), true) ?? []);
