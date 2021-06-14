<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Poppins',sans-serif;
		}
		body{
			height: 100vh;
			display: flex;
			justify-content: center;
			align-items: center;
			padding: 10px;
		}
		.container{
			background-color: lightblue;
			border:solid 1px;
			position: relative;
			border-radius: 5px;
			padding: 20px 20px 20px 20px;
			margin: auto;
			max-width: 800px;
		}
		.image{
			text-align: center;
		}
		.name{
			text-align: center;
			font-size:30px;
		}
		p{
			text-indent: 50px;
			font-size: 20px;
			border-bottom: solid 2px;
		    text-align:center;
		}
		h2{
			font-size: 20px;
		}
		.container .personal-details{
			background-color: white;
			display:flex;
			flex-wrap: wrap;
			justify-content:space-between;
			max-width: 100%;
			border-top:solid 1px;
			margin:10px 10px 10px 10px;
			padding: 10px 10px 19px 10px;
			font-size: 20px;
		}
		.personal-details .details{
			margin:  20px 0px 20px 0px;
			width:100%;
		}
	</style>
	<title>Profile</title>
</head>
<body>
	<?php
		error_reporting(0);
		$name=$_GET["firstname"];
		$con = mysqli_connect ("localhost","root","","pixel6");
		$q="select * from profileinfo where email=".$_GET["email"]."";
		$rs  = mysqli_query($con,$q);
		$row = mysqli_fetch_assoc($rs);	
		$gender=$row["gender"];
		if($gender=="male")
		{
			$g="Mr.";
			$p="her";
			$s="he";
		}
		else
		{
			$p="his";
			$g="Miss.";
			$s="she";
		}
	?>
	<div class="container">	
		<div class="image">
			<?echo"<img src='userprofile/".$row["photo"]."' height=300 width=300 border=3px />";?>
		</div>
		<div class="name">
			<? echo strtoupper($row["firstname"])." ".strtoupper($row["lastname"])?>
		</div>
			<p><?php echo $g." ".$row["firstname"] ?> did <? echo $p." ".$row["graduation"]?> in <? echo $row["special"]?> from <? echo $row["college"]?> in the year <? echo $row["year"]?>. <? echo $s?> is highly skill in <? echo $row["primary"]." .".$s ?> lives in <? echo $row["city"]?> and can be contacted via <? echo $row["email"]?>.</p>
		<h2>Personal</h2>
		<div class="personal-details">
			<div class="details">
				<b>First Name :</b>
				<?echo $row["firstname"]?>
			</div>
			<div class="details">
				<b>Last Name: </b>
				<?echo $row["lastname"]?>
			</div>
			<div class="details">
				<b>Email: </b>
				<?echo $row["email"]?>
			</div>
			<div class="details">
				<b>Phone :</b>
				<? echo $row["phone"]?>
			</div>
			<div class="details">
				<b>Gender :</b>
				<?echo $row["gender"]?>
			</div>
			<div class="details">	
				<b>Lives In :</b>
				<? echo $row["city"]?>
			</div>
		</div>
		<h2>Education</h2>
		<div class="personal-details">
			<div class="details">
				<b>Graduation:</b> 
				<?echo $row["graduation"]?>
			</div>
			<div class="details">
				<b>Pass out:</b>
				<?echo $row["year"]?>
			</div>
			<div class="details">
				<b>College/University :</b>
				<?echo $row["college"]?>
			</div>
		</div>
		<h2>Skills</h2>
		<div class="personal-details">
			<div class="details">
				<b>Primary Skills :</b><?echo $row["primary"]?>
			</div>
			<div class="details">
				<b>Secondary Skills :</b><?echo $row["secondary"]?>
			</div>
			<div class="details">
				<b>Certificates :</b><?echo $row["certificate"]?>
			</div>
		</div>
		<h2><?echo strtoupper($row["firstname"])."'"."s"?>  Pitch</h2>
		<div class="personal-details">
			<b>"<? echo $row["pit"]?>"</b>
		</div>
	</div>
</body>
</html>