<?php
session_start();
unset($_SESSION['build_id']);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include "../../php/head.php";
		?>
		<link rel="stylesheet"href="css/home.css"/>
	</head>
	<body>
		<?php include "../../php/header.php"; ?>
		<div id="flex">
			<div id="bodyBottom">
				<h2>Error 404</h2>
				<p>Are you lost?</p>
			</div>
			<?php include "../../php/footer.php"; ?>
		</div>
	</body>
</html>