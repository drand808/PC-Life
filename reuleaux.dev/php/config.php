<?php
 
 define('DBSERVER', 'pclife.reuleaux.dev');
 define('DBUSERNAME', 'pcl_access');
 define('DBPASSWORD', 'Puz3LNJtBcfxf3');
 define('DBNAME', 'pclifetesting');
 
        $conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");
         
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
?>