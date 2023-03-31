<?php
require_once "../../../php/config.php";
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
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    #if (empty($email)) {
    #    $error .= '<p class= "formText">Please enter an email</p>';
    #}
    #if (empty($password)) {
    #    $error .= '<p class= "formText">Please enter a password</p>';
   # }
	
    if (empty($error)) {
        if ($query = $conn->prepare("SELECT customer_id, email, password, name FROM customers WHERE email = ?")) {
            $query->bind_param("s", $email);
            $query->execute();
            $result = $query->get_result();
            $row = $result->fetch_assoc();
            if ($row) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION["userid"] = $row['customer_id'];
                    $_SESSION["customer"] = $row;
                    $_SESSION["name"] = $row['name'];

                    header("Location: https://reuleaux.dev/home");
                    exit;
                } else {
                    $error .= '<p class = "formText">Invalid password</p>';
                }
            } else {
                $error .= '<p class= "formText">No user exists with that email</p>';
            }
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
			<div id="bodyTop"> <h1> Login </h1>
			</div>
			<div id="bodyBottom">
                        <div id="error"><?php echo $error; echo $_SESSION['userid']; ?></div>
                        <center>
    <div class="form_div2">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><p></p>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><p></p>
     <button type="submit" name="submit">Submit</button><p></p>
    </form>
</center>
</div>
			</div>
			<?php include "../../../php/footer.php"; ?>
		</div>
	</body>
</html>