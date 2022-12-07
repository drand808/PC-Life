<?php
function OpenCon()
 {
 $dbhost = "figueroa.iad1-mysql-e2-15b.dreamhost.com";
 $dbuser = "pcl_access";
 $dbpass = "Puz3LNJtBcfxf3";
 $db = "pclifetesting";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $connection;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>