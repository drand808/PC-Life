<?php
$b_id=$_GET['buildId'];
$type=$_GET['type'] . '_id';
$comp_id= $_POST['id'];
$mysqli = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting"); 
$run = mysqli_query($mysqli,"UPDATE PCBUILDS SET $type = '$comp_id' WHERE build_id = $b_id");
$mysqli->close();
header('Location:https://reuleaux.dev/php/pcBuild/editBuild.php?id='.$b_id);
?>