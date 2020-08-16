
<?php
$rat=[0,0,0,0,0,0];
$voter=[0,0,0,0,0,0];
//Get The average rating
require_once("connection.php");
$sql="SELECT AVG(rating) as average FROM dealer_ratings WHERE did='109'";
if(!$result=mysqli_query($con, $sql)){die("Cannot Get Dealer ratings This Time--".mysqli_error($con));}
$row=mysqli_fetch_assoc($result);
$count=mysqli_num_rows($result);
if($count=='0'){echo"No Reviews Yet!";}
$rating=$row['average'];
?>

<?php
//Get The total number of votes for each star and store in an array
$sql="SELECT rating as value, SUM(rating) as stars  FROM dealer_ratings WHERE did='109' GROUP BY rating ORDER BY rating";
if(!$result=mysqli_query($con, $sql)){die("Cannot Get Dealer ratings This Time--".mysqli_error($con));}
$count=mysqli_num_rows($result);
if($count=='0'){echo"No Reviews Yet!";}
		echo$count."=count";
//$c=1;
while($row=mysqli_fetch_array($result))
	{
		$qty=$row['value'];
		$rat[$qty]=$row['stars'];
		echo $qty."* = ".$rat[$qty];
		//$c++;
	}
?>

<?php
//Get the Percentage for each of the star values to fill bars(query to fetch total no of voters for each bar)
$sql="SELECT rating as value, count(rating) as voters FROM dealer_ratings WHERE did='109' GROUP BY rating ORDER BY rating";
if(!$result=mysqli_query($con, $sql)){die("Cannot Get Dealer ratings This Time--".mysqli_error($con));}
$count=mysqli_num_rows($result);
if($count==0){echo"No Reviews Yet!";}
		//echo"<br>count = ".$count;

while($row=mysqli_fetch_array($result))
	{
		$qtty = $row['value'];
		$voter[$qtty] = $row['voters'];
		echo $qtty."* = ".$voter[$qtty]."<br>";
	}
	$total_voters=0;
	for($j = 1;$j <= 5;$j++)
	{$total_voters+=$voter[$j];}//sum of total voters for star1+star2+..+star5
	if($total_voters==0){$total_voters=1;} //to prevent division by zero error
	for($i=1;$i <= 5;$i++)  //$i=1*, 2*,...,5*
	{
		$percentage[$i]=$rat[$i]/($total_voters*5)*100;
	}
	echo $percentage[5]."%, ";echo $percentage[4]."%, ";echo $percentage[3]."%, ";echo $percentage[2]."%, ";echo $percentage[1]."%, ";
?>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	
		.bars {
		  font-family: Arial;
		  margin: 0 auto; /* Center website */
		  max-width: 800px; /* Max width */
		  padding: 20px;
		} 

		.heading {
		  font-size: 25px;
		  margin-right: 25px;
		}

		.fa {
		  font-size: 25px;
		}

		.checked {
		  color: orange;
		}

		/* Three column layout */
		.side {
		  float: left;
		  width: 15%;
		  margin-top: 10px;
		}

		.middle {
		  float: left;
		  width: 70%;
		  margin-top: 10px;
		}

		/* Place text to the right */
		.right {
		  text-align: right;
		}

		/* Clear floats after the columns */
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}

		/* The bar container */
		.bar-container {
		  width: 100%;
		  background-color: #f1f1f1;
		  text-align: center;
		  color: white;
		}

		/* Individual bars */
		.bar-5 {width: <?php echo $percentage[5]."%"; ?>; height: 18px; background-color: #4CAF50;}
		.bar-4 {width: <?php echo $percentage[4]."%"; ?>; height: 18px; background-color: #2196F3;}
		.bar-3 {width: <?php echo $percentage[3]."%"; ?>; height: 18px; background-color: #00bcd4;}
		.bar-2 {width: <?php echo $percentage[2]."%"; ?>; height: 18px; background-color: #ff9800;}
		.bar-1 {width: <?php echo $percentage[1]."%"; ?>; height: 18px; background-color: #f44336;}

		/* Responsive layout - make the columns stack on top of each other instead of next to each other */
		@media (max-width: 400px) {
		  .side, .middle {
			width: 100%;
		  }
		  /* Hide the right column on small screens */
		  .right {
			display: none;
		  }
		}
	</style>
</head>
<div class="bars">
          <div class="heading">Overall Dealer Rating</div>
		  <div class="side">   <div>5 star</div>	  </div>
		  <div class="middle">		<div class="bar-container">		  <div class="bar-5"></div>		</div>		  </div>
		  <div class="side right">	<div><?php echo $voter[5]; ?></div>	  </div>
		  <div class="side">		<div>4 star</div>		  </div>
		  <div class="middle">		<div class="bar-container">		  <div class="bar-4"></div>		</div>		  </div>
		  <div class="side right">	<div><?php echo $voter[4]; ?></div>  </div>
		  <div class="side">		<div>3 star</div>		  </div>	  
		  <div class="middle">		<div class="bar-container">		  <div class="bar-3"></div>		</div>		  </div>
		  <div class="side right">	<div><?php echo $voter[3]; ?></div>  </div>
		  <div class="side">		<div>2 star</div>		  </div>
		  <div class="middle">		<div class="bar-container">  	  <div class="bar-2"></div>		</div>		  </div>
		  <div class="side right">	<div><?php echo $voter[2]; ?></div>  </div>
		  <div class="side">		<div>1 star</div>   	  </div>
		  <div class="middle">		<div class="bar-container">		  <div class="bar-1"></div>		</div>		  </div>
		  <div class="side right">	<div><?php echo $voter[1]; ?></div>  </div>
	<span class="lead display-4"><?php echo round($rating,1);?></span><span class="text-info font-italic">Star Rating</span>
	<?php
		for($i= 1; $i <= 5; $i++): 
			$checked = ($i<=$rating) ? 'checked' : '' ;
			echo "<span class='fa fa-star ".$checked."'></span>";
		endfor 
	?>
</div> <!-- ./bars -->




  </body>
  </html>
<?php } else{	header("location:index.php");	}?>
  <!--<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span> 
-->