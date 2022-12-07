<?php
$connection = mysqli_connect("hostname", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting"); // Establishing Connection with Server
$db = mysql_select_db("cpu", $connection); // Selecting Database from Server
if(isset($_POST['submit'])){ // Fetching variables of the form which travels in URL
$manufacturer = $_POST['manufacturer'];
$name = $_POST['name'];
$price = $_POST['price'];
if($manufacturer !=''||$name !=''){
//Insert Query of SQL
$query = mysql_query("insert into pclifetesting.cpu(manufacturer, name, price) values ('$manufacturer', '$name', '$price')");
echo "<br/><br/><span>Data Inserted successfully...!!</span>";
}
else{
echo "<p>Insertion Failed <br/> Please Try Again <br/> Some Fields May Be Blank ....!!</p>";
}
}
mysql_close($connection); // Closing Connection with Server
?>