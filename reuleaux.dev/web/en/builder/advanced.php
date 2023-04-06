<?php
/*error_reporting(~0); ini_set('display_errors', 1);*/
session_start();
include "data.php";

if(isset($_SESSION['userid'])){
  $is_logged_in=true;
  $path="href='builder/createBuild'";
} else {
  $is_logged_in=false;
  $path="";
}

if(isset($_SESSION["build_id"])){
  $build_id = $_SESSION["build_id"];
  
  $cpu_array=getData("cpu",$build_id);
  $gpu_array=getData("gpu",$build_id);
  $memory_array=getData("memory",$build_id);
  $motherboard_array=getData("motherboard",$build_id);
  $storage_array=getData("storage",$build_id); 
} else{
  $cpu_array=getData("cpu",0);
  $gpu_array=getData("gpu",0);
  $memory_array=getData("memory",0);
  $motherboard_array=getData("motherboard",0);
  $storage_array=getData("storage",0);
}

$table_data = array (
  $cpu_array,
  $gpu_array,
  $memory_array,
  $motherboard_array,
  $storage_array
);

if(isset($_SESSION['build_change'])){
  $button_is_enabled=true;
} else {
  $button_is_enabled=false;
}
?>

<!DOCTYPE html>
<html lang="en">
<style>
.button {
  border: 1px solid #eeeeee;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 10px 6px;
  cursor: pointer;
}
.set{
  background-color: #5555AA;
}

.unset{
 background-color: #9D9D9D;
}
</style>
<script>
function testing() {
  if(!<?php echo json_encode($is_logged_in); ?>){
          alert("You must be logged into an account to save a build :D");
  }else {
  }
}
document.getElementById("button-save1").addEventListener("click", testing);
</script>
	<head>
		<?php include "../../../php/head.php"; ?>
		<link rel="stylesheet"href="css/builder/advanced.css"/>
	</head>
	<body>
		<?php include "../../../php/header.php"; ?>
		<div id="flex">
			<div id="bodyTop">
				<h1>PC Builder</h1>
				<a class="bodyTopButton"href="builder/simple">Simple</a>
				<a class="bodyTopButton bodyTopActive"href="builder/advanced">Advanced</a>
			</div>
			<div id="bodyBottom">
			
			<!-- table start -->
			<table>
                                <tr>
                                        <th>Component</th>
                                        <th>Selection(s)</th>
                                        <th>Price</th>
                                </tr>
                                <?php foreach($table_data as $rows){ ?>
                                <tr>
                                        <td><a href="products/<?php echo$rows[0]?>"><?php echo$rows[0]?></a></td>
                                        <td><img></img><?php echo$rows[2]." ".$rows[1]?></td>
                                        <td><?php echo$rows[3]?></td>
                                </tr>
                                <?php } ?>
                        </table>
			<!-- table end -->
                        <center>
                                
                                <a <?php echo $path ?>>
                                <?php if($button_is_enabled){?>
                                <button id="button-save1" class="button set" onclick="testing()">Save!</button>
                                <?php } else { ?>
                                <button id="button-save2" class="button unset" disabled>Save!</button>
                                <?php } ?>
                                </a>
                        </center>
			</div>
			<?php include "../../../php/footer.php"; ?>
		</div>
	</body>
</html>