<?php
session_start();
require_once "config.php";

if (isset($_SESSION["userid"]) && $_SESSION["userid"] == true) {
    // Regenerate session ID to prevent session fixation attacks
    session_regenerate_id(true);

    header("location: https://reuleaux.dev/home");
    exit;
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email)) {
        $error .= '<p class= "formText">Please enter an email</p>';
    }
    if (empty($password)) {
        $error .= '<p class= "formText">Please enter a password</p>';
    }
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
<head>
		<meta charset="utf-8">
		<link rel="icon"href=../../img/icon.svg>
		<link rel="stylesheet"href=../../css/main.css>
		
	</head>
    <body>
		<div id="headerTop">
						<a href=https://reuleaux.dev/home>
						<img class="headerIcon2"src="https://lh3.googleusercontent.com/X5xZGMJujOWntG7F5PvaJ7b9h3k6EnbQjGsQ1-EjYCk61gl2tFU8WLlLaJNs5crfjud2pDmmx6vFDR_vPecGM39wlWW5We3GMFbYsRYahwBZxuiUoNfBxEE3100OROjKmzut4U7qOg=w600-h315-p-k"> 
						</a>
                        </div>
                        <hr class="hrGray">
            <div id="headerBottom">
			<a class="headerButton1"href=../../php/pcBuild/buildHomepage.php>
				<p class="headerButton2">PC Builder</p>
			</a><a class="headerButton1">
				<img class="headerIcon"src=../../img/icon-recommendations.svg>
				<p class="headerButton2">Recommendations</p>
			</a>><a class="headerButton1"href =https://reuleaux.dev/selectComponentsView>
				<p class="headerButton2">View Components</p>
			</a><a class="headerButton1"href=../../php/createAccount.php>
				<p class="headerButton2">Create Account</p>
			</a><a class="headerButton1"href=../../php/login.php>
				<p class="headerButton2">Login</p>
			</a><a class="headerButton1"href=../../php/logout.php>
				<p class="headerButton2">Logout</p>
			</a><a>
            </div>
			</a>
		</div>
        <div id="bodyMiddle">
<head>
    <title>Login</title>
</head>
<body><center>
    <h1>Login</h1>
</center>
    <div id="error"><?php echo $error; ?></div>
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
</body>
</div>
<div id="footerOuter">
			<div id="footerInner">
				<div id="footerColumns">
					<div class="footerColumn">
						<img src=../../img/icon.svg id="footerIcon">
						<br>
						<h2 class="footerSlogan">PICK YOUR PARTS,</h2>
						<h2 class="footerSlogan">FIND THE BEST PRICES,</h2>
						<h2 class="footerSlogan">LIVE THE PC LIFE.</h2>
						<!-- <img class="footerIcon" img src="https://lh3.googleusercontent.com/X5xZGMJujOWntG7F5PvaJ7b9h3k6EnbQjGsQ1-EjYCk61gl2tFU8WLlLaJNs5crfjud2pDmmx6vFDR_vPecGM39wlWW5We3GMFbYsRYahwBZxuiUoNfBxEE3100OROjKmzut4U7qOg=w600-h315-p-k" /></a> -->
						<br>
					</div><div class="footerColumn">
						<h2>SERVICES</h2>
						<hr class="hrWhite">
						<p><a>PC Builder (Simple)</a></p>
						<p><a>PC Builder (Advanced)</a></p>
						<p><a>Our Recommendations</a></p>
						<p><a>Build Guides</a></p>
						<p><a>All Products</a></p>
						<p><a>Price History</a></p>
					</div><div class="footerColumn">
						<h2>COMMUNITY</h2>
						<hr class="hrWhite">
						<p><a>Community Lists</a></p>
						<p><a>Completed Builds</a></p>
						<p><a>Forums</a></p>
						<p><a>Wallpapers</a></p>
					</div><div class="footerColumn">
						<h2>POLICIES</h2>
						<hr class="hrWhite">
						<p><a href=about-us>About Us</a></p>
						<p><a href=terms-of-service>Terms of Service</a></p>
						<p><a href=code-of-conduct>Code of Conduct</a></p>
						<p><a href=privacy-policy>Privacy Policy</a></p>
						<p><a href=affiliate-disclosure>Affiliate Disclosure</a></p>
						<p><a>Contact</a></p>
				</div>
				<hr class="hrGray">
				<a class = "social-a">
					<img class = "social-img" src = ../../img/twitter.svg />
				</a><a class = "social-a">
					<img class = "social-img" src = ../../img/discord.svg />
				</a><a class = "social-a">
					<img class = "social-img" src = ../../img/instagram.svg />
				</a><a class = "social-a">
					<img class = "social-img" src = ../../img/facebookback.svg />
					<img class = "social-img" src = ../../img/facebookfront.svg />
				</a><a class = "social-a">
					<img class = "social-img" src = ../../img/youtubeback.svg />
					<img class = "social-img" src = ../../img/youtubefront.svg />
				</a>
				<p id="copyright">©2022 PC Life™, all rights reserved.</p>
			</div>
		</div>
		<script src=../../js/main.js></script>
	</body>
</html>	