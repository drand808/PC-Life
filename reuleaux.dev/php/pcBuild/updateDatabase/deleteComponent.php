<?php   
$id = $_GET['id'];  
$b_id=$_GET['buildId'];
$type=$_GET['type'] . '_id';
$mysqli = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting"); 
$run = mysqli_query($mysqli,"UPDATE PCBUILDS SET $type = '' WHERE build_id = $b_id");
$mysqli->close();
header('Location:https://reuleaux.dev/php/pcBuild/editBuild.php?id='.$b_id);
?>  

