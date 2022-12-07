<?php

$mysqli = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");

$result = mysqli_query($mysqli, "SELECT * FROM gpu");

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
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: #E4F5D4;
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
		
		.button {
  border: none;
  color: white;
  padding: 8px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 2px 1px;
  cursor: pointer;
}

.button1 {background-color: #4CAF50;} /* Green */
.button2 {background-color: #008CBA;} /* Blue */
    </style>
	
	
	
	
	</head>
	<div id="headerTop">
       <a href=https://reuleaux.dev/home>
						<img class="headerIcon2"src="https://lh3.googleusercontent.com/X5xZGMJujOWntG7F5PvaJ7b9h3k6EnbQjGsQ1-EjYCk61gl2tFU8WLlLaJNs5crfjud2pDmmx6vFDR_vPecGM39wlWW5We3GMFbYsRYahwBZxuiUoNfBxEE3100OROjKmzut4U7qOg=w600-h315-p-k" /> </a>
                
		</div>
		<hr class="hrGray">
		<div id="headerBottom">
			<a class="headerButton1"href=../../php/ViewDatabase/viewCPU.php>
				<p class="headerButton2">Show CPU Database</p>
			</a><a class="headerButton1"href=../../php/ViewDatabase/viewGPU.php>
				<p class="headerButton2">Show GPU Database</p>
			</a><a class="headerButton1"href=../../php/ViewDatabase/viewMemory.php>
				<p class="headerButton2">Show Memory Database</p></a>
			</a><a class="headerButton1"href=../../php/testTable.php>
				<p class="headerButton2">Test Table View</p></a>
		</div>  
		<div id="bodyTop">
		<body>
		<section>
		<h1>GPU Data</h1>
	
        
        
        <table>
            <tr>
                <th>GPU id</th>
                <th>Manufacturer</th>
                <th>Name</th>
                <th>Price</th>
                <th>Select</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td> <?php echo$rows['gpu_id']?> </td>
                <td> <?php echo$rows['manufactuer']?> </td>
                <td> <?php echo$rows['name']?> </td>
                <td> <?php echo$rows['price']?> </td>
                <td>
                <form method="post" action="test.php">
                        <input type="hidden" name="id" value="TESTING <?php echo$rows['gpu_id']?>" />
                        <input type="hidden" name="manufacturer" value="<?php echo $rows['manufactuer']?>" />
                        <input type="hidden" name="name" value="<?php echo $rows['name']?>" />
                        <input type="hidden" name="price" value="<?php echo $rows['price']?>" />
                        <input type="submit" name="submit" value="Add">
                </form>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
        
		</section>
		
		</div>
		<div class="bodyBottom">
		</div>

		<div id="footerOuter">
		<div id="footerOuter">
			<div id="footerInner">
				
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