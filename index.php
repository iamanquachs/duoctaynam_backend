<?php
ini_set('display_errors', 1);
date_default_timezone_set('asia/ho_chi_minh');
error_reporting(0);
define("BASE_URL", getcwd());
define("INCLUDES", BASE_URL . "/includes/");
define("CONTROLS", BASE_URL . "/controller/");
define("MODULES", BASE_URL . "/modules/");
define("VIEWS", BASE_URL . "/views/");

require_once INCLUDES . "init.php";
require_once CONTROLS . "home.php";
require_once VIEWS . "index.php";
