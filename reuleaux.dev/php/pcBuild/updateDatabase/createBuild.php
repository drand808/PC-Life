<?php
$conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");
$run = mysqli_query($conn, 'INSERT INTO PCBUILDS VALUES (NULL,0,0,0)');
mysqli_close($conn);
header('Location:https://reuleaux.dev/php/pcBuild/buildHomepage.php');
?>


