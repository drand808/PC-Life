<?php

$mysqli = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- CSS FOR STYLING THE PAGE -->
 <link rel="stylesheet"href=../../css/main.css>
</head>
       <body>
	   <div id="headerTop">
						<a href="https://reuleaux.dev/home">
						<img class="headerIcon2"src="https://lh3.googleusercontent.com/X5xZGMJujOWntG7F5PvaJ7b9h3k6EnbQjGsQ1-EjYCk61gl2tFU8WLlLaJNs5crfjud2pDmmx6vFDR_vPecGM39wlWW5We3GMFbYsRYahwBZxuiUoNfBxEE3100OROjKmzut4U7qOg=w600-h315-p-k"/> </a>
                
		</div>
		<hr class="hrGray">
		<div id="headerBottom">
			<a class="headerButton1"href="../../php/indexCPU.php">
				<p class="headerButton2">Insert CPU Component</p>
			</a><a class="headerButton1"href="../../php/indexGPU.php">
				<p class="headerButton2">Insert GPU Component</p>
			</a><a class="headerButton1"href="../../php/indexMemory.php">
				<p class="headerButton2">Insert Memory Component</p>
			</a><a class="headerButton1"href="../../php/indexStorage.php">
				<p class="headerButton2">Insert Storage Component</p>
			</a><a class="headerButton1"href="../../php/indexMotherboard.php">
				<p class="headerButton2">Insert Motherboard Component</p>
			</a><a class="headerButton1"href ="https://reuleaux.dev/selectComponentsView">
				<p class="headerButton2">View Components</p>	
            </a>
		</div>
		<div id="bodyMiddle">
               
                                <div class="title">
                             <center>   
								<h2>Add Motherboard</h2>
                                </div>
                            </center>
							<center>
							 <div class="form_div">
							<form action="insertMotherboard.php" method="post">
             
							<p>
								<label for="manufacturer">Manufacturer:</label>
								<input type="text" name="manufacturer" id="Manufacturer" required> 
							</p>
							<p>
								<label for="name">Name:</label>
								<input type="text" name="name" id="Name" required>
							</p>
							<p>
								<label for="price">Price:</label>
								<input type="text" name="price" id="Price" maxlength=8 required>
							</p>
							<p>
								<label for="socket">Socket:</label>
								<input type="text" name="socket" id="Socket" required> Ex. 2 x LGA2011-3
							</p>
							<p>
								<label for="memory_max">Memory Max:</label> 
								<input type="text" name="memory_max" id="Memory Max" maxlength=4 required> GB
							</p>
							<p>
								<label for="memory_slots">Memory Slots:</label>
								<input type="text" name="memory_slots" id="Memory Slots" maxlength=2 required>
							</p>
							<p><center>
							<input type="submit" value="Submit"></center>
							</p>
							</center>
							</form>
							</div>
							
                
		</div>
					<!--		<div id="bodyMiddle2">
							<div class="slider">
							<span id="slide-1"></span>
							<span id="slide-2"></span>
							<span id="slide-3"></span>
							<div class="image-container">
								<img src=../../img/AsusMotherboard.jpg class="slide" width="500" height="300">
								<img src=../../img/GigabyteX570Motherboard.jpg class="slide" width="500" height="300">
								<img src=../../img/AsusPrimeMotherboard.jpg class="slide" width="500" height="300" />
							</div>
							<div class="buttons">
							<a href="#slide-1"></a>
							<a href="#slide-2"></a>
							<a href="#slide-3"></a>
							</div>
							</div>
							</div>
                     -->   
                
	

   
		
				<div id="footerOuter">
			<div id="footerInner">
				<div id="footerColumns">
					<div class="footerColumn">
						<img src=../../img/icon.svg id="footerIcon">
						<br>
						<h2 class="footerSlogan">PICK YOUR PARTS,</h2>
						<h2 class="footerSlogan">FIND THE BEST PRICES,</h2>
						<h2 class="footerSlogan">LIVE THE PC LIFE.</h2>
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