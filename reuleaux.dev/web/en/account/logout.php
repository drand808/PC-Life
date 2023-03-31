<?php 

session_start();

session_unset();

if (session_destroy()) {
	header("Location: https://reuleaux.dev/home");
	exit;
}
?>
