<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Motherboard</title>
	<meta http-equiv="refresh" content="1;url=https://reuleaux.dev/home" />
</head>
 
<body>
    <center>
        <?php
 
        $conn = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");
         
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
         
 
        $manufacturer =  $_REQUEST['manufacturer'];
        $name = $_REQUEST['name'];
        $price =  $_REQUEST['price'];
		$socket = $_REQUEST['socket'];
		$memory_max = $_REQUEST['memory_max'];
        $memory_slots = $_REQUEST['memory_slots']; 
		 
        $sql = "INSERT INTO motherboard VALUES ('$memory_id','$manufacturer',
            '$name','$price','$socket','$memory_max','$memory_slots')";
         
        if(mysqli_query($conn, $sql)){
            echo "<h3>Success! Data has been stored properly.</h3>";
 
            echo nl2br("\n$manufacturer\n $name\n "
               .  "$price\n $socket\n $memory_max\n $memory_slots\n ");
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
         
        // Close connection
        mysqli_close($conn);
        ?>
    </center>
	<center>
	 <h1>Redirecting...</h1>
	</center>
</body>
 
</html>