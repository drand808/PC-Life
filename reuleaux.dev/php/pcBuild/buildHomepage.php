<?php

$mysqli = mysqli_connect("pclife.reuleaux.dev", "pcl_access", "Puz3LNJtBcfxf3", "pclifetesting");

$result = mysqli_query($mysqli, "SELECT * FROM PCBUILDS");

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
            margin-bottom: 100px;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            color: #e37729;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: #ed9b5f;
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
							<a href="https://reuleaux.dev/home">
                        <img class="headerIcon2"src="https://lh3.googleusercontent.com/X5xZGMJujOWntG7F5PvaJ7b9h3k6EnbQjGsQ1-EjYCk61gl2tFU8WLlLaJNs5crfjud2pDmmx6vFDR_vPecGM39wlWW5We3GMFbYsRYahwBZxuiUoNfBxEE3100OROjKmzut4U7qOg=w600-h315-p-k" />
                      
		</div>
	
		<hr class="hrGray">
		<div id="headerBottom">
                        <a class="headerButton1"href=https://reuleaux.dev/pcBuilds>
				<p class="headerButton2">PC Builder</p>  
			</a>
		<a class="headerButton1"href="https://reuleaux.dev/addComponents">
				<p class="headerButton2">Add Components</p>  
			</a>
		</div>
		
                
        
        
        <div id="bodyTop">
        <body>
            <section>
                <h1>Created Builds</h1>
                <!-- TABLE CONSTRUCTION -->
        <table>
            <tr>
                <th>Build ID</th>
                <th>Cpu</th>
                <th>Gpu</th>
                <th>Memory</th>
                <th width="150px">Edit</th>
                <th width="150px">Delete</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td> <?php echo$rows['build_id']?> </td>
                <td> <?php echo$rows['cpu_id']?> </td>
                <td> <?php echo$rows['gpu_id']?> </td>
                <td> <?php echo$rows['memory_id']?> </td>
                <td>
                <form method="post" action="editBuild.php?id=<?php echo$rows['build_id']?>">
                        <input type="hidden" name="id" value="TESTING <?php echo$rows['gpu_id']?>" />
                        <input type="hidden" name="manufacturer" value="<?php echo $rows['manufactuer']?>" />
                        <input type="hidden" name="name" value="<?php echo $rows['name']?>" />
                        <input type="hidden" name="price" value="<?php echo $rows['price']?>" />
                        <input type="submit" name="submit" value="Edit" style="height:30px; width:100px">
                </form>
                </td>
                <td>
                <form method="post" action="updateDatabase/deleteBuild.php?id=<?php echo$rows['build_id']?>">
                        <input type="hidden" name="id" value="TESTING <?php echo$rows['gpu_id']?>" />
                        <input type="hidden" name="manufacturer" value="<?php echo $rows['manufactuer']?>" />
                        <input type="hidden" name="name" value="<?php echo $rows['name']?>" />
                        <input type="hidden" name="price" value="<?php echo $rows['price']?>" />
                        <input type="submit" name="submit" value="Delete" style="height:30px; width:100px">
                </form>
                </td>
            </tr>
            <?php
                }
            ?>
            <tr>
            <td colspan=6>
            <form method="post" action="updateDatabase/createBuild.php">
                <input type="submit" name="submit" value="Add Build" style="height:30px; width:100px">
            </td>
            </tr>
        </table>
            </section>
        </div>
		</div>
		<div id="bodyBottom">
		</div>
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
		