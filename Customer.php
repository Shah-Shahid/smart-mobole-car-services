<!DOCTYPE html>
<html lang="en">
<?php
include("connection.php");
session_start();

//If User has logged in else go to login page[see at bottom]
if(isset($_SESSION['user_id']))
{
	//echo $_SESSION['user'];
	$id=$_SESSION['user_id'];
?>



<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Smart Mobile Car Services</title>
  <!-- Bootstrap core CSS -->
  <style>
  div.background{
	 // background-color:#f00;
  }
  div.background:hover
  {
  opacity:0.5;
  }
  
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.css">
  
</head>

<body style="background-color: #e2e2e2;">

  <!-- Navigation -->
  <?php include("navigation.php");?>

  <!-- Header -->
  <header class="bg-primary py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="display-4 text-white mt-5" >Smart Mobile Car Services</h1> <!-- display-4 for large size -->
          <p class="lead mb-4 text-white-50">   <!--50=opacity -->SMCS is one of the features in the automobile industry that lets you find the right dealers 
											 from the application.	It brings cleaning service at your doorsteps and also saves your time and energy.</p>
        </div>
      </div>
    </div>
  </header>  

  <!-- Page Content -->
  
    
  <div class="row">
	 <div class="col-md-12">
	   <form method="POST" action="logout.php">
		 <p style="border:6px solid #000;float:right;border-radius:10px;background-color:#E0FFFF;color:white;font-weight:bold;font-size:20px"><span class="p-3 text-uppercase"><kbd><?php echo "  ".$_SESSION['user']."  "; ?></kbd></span>
		 <input type="submit" class="btn btn-dark" value="Log Out" name="customer_logout"></form></p>
	 </div>
 </div>
 <?php
	if(isset($_SESSION['customerupdated'])) 
	{ 
		echo "<div class='alert alert-success'> Mr. ".$_SESSION['customerupdated']." Your Details were Updated successfully!";
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['customerupdated']);
	}
	?>
	
	<div class='container'>
            <div class="row">     
				<div class="col-md-4">
					<div class=" jumbotron text-center" style="box-shadow:10px 10px 5px #888888;">
						
						<h2>The Car wash</h2>
						<h4>that comes to you.</h4>

						<p><i><code>Book Online!</code></i></p>
						<p class="lead text-muted">for maximum convenience.</p>

					</div>
				</div>	<!--  ./col 4 -->
				<div class="col-md-8">
					<div class="media">
						<img src="images/car wash.jpg" class="img-thumbnail media-object">
					</div>
				</div>	<!--  ./col 8 -->
			</div>   <!--  ./row -->
			
			<div class="row">     <!--  .////////////////////////////////////////////row -->
				<div class="col-md-10">
					<div class="text-justify" >
						
						<h3>Online Car Wash Booking</h3>
						<p class="lead">We strive to be your most convenient car washing option by bringing our service right to your doorstep. Our pricing is 
						competitive and our knowledge of detailing is unmatched.Whether you're seeking a quick car wash that comes to you or a showcar quality
						finish, Online Car Wash Booking and Detailing has the skills to get the job done. We're happy to work with you to put together a 
						package that addresses your needs; no more, no less. </p>

					</div>
				</div>	<!--  ./col 4 -->
				<div class="col-md-2">
					<div class="media hidden-sm">
						<img src="images/CarWashBookingSystem.png" class="media-object">
					</div>
				</div>	<!--  ./col 8 -->
			</div>   <!--  ./row -->
			
		  <div class="row">
			 <div class="col-md-2">
				<a href="booking.php?customer_id=<?php echo $id;?>" style="text-decoration:none;"><div class="background text-center">
					<img class="img-responsive" width="100px" src="images/book_online.gif">				
					<p class="text-dark"><strong> Book Online</strong></p></a>
				</div>
				<p class="text-center lead">Book Online your car wash. Our experts will reach your location with our mobile car washing vehicle.</p>
			 </div>
			 <div class="col-md-2">
				<a href="services.php" style="text-decoration:none;"><div class="background text-center">
					<img class="img-responsive" width="100px" src="images/our_services.gif">				
					<p class="text-dark"><strong>Our Services</strong></p>
			    </div></a>
				<p class="lead  text-center">Our proprietary methods save water and our hand care of the vehicle eliminates the risk of scratches..... </p>
			 </div>
			 <div class="col-md-2">
				<a href="#bookings" id="my_booking" style="text-decoration:none;"><div class="background text-center" >
					<img class="img-responsive" width="80px" height="70px" src="images/book.gif">				
					<p class="text-dark"> <strong>My Bookings</strong></p>
			    </div></a>
				<p class="lead text-center">Click here to see a complete list of your previous bookings with their details.</p>
			 </div>
			 <div class="col-md-2">
				<a href="#"  style="text-decoration:none;"><div class="background text-center">
					<img class="img-responsive" width="100px" height="70px" src="images/telephone.png">				
					<p class="text-dark"><strong>Make a Call</strong></p>
			    </div></a>
				<p class="lead text-center">Make a call to book your car wash. Our experts will reach your location with our mobile car washing vehicle.</p>
			 </div>
			 <div class="col-md-2">
				<a href="customerupdation.php?update=cusomer<?php echo $id;?>" style="text-decoration:none;"><div class="background text-center">
					<img class="img-responsive" width="90px" height="80px" src="images/login-icon.png">				
					<p class="text-dark"> <strong> Update profile</strong></p>
			    </div></a>
				<p class="lead text-center">Click here to modify and update your latest personal details like name, phone, address etc.</p>
			 </div>
			 <div class="col-md-2">
				<a href="customerupdation.php?user_pwd=change" style="text-decoration:none;"><div class=" background text-center">
					<img class="img-responsive" width="80px" height="65px" src="images/loginbg.png">				
					<p class="text-dark"><strong> Change Password<strong></p>
			    </div></a>
				<p class="lead text-center">Click here to to change your password anytime.</p>
			 </div>
		  </div> <!-- ./row -->
		  
		  
	</div> <!-- /.container -->
	
	<!-- ///////	Make div and fill with below content through ajax (copy this code to populate)	///////// -->
	<div class="container">
	<p class="text-center bg-dark text-white p-1 text-uppercase">Here is a list of your previous bookings</p>
	<?php
	$sql="SELECT id, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
						(SELECT login.workshop FROM login WHERE login.id=booking.did) AS dealer,
							(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
								booking.vehiclenumber, (SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage,
									booking.amount, booking.date FROM booking WHERE booking.cid=$id";
	$result=mysqli_query($con, $sql);
	echo"<div class='table-responsive' id='bookings'>";
	echo"<table class='table table-striped'><tr>";	
	echo"<th>Booking ID</th>";	
	echo"<th>Customer</th>";	
	echo"<th>Dealer</th>";	
	echo"<th>Package</th>";
	echo"<th>Date</th>";	
	//echo"<th>Worker</th>";
	echo"<th>More...</th>";
	echo"</tr>";
	while($row=mysqli_fetch_array($result))
	{
		echo"<tr>";
		echo"<td>".$row['id']."</td>";
		echo"<td>".$row['customer']."</td>";
		echo"<td>".$row['dealer']."</td>";
		echo"<td>".$row['Washpackage']."</td>";
		echo"<td>".$row['date']."</td>";
		//echo"<td>".$row['worker']."</td>";
		echo"<td><a href='#' class='btn btn-info'>Details</a></td>";
		echo"</tr>";
	}
	echo"</table>";
	echo"</div>"; 
	?>
  </div>	 <!-- ./container -->

  <!-- Footer -->
  <?php include("footer.php"); ?>

  <!-- Bootstrap core JavaScript -->
  <script>
  //Show Previous Booking details Of Customer in a div through Ajax call
	$(document).ready(function(){
	  $("#my_booking").on("click",function(){
		  var customer ="'"+<?php echo$id;?>+"'"; console.log(customer);
		if(customer==""){ alert("Please Select Some Customer to show"); return false;}		
		else
		{	var xmlhttp; 		
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
			{
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
					{						
					var res=xmlhttp.responseText;
					document.getElementById("area").innerHTML=res;
					}
			}		
		xmlhttp.open("GET","populate.php?my_bookings="+dealer, true);
		xmlhttp.send();
		}
	  });
	});
  </script>
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>


<?php
//If User has not logged in
}
else
{
	header("location:index.php"); exit;
}
?>
