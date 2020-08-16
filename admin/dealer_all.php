<!DOCTYPE html>

<?php
	include_once("../connection.php");
	$sql="SELECT * FROM login";
	if(!$result=mysqli_query($con, $sql)) {	die( mysqli_error($con));	}	
?>
<?php

?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>SMCS Admin Module</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/rating_style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body >
		<div class="container">
			<table class="table table-responsive table-striped" style="border-radius:15px">
				<th class="bg-warning" style="border-radius:15px">Id</th>
				<th class="bg-warning" style="border-radius:15px">Name</th>
				<th class="bg-warning" style="border-radius:15px">Workshop</th>
				<th class="bg-warning" style="border-radius:15px">Rating</th>
				<th class="bg-warning" style="border-radius:15px">More..</th>
				
				<?php
					while($row=mysqli_fetch_array($result))
					{				
						echo"<tr>";
							echo"<td>".$row['id']."</td>";
							echo"<td>".$row['firstname']." ".$row['lastname']."</td>";
							echo"<td>".$row['workshop']."</td>";
							echo"<td>";
									//Get The average rating
										$qry="SELECT AVG(rating) as average FROM dealer_ratings WHERE did=".$row['id'];
										if(!$res=mysqli_query($con, $qry)){die("Cannot Get Dealer ratings This Time--".mysqli_error($con));}
										$rows=mysqli_fetch_assoc($res);
										$count=mysqli_num_rows($res);
										if($count=='0'){echo"No Reviews Yet!";}
										$rating=$rows['average'];
								
									for($i= 1; $i <= 5; $i++)
									{
										$checked = ($i<=$rating) ? 'checked' : '' ;
										echo "<span class='fa fa-star ".$checked."'></span>";
									}	//endfor 
								
							echo"</td>";
							echo"<td><a href='../dealer_ratings_with_bars.php?did=".$row['id']."' class='btn btn-info'>See More</a></td>";
						echo"</tr>";					
					}
				?>
			</table>
		</div>	
	
	<script src="js/jquery.js"></script>	
	<script>
		 $(document).ready(function(){
		  $(".show").click(function(){
			$("#ShowReview").modal();
		  });
		}); 
	
	</script>
	</body>
	
</html>