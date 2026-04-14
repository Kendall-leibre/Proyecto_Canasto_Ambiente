<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

define("BASE_URL", "http://localhost/RestauranteCanasto/");

require_once "config/database.php";
require_once "config/routes.php";