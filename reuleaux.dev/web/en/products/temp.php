<?php
#error_reporting(~0); ini_set('display_errors', 1);
session_start();
$comp_type=$_GET["c"];
$_SESSION[$comp_type."_id"]=intval($_GET["id"]);
$_SESSION["build_change"]=true;
$build = $_SESSION['build_comp_ids'];
$_SESSION['build_comp_ids'][$comp_type."_id"]=intval($_GET['id']);
header("location: https://reuleaux.dev/builder/advanced");
?>