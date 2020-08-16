
<?php

require_once("connection.php");
if(isset($_GET['lat'], $_GET['lon']))
	{
		$latitude=(double)$_GET['lat'];
		$longitude=(double)$_GET['lon'];

		echo "latitude -- ".$latitude;
		echo"<br>";	
		echo "longitude -- ".$longitude;
		
		//echo "<option value="">---Choose Dealer---</option>";
			$sql = "SELECT *,(((acos(sin((".$latitude."*pi()/180))*sin((lat*pi()/180))+cos((".$latitude."*pi()/180))*cos((lat*pi()/180))*cos(((".$longitude."-lon)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM login WHERE status=1 HAVING distance <= 6000";
			//$sql="SELECT id, workshop,( 3959*acos(cos(radians('$latitude'))*cos(radians(lat))*cos(radians(lon)-radians('$longitude'))+sin(radians('$latitude'))*sin(radians(lat)))) AS distance FROM login HAVING (distance<7000) ORDER BY distance";
			//$sql="SELECT id, workshop,( 3959/acos(cos(radians(lat))*cos(radians('$latitude'))*cos(radians('$longitude')-radians(lon))+sin(radians(lat))*sin(radians('$latitude')))) AS distance FROM login HAVING (distance<7000) ORDER BY distance";		
			//$sql="SELECT id, workshop FROM login";
			if(!($result1=mysqli_query($con, $sql)))
			{
				die("Failed".mysqli_error());
			}
			while($rows=mysqli_fetch_array($result1))
			{		
				echo "<option value=".$rows['id'].">".$rows['workshop']."</option>";
			 }  
		mysqli_close($con);
	}
	
 ?> 
 
 <?php

if(isset($_GET['dealerinfo']))
	{
		$id=$_GET['dealerinfo'];
		//echo $id;
		?>
		<div class = "panel panel-success" id="container">
					<div class = "panel-heading">
						<h3 class = "panel-title text-primary">Dealer Profile</h3>
					</div>
						<div class = "panel-body">						
						 <table class = "table table-responsive">
						 <?php
						  $sql="SELECT firstname,lastname,phone,workshop,address,district,email FROM login WHERE id='$id'";
								if(!$result=mysqli_query($con, $sql)){die("Details cannot be fetched!".mysqli_error($con));}
								$row=mysqli_fetch_assoc($result); 
						 ?>
							
							<tr>
							   <td>Dealer Name </td><td><?php echo $row['firstname']."  ".$row['lastname']; ?></td>
							</tr>
							<tr>
							   <td>Dealer Contact</td> <td><?php echo $row['phone']; ?></td>
							</tr>
							<tr>
							   <td>Workshop/Station Name</td><td><?php echo $row['workshop']; ?></td>
							</tr>
							<tr>
							   <td>Dealer Address</td><td><?php echo $row['address']; ?></td>
							</tr>
							<tr>
							   <td>District</td><td><?php echo $row['district']; ?></td>
							</tr>
							<tr>
							   <td>Mail Address</td><td><?php echo $row['email']; ?></td>
							</tr>							
						 </table>
						</div>
							<p class="lead">**To make payment offline please save this, while making payments show this to our worker</p>
			</div><!-- ./panel -->

		<?php
		
		mysqli_close($con);
	}
 ?> 
 
 <?php

if(isset($_GET['dealer_rating']))
	{
		$id=$_GET['dealer_rating'];
		//echo $id;
		//Get The average rating
		require_once("connection.php");
		$sql="SELECT AVG(rating) as average FROM dealer_ratings WHERE did='$id'";
		if(!$result=mysqli_query($con, $sql)){die("Cannot Get Dealer ratings This Time--".mysqli_error($con));}
		$row=mysqli_fetch_assoc($result);
		$rating=$row['average'];
		?>
		<span class="lead display-4"><?php echo round($rating,1);?></span><span class="text-info font-italic">Star Rating</span>
		<?php
			for($i= 1; $i <= 5; $i++): 
				$checked = ($i<=$rating) ? 'checked' : '' ;
				echo "<span class='fa fa-star ".$checked."'></span>";
			endfor 
		?>
	<?php
	}	
 ?> 
 
 
 
<?php 
 if(isset($_GET['dealer_review']))
	{
		$id=$_GET['dealer_review'];
		echo $id."***Still in Progress***";
		//Get The average rating
		
		//Get The total number of votes for each star and store in an array
		$sql="SELECT SUM(rating) as rate FROM dealer_ratings WHERE did='$id' GROUP BY rating ORDER BY rating DESC";
		if(!$result=mysqli_query($con, $sql)){die("Cannot Get Dealer ratings This Time--".mysqli_error($con));}
		if($count=mysqli_num_rows($result)=='0'){echo"No Reviews Yet!";}
		$c=$count;
		while($row=mysqli_fetch_array($result))
			{		
				$rat[$c]=$row['rate'];
				echo $rat[$c];
				$c--;
			}
		?>

		<?php
		//Get the Percentage for each of the star values to fill bars(query to fetch total no of voters for each bar)
		$sql="SELECT count(rating) as voters FROM dealer_ratings WHERE did='$id' GROUP BY rating ORDER BY rating DESC";
		if(!$result=mysqli_query($con, $sql)){die("Cannot Get Dealer ratings This Time--".mysqli_error($con));}
		if($count=mysqli_num_rows($result)=='0'){echo"No Reviews Yet!";}
		$d=$count;
		while($row=mysqli_fetch_array($result))
			{		
				$voter[$d]=$row['voters'];
				echo "Voters=".$voter[$d]."-";
				$d--;
			}
			$total_voters=0;
			for($j=sizeof($voter);$j>0;$j--)
			{	$total_voters+=$voter[$j];	}//sum total votes star1+star2+..+star5
			for($i=sizeof($rat);$i>0;$i--)
			{
				$percentage[$i]=$rat[$i]/($total_voters*5)*100;
			}
			echo $percentage[5]."%, ";echo $percentage[4]."%, ";echo $percentage[3]."%, ";
			
		
	}	
 ?> 
 