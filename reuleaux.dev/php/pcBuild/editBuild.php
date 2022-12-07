<?php
$mysqli = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");

$b_id = $_GET['id'];
$result = mysqli_query($mysqli, "SELECT * FROM PCBUILDS WHERE build_id=$b_id");
$build_data   = mysqli_fetch_assoc($result);

$build_cpu_id=$build_data['cpu_id'];
$build_gpu_id=$build_data['gpu_id'];
$build_memory_id=$build_data['memory_id'];

if($build_cpu_id != 0){
        $cpu_data = mysqli_query($mysqli, "SELECT * FROM cpu WHERE cpu_id=$build_cpu_id");
        $cpu_data   = mysqli_fetch_assoc($cpu_data);
        
        $cpu_name = $cpu_data['name'];
        $cpu_manufacturer = $cpu_data['manufacturer'];
        $cpu_price = $cpu_data['price'];
} else {
        $cpu_name = "";
        $cpu_manufacturer = "";
        $cpu_price = ""; }

if($build_gpu_id != 0){
        $gpu_data = mysqli_query($mysqli, "SELECT * FROM gpu WHERE gpu_id=$build_gpu_id");
        $gpu_data = mysqli_fetch_assoc($gpu_data);
        $gpu_name = $gpu_data['name']; 
        $gpu_manufacturer = $gpu_data['manufactuer'];
        $gpu_price = $gpu_data['price'];
        
} else {
        $gpu_name = "";
        $gpu_manufacturer = "";
        $gpu_price = "";}

if($build_memory_id != 0){
        $memory_data = mysqli_query($mysqli, "SELECT * FROM memory WHERE memory_id=$build_memory_id");
        $memory_data = mysqli_fetch_assoc($memory_data);
        $memory_name = $memory_data['name'];
        $memory_manufacturer = $memory_data['manufactuer'];
        $memory_price = $memory_data['price'];
} else {
        $memory_name = "";
        $memory_manufacturer = "";
        $memory_price = ""; }

$table_data = array (
  array("cpu", $cpu_name,$cpu_manufacturer,$cpu_price, $build_cpu_id),
  array("gpu", $gpu_name,$gpu_manufacturer,$gpu_price, $build_gpu_id),
  array("memory", $memory_name,$memory_manufacturer,$memory_price,$build_memory_id)
);

$mysqli->close();
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport"content="width=device-width,initial-scale=1">
		<link rel="icon"href=../../img/icon.svg>
		<link rel="stylesheet"href=../../css/main.css>
	
        <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            color: #000000;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: #f2da3a;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
			color:#000000;
        }
 
        td {
            font-weight: lighter;
        }
		
		.headerIcon2 {
	position: relative;
	height: 3rem;
	padding: .75rem .25rem .75rem 0;
	vertical-align: middle;
}

#headerTop{
	margin-top:0;
	background-color:#001;
	height:.5rem;
}

    </style>

	
	</head>
	
		<div id="headerTop">
                        <a href=https://reuleaux.dev/home>
                        <img class="headerIcon2"src="https://lh3.googleusercontent.com/X5xZGMJujOWntG7F5PvaJ7b9h3k6EnbQjGsQ1-EjYCk61gl2tFU8WLlLaJNs5crfjud2pDmmx6vFDR_vPecGM39wlWW5We3GMFbYsRYahwBZxuiUoNfBxEE3100OROjKmzut4U7qOg=w600-h315-p-k" /> </a>
                
		</div>
	
		<hr class="hrGray">
		<div id="headerBottom">
                        <a class="headerButton1"href=../../php/pcBuild/buildHomepage.php>
				<p class="headerButton2">Go Back</p>  
			</a>
		</div>
		
                
        
        
        <div id="bodyTop">
        <body>
            <section>
                <h1>Edit This Build</h1>
                <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>Component</th>
                <th>Name</th>
                <th>Manufacturer</th>
                <th>Price</th>
                <th width="150px">Choose</th>
                <th width="150px">Delete</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                foreach($table_data as $rows){
            ?>
            <tr>
                <td> <?php echo$rows[0]?> </td>
                <td> <?php echo$rows[1]?> </td>
                <td> <?php echo$rows[2]?> </td>
                <td> <?php echo$rows[3]?> </td>
                <td>
                <form method="post" action="selectComponents/<?php echo $rows[0]?>.php?buildId=<?php echo$b_id?>&type=<?php echo $rows[0]?>">
                        <input type="hidden" id="comp_id" name="id" value="<?php echo$rows['gpu_id']?>" />
                        <input type="hidden" name="manufacturer" value="<?php echo $rows['manufactuer']?>" />
                        <input type="hidden" name="name" value="<?php echo $rows['name']?>" />
                        <input type="hidden" name="price" value="<?php echo $rows['price']?>" />
                        <input type="submit" name="submit_edit" value="Choose" style="height:30px; width:100px">
                </form>
                </td>
                <td>
                <form method="post" action="updateDatabase/deleteComponent.php?id=<?php echo $rows[4]?>&buildId=<?php echo $b_id?>&type=<?php echo $rows[0]?>">
                        <input type="hidden" id="comp_id" name="id" value="TESTING <?php echo$rows['gpu_id']?>" />
                        <input type="hidden" name="manufacturer" value="<?php echo $rows['manufactuer']?>" />
                        <input type="hidden" name="name" value="<?php echo $rows['name']?>" />
                        <input type="hidden" name="price" value="<?php echo $rows['price']?>" />
                        <input type="submit" name="submit_delete" value="Delete" style="height:30px; width:100px">
                </form>
                </td>
            </tr>
            <?php
                }
            ?>
            
        <script>

        </script>
            
            
            
            
            
        
        </table>
            </section>
        </div>
		</div>
		<div id="bodyBottom">
		</div>
		<div id="footerOuter">
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