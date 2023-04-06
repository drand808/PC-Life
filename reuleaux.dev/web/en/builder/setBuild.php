<?php
/*error_reporting(~0); ini_set('display_errors', 1);*/
session_start();
unset($_SESSION['cpu_id']);
unset($_SESSION['memory_id']);
unset($_SESSION['storage_id']);
unset($_SESSION['motherboard_id']);
unset($_SESSION['gpu_id']);
unset($_SESSION['build_change']);
$_SESSION['build_id']=$_GET["b"];
$build_id=$_SESSION['build_id'];
$conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");
$build_comp_id=mysqli_query($conn, "select * from PCBUILDS where build_id=$build_id");
$query = mysqli_fetch_assoc($build_comp_id);
$_SESSION['build_comp_ids']=[
  "cpu_id" => intval($query["cpu_id"]),
  "gpu_id" => intval($query["gpu_id"]),
  "memory_id" => intval($query["memory_id"]),
  "motherboard_id" => intval($query["motherboard_id"]),
  "storage_id" => intval($query["storage_id"]),
];
header("location: https://reuleaux.dev/builder/advanced");
?>