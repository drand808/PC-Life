<?php
$mysqli = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");

$result = mysqli_query($mysqli, "SELECT * FROM PCBUILDS WHERE build_id=1");
$build_data   = mysqli_fetch_assoc($result);

$build_cpu_id=$build_data['cpu_id'];
$build_gpu_id=$build_data['gpu_id'];
$build_memory_id=$build_data['memory_id'];
$build_mother_id=$build_data['motherboard_id'];
$build_storage_id=$build_data['storage_id'];

if($build_cpu_id != 0){
        $cpu_data = mysqli_query($mysqli, "SELECT * FROM cpu WHERE cpu_id=$build_cpu_id");
        $cpu_data   = mysqli_fetch_assoc($cpu_data);
        
        $cpu_name = $cpu_data['cpu_name'];
        $cpu_manufacturer = $cpu_data['cpu_manufacturer'];
        $cpu_price = $cpu_data['cpu_price'];
} else {
        $cpu_name = "";
        $cpu_manufacturer = "";
        $cpu_price = ""; }

if($build_gpu_id != 0){
        $gpu_data = mysqli_query($mysqli, "SELECT * FROM gpu WHERE gpu_id=$build_gpu_id");
        $gpu_data = mysqli_fetch_assoc($gpu_data);
        $gpu_name = $gpu_data['gpu_name']; 
        $gpu_manufacturer = $gpu_data['gpu_manufacturer'];
        $gpu_price = $gpu_data['gpu_price'];
        
} else {
        $gpu_name = "";
        $gpu_manufacturer = "";
        $gpu_price = "";}

if($build_memory_id != 0){
        $memory_data = mysqli_query($mysqli, "SELECT * FROM memory WHERE memory_id=$build_memory_id");
        $memory_data = mysqli_fetch_assoc($memory_data);
        $memory_name = $memory_data['memory_name'];
        $memory_manufacturer = $memory_data['memory_manufactuer'];
        $memory_price = $memory_data['memory_price'];
} else {
        $memory_name = "";
        $memory_manufacturer = "";
        $memory_price = ""; }
        
if($build_mother_id != 0){
        $mother_data = mysqli_query($mysqli, "SELECT * FROM motherboard WHERE motherboard_id=$build_mother_id");
        $mother_data = mysqli_fetch_assoc($mother_data);
        $mother_name = $mother_data['motherboard_name'];
        $mother_manufacturer = $mother_data['motherboard_manufacturer'];
        $mother_price = $mother_data['motherboard_price'];
} else {
        $mother_name = "";
        $mother_manufacturer = "";
        $mother_price = ""; }
        
if($build_storage_id != 0){
        $storage_data = mysqli_query($mysqli, "SELECT * FROM storage WHERE storage_id=$build_storage_id");
        $storage_data = mysqli_fetch_assoc($storage_data);
        $storage_name = $storage_data['storage_name'];
        $storage_manufacturer = $storage_data['storage_manufacturer'];
        $storage_price = $storage_data['storage_price'];
} else {
        $storage_name = "";
        $storage_manufacturer = "";
        $storage_price = ""; }

$table_data = array (
  array("cpu", $cpu_name,$cpu_manufacturer,$cpu_price, $build_cpu_id),
  array("gpu", $gpu_name,$gpu_manufacturer,$gpu_price, $build_gpu_id),
  array("memory", $memory_name,$memory_manufacturer,$memory_price,$build_memory_id),
  array("motherboard", $mother_name,$mother_manufacturer,$mother_price,$build_mother_id),
  array("storage", $storage_name,$storage_manufacturer,$storage_price,$build_storage_id)
  
);

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "../../../php/head.php"; ?>
		<link rel="stylesheet"href="css/builder/advanced.css"/>
	</head>
	<body>
		<?php include "../../../php/header.php"; ?>
		<div id="flex">
			<div id="bodyTop">
				<h1>PC Builder</h1>
				<a class="bodyTopButton bodyTopActive"href="builder/simple">Simple</a>
				<a class="bodyTopButton"href="builder/advanced">Advanced</a>
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
			</div>
			<?php include "../../../php/footer.php"; ?>
			</div>
		</div>
	</body>
</html>