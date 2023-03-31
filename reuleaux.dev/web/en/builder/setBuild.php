<?php
/*error_reporting(~0); ini_set('display_errors', 1);*/
session_start();
$_SESSION['build_id']=$_GET["b"];
header("location: https://reuleaux.dev/builder/advanced");
?>