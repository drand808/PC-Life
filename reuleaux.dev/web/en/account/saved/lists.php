<?php
/*error_reporting(~0); ini_set('display_errors', 1);*/
session_start();

if(!isset($_SESSION['userid'])){
  header("location: https://reuleaux.dev/home");
}
include "../../../../php/config.php";
include "price.php";

$user_id=$_SESSION['userid'];
$builds = mysqli_query($conn,"select * from PCBUILDS where user_id=$user_id");
$table_data = array();
foreach($builds as $build){
  $cpu_str = getData("cpu",$build);
  $memory_str = getData("memory",$build);
  $b_id = $build["build_id"];
  $build_price = getPrice($build);
  array_push($table_data,array($b_id,$cpu_str,$memory_str,$build_price));
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "../../../../php/head.php"; ?>
		<link rel="stylesheet"href="css/builder/advanced.css"/>
	</head>
	<body>
		<?php include "../../../../php/header.php"; ?>
		<div id="flex">
			<div id="bodyTop">
				<h1>Your PC Builds</h1>
			</div>
			<div id="bodyBottom">
			
			<!-- table start -->
			<table>
                                <tr>
                                        <th></th>
                                        <th>CPU</th>
                                        <th>Memory</th>
                                        <th>Price</th>
                                </tr>
                                <?php $i=1; foreach($table_data as $rows){ ?>
                                <tr>
                                        <td><a href="builder/setBuild?b=<?php echo$rows[0]?>"><?php echo$i?></a></td>
                                        <td><img></img><?php echo$rows[1]?></td>
                                        <td><?php echo$rows[2]?></td>
                                        <td>$<?php echo$rows[3]?><td>
                                </tr>
                                <?php $i=$i+1;} ?>
                        </table>
			<!-- table end -->
			</div>
			<?php include "../../../../php/footer.php"; ?>
		</div>
	</body>
</html>