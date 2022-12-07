<?php
$id = $_GET['id'];
$conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");
$sql = "DELETE FROM PCBUILDS WHERE build_id='$id'";
$run = mysqli_query($conn, $sql);
mysqli_close($conn);
header('Location:https://reuleaux.dev/php/pcBuild/buildHomepage.php');
?>
