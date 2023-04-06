<?php
error_reporting(~0); ini_set('display_errors', 1);
require_once "../../../php/config.php";
require_once "password.php";
session_start();

if (isset($_SESSION["userid"]) && $_SESSION["userid"] == true) {
    // Regenerate session ID to prevent session fixation attacks
    #session_regenerate_id(true);

    #header("location: https://reuleaux.dev/home");
    #exit;
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    $sql = "SELECT name FROM customers WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        $error .= "<p>This username already exists</p>";
    }
    $password_array = checkPassword($password, $confirm_password);
    foreach($password_array as $password_msg){
      $error .= "<p>$password_msg</p>";
    }
    #if(!empty($password_msg)){
    #$error .= "<p>$password_msg</p>";
    #}

    if (empty($error)) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        if ($query = $conn->prepare("INSERT INTO customers (name, email, password) VALUES (?, ?, ?)")) {
            $query->bind_param("sss", $name, $email, $hashed_password);
            $query->execute();
            $customer_id = $query->insert_id;
            $_SESSION["userid"] = $customer_id;
            $_SESSION["name"] = $name;
            $_SESSION["customer"] = array(
                "customer_id" => $customer_id,
                "name" => $name,
                "email" => $email,
                "password" => $hashed_password
            );
            header("location: https://reuleaux.dev/home");
            exit;
        } else {
            $error .= '<p>Signup failed</p>';
        }
        $query->close();
    } else {
        echo '<script>document.getElementById("error").innerHTML = "'. $error .'";</script>';
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<style>
.form_div2{
    position: relative;
    vertical-align:middle;
    border: 1.5rem inset;
    min-height: 100%;
    width: 40%;  
    margin: 5rem;
    text-align: center;
    padding-left: 1rem;
    padding-top: 2rem;
    overflow: hidden;
}
</style>
	<head>
		<?php include "../../../php/head.php"; ?>
		<link rel="stylesheet"href="css/builder/advanced.css"/>
	</head>
	<body>
		<?php include "../../../php/header.php"; ?>
		<div id="flex">
			<div id="bodyTop"> <h1> Register an Account </h1>
			</div>
			<div id="bodyBottom">
                        <div id="error"><?php echo $error; ?></div>
                        <center>
    <div class="form_div2">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <label for="name">Name:</label>
    <input type="name" id="name" name="name" required><p></p>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><p></p>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><p></p>

    <label for="confirm_password">Confirm Password:</label required>
    <input type="password" id="confirm_password" name="confirm_password"><p></p>
    <button type="submit" name="submit">Submit</button>
</form>
</center>
</div>
			</div>
			<?php include "../../../php/footer.php"; ?>
		</div>
	</body>
</html>