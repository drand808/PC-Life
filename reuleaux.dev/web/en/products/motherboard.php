<?php
/*error_reporting(~0); ini_set('display_errors', 1);*/
session_start();

include "filter.php";
$query = filterResults("motherboard");
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
				<h1>Motherboard Components</h1>
			</div>
			<div id="bodyBottom">
			
			<!-- table start -->
			<table>
                                <tr>
                                        <th>Name</th>
                                        <th>Manufacturer</th>
                                        <th>Memory Slots</th>
                                        <th>Price</th>
                                </tr>
                                <?php while($rows=$result->fetch_assoc()) { ?>
                                <tr>
                                        <td><a href="products/temp?c=motherboard&id=<?php echo$rows['motherboard_id']?>">
                                               <?php echo$rows['motherboard_name'];?></a></td>
                                        <td><?php echo$rows['motherboard_manufacturer']?></td>
                                        <td><?php echo$rows['motherboard_slots']?></td>
                                        <td>$<?php echo$rows['motherboard_price']?><td>
                                </tr>
                                <?php } ?>
                        </table>
			<!-- table end -->
			</div>
			<?php include "../../../php/footer.php"; ?>
		</div>
	</body>
</html>