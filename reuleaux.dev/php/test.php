<!DOCTYPE html>
<html>
 
<head>
    <title>Checking Form Post</title>
	<meta http-equiv="refresh" content="5;url=https://reuleaux.dev/home" />
</head>
 
<body>
    <center>
        <?php
        
        $testing = $_POST['dish'];
        echo "\nTESTING: $testing\n";
 
        $conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");
         
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
         
        $key =  $_POST['id'];
        $m = $_REQUEST['manufacturer'];
        echo "This is the request: $key\n with $m";
         
        // Close connection
        mysqli_close($conn);
        ?>
    </center>
	<center>
	 <h1>Redirecting in 5 seconds...</h1>
	</center>
</body>
 
</html>