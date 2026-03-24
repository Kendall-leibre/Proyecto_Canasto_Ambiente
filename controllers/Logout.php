<?php

session_start();

session_unset();
session_destroy();

header("Location:/RestauranteCanasto/views/login/login.php");
exit();

?>