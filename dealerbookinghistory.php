<!DOCTYPE html>
<?php
include("connection.php");
include("Functions.php");
session_start();

//If Dealer has logged in else go to login page[see at bottom]
if(isset($_SESSION['dealer_id']))
{
	$dealerName=$_SESSION['dealer'];
	$id=$_SESSION['dealer_id'];
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Smart Mobile Car Services</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <style>
	.container{padding:2px; }
  </style>
</head>

<body>

  <!-- Navigation -->
 <?php include("navigation.php");?>

  <!-- Header -->
  <header class="bg-primary py-5 mb-5">
    <div class="container ">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="display-4 text-white mt-5" >Smart Mobile Car Services</h1> <!-- display-4 for large size -->
          <p class="lead mb-5 text-white-50">   <!--50=opacity -->SMCS is one of the features in the automobile industry that lets you find the right dealers 
											 from the application.	It brings cleaning service at your doorsteps and also saves your time and energy.</p>
        </div>
      </div>
    </div>
  </header>  

  
  <div class="row">
	 <div class="col-md-12">
		 <form method="POST" action="logout.php">
			 <p style="border:6px solid #000;float:right;border-radius:10px;background-color:#E0FFFF;color:white;font-weight:bold;font-size:20px"><span class="p-3 text-uppercase"><kbd><?php echo "  ".$_SESSION['dealer']."  "; ?></kbd></span>
			<input type="submit" class="btn btn-dark" value="Log Out" name="dealer_logout"></form></p>
	 </div>
 </div>
  <!-- Page Content -->
 
 	<div class='container'>		<div><p class="lead text-primary">Sort By:-</p><br></div>
		  <div class="row">
		    <form method="POST" action="dealerbookinghistory.php" id="bookingstoday">
			 <div class="col-md-3">
			 <?php
				if(isset($_POST['book_today']))	{ echo"<input type='radio' name='book_today' checked id='book_today'>Todays Bookings ";}			
				else {	echo"<input type='radio' name='book_today'  id='book_today'>Todays Bookings ";  }			
				?>
			 </div>
			 </form>
			 
			 			 
			 <form method="POST" action="dealerbookinghistory.php" id="bookingsdone">
			 <div class="col-md-3">
				<?php
				if(isset($_POST['book_done'])){echo"<input type='radio' name='book_done'  checked id='book_done'>Bookings Done";}
				else { echo"<input type='radio' name='book_done' id='book_done'>Bookings Done"; }
				?>
			 </div>
			 </form>
			  
			 <form method="POST" action="dealerbookinghistory.php" id="bookingspending">			
			 <div class="col-md-3">
			 <?php
				if(isset($_POST['book_pending'])){echo"<input type='radio' name='book_pending' checked id='book_pending'>Pending Bookings";}
				else {  echo"<input type='radio' name='book_pending' id='book_pending'>Pending Bookings";	}
			 ?>
			 </div>
			  </form>
			 
			 <form method="POST" action="dealerbookinghistory.php" id="bookingsbypayment">
			 <div class="col-md-3">
				<label>By Payment</label>
				<select name="payment" id="book_payment">
				<option value="">Select</option><option value="Not Paid">Not Paid</option><option value="Paid Online">Paid Online</option><option value="Paid Offline">Paid Offline</option>
				</select>
			 </div>	
			</form>
			 
			 <form method="POST" action="dealerbookinghistory.php" id="bookingsbyworker">
			 <div class="col-md-3">
				<label>By Worker</label>
				<select name="worker" id="book_worker">
				<option value="">Select</option>
				<?php
					$qry="SELECT * FROM workers WHERE did='$id'";
						$r=mysqli_query($con, $qry);
						while($rw=mysqli_fetch_array($r))
						{			
							echo "<option value=".$rw['id'].">".$rw['firstname']."</option>";
						}
				?>
				</select>
			 </div>	
			</form>
		  </div> <!-- ./row -->	<hr>	  
	</div> <!-- /.container -->
<div class="container">
<?php
	$head="All Bookings";
	$sql="SELECT id, worker,status,payment, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
						(SELECT login.workshop FROM login WHERE login.id=booking.did) AS dealer,
							(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
								booking.vehiclenumber, (SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage,
									booking.amount, booking.date FROM booking WHERE booking.did=$id AND booking.worker!='0'";
if(isset($_POST['book_today']))
{
	$sql="SELECT id, worker,status,payment, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
						(SELECT login.workshop FROM login WHERE login.id=booking.did) AS dealer,
							(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
								booking.vehiclenumber, (SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage,
									booking.amount, booking.date FROM booking WHERE booking.did=$id AND DATE(date)=CURDATE()";
	$head="Today's Bookings";  //SELECT * FROM `booking` WHERE DATE(date)=CURDATE()
}
if(isset($_POST['book_done']))
{

	$sql="SELECT id, worker,status,payment, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
						(SELECT login.workshop FROM login WHERE login.id=booking.did) AS dealer,
							(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
								booking.vehiclenumber, (SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage,
									booking.amount, booking.date FROM booking WHERE booking.did=$id AND booking.status='Done'";
		$head="Bookings Which are completed";
}
if(isset($_POST['book_pending']))
{

	$sql="SELECT id, worker,status,payment, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
						(SELECT login.workshop FROM login WHERE login.id=booking.did) AS dealer,
							(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
								booking.vehiclenumber, (SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage,
									booking.amount, booking.date FROM booking WHERE booking.did=$id AND booking.status='Pending'";
		$head="Bookings Which in progress";
}
if(isset($_POST['payment']))
{
	$mode=$_POST['payment'];
	$sql="SELECT id, worker,status,payment, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
						(SELECT login.workshop FROM login WHERE login.id=booking.did) AS dealer,
							(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
								booking.vehiclenumber, (SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage,
									booking.amount, booking.date FROM booking WHERE booking.did=$id AND booking.payment='$mode'";
	$head="Bookings By Payment";
}
if(isset($_POST['worker']))
{
	$worker=$_POST['worker'];
	$sql="SELECT id, worker,status,payment, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
						(SELECT login.workshop FROM login WHERE login.id=booking.did) AS dealer,
							(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
								booking.vehiclenumber, (SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage,
									booking.amount, booking.date FROM booking WHERE booking.did=$id AND booking.worker='$worker'";
	$head="Bookings By Worker";
}


	$result=mysqli_query($con, $sql);
		$rowcount=mysqli_num_rows($result);	
		if($rowcount!=true)
		{echo"<div class='alert alert-warning'>No Records Found!</div>";}
	echo"<div><p class='lead bg-info p-2'>".$head."</p></div>";
	echo"<div class='table-responsive'>";
	echo"<table class='table table-striped'><tr>";	
	echo"<th>Booking ID</th>";	
	echo"<th>Customer Name</th>";	
	echo"<th>Dealer </th>";	
	echo"<th>Vehicle Type</th>";	
	echo"<th>Vehicle Number</th>";	
	echo"<th>Package</th>";
	echo"<th>Amount</th>";
	echo"<th>Date</th>";	
	echo"<th>Worker</th>";
	echo"<th>Work Status</th>";
	echo"<th>Payment Status</th>";
	echo"</tr>";
	while($row=mysqli_fetch_array($result))
	{
		echo"<tr>";
		echo"<form method='POST' action='Dealer.php' onsubmit='return checkworker()'>";//Form to submit booking id and worker assigned
		echo"<input type='hidden' name='book_id' value='".$row['id']."'>";
		echo"<td>".$row['id']."</td>";
		echo"<td>".$row['customer']."</td>";
		echo"<td>".$row['dealer']."</td>";
		echo"<td>".$row['carname']."</td>";
		echo"<td>".$row['vehiclenumber']."</td>";
		echo"<td>".$row['Washpackage']."</td>";
		echo"<td>".$row['amount']."</td>";
		echo"<td>".$row['date']."</td>"; 
		
		$qry="SELECT firstname FROM workers WHERE workers.id=".$row['worker'];
		$r=mysqli_query($con, $qry);
		$rw=mysqli_fetch_assoc($r);
		echo "<td>".$rw['firstname']."</td>";
		 echo"</form>";//Form close
		if($row['status']!="Pending"){echo"<td class='text-info'>".$row['status']."</td>"; }
		else{echo"<td class='text-danger'><i>".$row['status']."</i></td>";}
		if($row['payment']!="Not Paid"){echo"<td class='text-primary'><i><b>".$row['payment']."</b></i></td>";}
		else{echo"<td class='text-danger'><i><b>".$row['payment']."</b></i></td>";}	
		echo"</tr>";
	}
	echo"</table>";
	echo"</div>";
	?>
</div>

  <!-- Footer -->
  <?php include("footer.php"); ?>

  <!-- Bootstrap core JavaScript -->
  <script>
	$(document).ready(function(){	  
		$("#book_done").on("click",function(){
			$(this).closest("#bookingsdone").submit();
		});		
	});
	
	$(document).ready(function(){	  
		$("#book_pending").on("click",function(){
			$(this).closest("#bookingspending").submit();
		});		
	});
	
	$(document).ready(function(){	  
		$("#book_payment").on("change",function(){
			$(this).closest("#bookingsbypayment").submit();
		});		
	});
	
	$(document).ready(function(){	  
		$("#book_worker").on("change",function(){
			$(this).closest("#bookingsbyworker").submit();
		});		
	});
	
	$(document).ready(function(){	  
		$("#book_today").on("click",function(){
			$(this).closest("#bookingstoday").submit();
		});		
	});
	
	
  </script>
  
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>

<?php
//If Dealer has not logged in
}
else
{
	header("location:index.php"); exit;
}
?>
