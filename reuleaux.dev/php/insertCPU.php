<!DOCTYPE html>
<html>
 
<head>
    <title>Insert CPU</title>
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
         
        $sql = "INSERT INTO cpu  VALUES ('$cpu_id','$manufacturer',
            '$name','$price')";
         
        if(mysqli_query($conn, $sql)){
            echo "<h3>Success! Date has been stored properly.</h3>";
 
            echo nl2br("\n$manufacturer\n $name\n "
                . "$price\n");
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