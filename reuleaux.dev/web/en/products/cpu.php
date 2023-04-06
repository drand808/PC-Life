<?php
/*error_reporting(~0); ini_set('display_errors', 1);*/
session_start();

$component = strtok(basename("$_SERVER[REQUEST_URI]"), '?');
include "filter.php";
$query = filterResults($component);
$result = mysqli_query($conn, $query);
$conn->close(); 
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
				<h1>CPU Components</h1>
				<a class="bodyTopButton bodyTopActive"href="products/cpu">CPU</a>
				<a class="bodyTopButton"href="products/gpu">GPU</a>
				<a class="bodyTopButton"href="products/memory">RAM</a>
				<a class="bodyTopButton"href="products/motherboard">Motherboard</a>
				<a class="bodyTopButton"href="products/storage">Storage</a>
			</div>
			<div id="bodyBottom">
                        <?php include "filterBox.php"; ?>
			
			<!-- table start -->
			<table id="table-component">
                                <tr>
                                        <th>Name</th>
                                        <th>Manufacturer</th>
                                        <th>Core Count</th>
                                        <th>Core Clock</th>
                                        <th>Price</th>
                                </tr>
                                <?php while($rows=$result->fetch_assoc()) { ?>
                                <tr>
                                        <td><a href="products/temp?c=cpu&id=<?php echo$rows['cpu_id']?>">
                                               <?php echo$rows['cpu_name'];?></a></td>
                                        <td><?php echo$rows['cpu_manufacturer']?></td>
                                        <td><?php echo$rows['cpu_core_count']?></td>
                                        <td><?php echo$rows['cpu_core_clock']?></td>
                                        <td>$<?php echo$rows['cpu_price']?><td>
                                </tr>
                                <?php } ?>
                        </table>
			<!-- table end -->
			</div>
			<?php include "../../../php/footer.php"; ?>
		</div>
	</body>
</html>