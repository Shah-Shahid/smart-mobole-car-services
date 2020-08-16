<!DOCTYPE html>
<?php
include("connection.php");
include("Functions.php");
include("sendmail.php");
//session_start();

//If worker has logged in else go to login page[see at bottom]
if(isset($_SESSION['worker_id']))
{
	$workerName=$_SESSION['worker'];
	$id=$_SESSION['worker_id'];
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SMCS Workers Portal</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  
</head>

<body>

  <!-- Navigation -->
 <?php include("navigation.php");?>

  <!-- Header -->
  <header class="bg-primary py-3 mb-3">
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
		 <p style="border:6px solid #000;float:right;border-radius:10px;background-color:#E0FFFF;color:white;font-weight:bold;font-size:20px"><span class="p-3 text-uppercase"><kbd><?php echo "  ".$_SESSION['worker']."  "; ?></kbd></span>
		<input type="submit" class="btn btn-dark" value="Log Out" name="worker_logout"></form></p>
	 </div>
 </div>
  <!-- Page Content -->
  <?php
   if(isset($_SESSION['workdone']))
  {  echo "<div class='alert alert-success'>".$_SESSION['workdone']; 
	 echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
	 unset($_SESSION['workdone']);} 
  ?>
  <?php
	 if(isset($_SESSION['status'])) 
	{ 
		echo "<div class='alert alert-success'>".$_SESSION['status'];
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['status']);
	} 
	?>
	
	<?php
	if(isset($_SESSION['workerupdated'])) 
	{ 
		echo "<div class='alert alert-success'> Thank you <strong>".$_SESSION['workerupdated']."</strong> Your details were updated Successfully.. !";
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['workerupdated']);
	}
	?>
<h1>Worker Home Page</h1>

<?php
 if(isset($_POST['workdone']))
{
	$book_id=sanitize($con, $_POST['book_id']);
	$pay_status=sanitize($con, $_POST['pay_status']);
	$did=sanitize($con, $_POST['did']);
	if($pay_status!="Not Paid"){ $sql="UPDATE booking set status='Done' WHERE id='$book_id'";}
	else{$sql="UPDATE booking SET status='Done', payment='Offline/Paid to Worker' WHERE id='$book_id'";}
	if(!mysqli_query($con, $sql))
	{
		die("Error in updation--".mysqli_error($con));
	}
	//SEND CONFIRMATION MAIL TO CUSTOMER WITH WORK DONE STATUS
		$result1=mysqli_query($con, "SELECT email FROM customerLogin WHERE id=(SELECT cid FROM booking WHERE id='$book_id')");
		$customer_email=mysqli_fetch_assoc($result1);
		$to = $customer_email['email'];
		$subject = "Vehicle Washed!!";
		$message = "Your Vehicle has been Washed, Please take your keys.Make sure you pay your bill if not paid! 
						Please give your feedback to so that we can improve, click: http://localhost/smcs/dealer_ratings.php?rate_id=".$did;
		$headers = "shahid.sheikhpora@gmail.com";
		sendmail($to,$subject,$message,$headers);
		$_SESSION['workdone']="Work and Payment Status  Updated Successfully! --".$_SESSION['mailstatus']; 
		unset($_SESSION['mailstatus']);
		header("location:worker.php"); exit; 
}	
	if(isset($_GET['carstatus']))
	{
		$book_id=sanitize($con, $_GET['carstatus']);
		$sql="UPDATE booking set status='Not Available' WHERE id='$book_id'";
		if(!mysqli_query($con, $sql))	{	die("Error in updation--".mysqli_error($con));		}
			if(!$ruslt=mysqli_query($con, "SELECT email FROM login WHERE id=(SELECT did FROM booking WHERE id='$book_id')")){die("Dealer Mail cannot be fetched!".mysqli_error($con));}
						$mail=mysqli_fetch_assoc($ruslt);
						$to = $mail['email'];
						$subject = "Vehicle Not Available - ".$number;
						$message = "Please Click Here to check the details  : http://localhost/smcs/dealerbookinghistory.php";
						$headers = "shahid.sheikhpora@gmail.com";
						sendmail($to,$subject,$message,$headers);		
			$_SESSION['status']="Thank You for your efforts, Vehicle Not Available Updated Successfully! --".$_SESSION['mailstatus']; 
			unset($_SESSION['mailstatus']);
		header("location:worker.php"); exit; 
	}
?>
<?php
	$sql="SELECT id,payment,did, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
						(SELECT customerLogin.phone FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer_phone,
							(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
								booking.vehiclenumber, (SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage,
									booking.amount, booking.date FROM booking WHERE booking.worker='$id' AND booking.status='Pending'";
	
	echo"<div class='table-responsive'>";
	echo"<table class='table table-striped'><tr>";	
	echo"<th>Booking ID</th>";	
	echo"<th>Customer ID</th>";	
	echo"<th>Contact</th>";	
	echo"<th>Vehicle Type</th>";	
	echo"<th>Vehicle Number</th>";	
	echo"<th>Package</th>";
	echo"<th>amount</th>";
	echo"<th>Date</th>";	
	echo"<th>Payment Status</th>";
	echo"<th>Work Done</th>";
	echo"<th>More...</th>";
	echo"</tr>";
	$line=0;
	if(!$result=mysqli_query($con, $sql)) {  die("Cannot Read Booking Records".mysqli_error($con));  }
	while($row=mysqli_fetch_array($result))
	{
		echo"<tr>";
		echo"<form method='POST' action='worker.php'>";
		echo"<input type='hidden' name='book_id' value='".$row['id']."'>";
		echo"<input type='hidden' name='pay_status' value='".$row['payment']."'>";
		echo"<input type='hidden' name='did' value='".$row['did']."'>";
		echo"<td>".$row['id']."</td>";
		echo"<td>".$row['customer']."</td>";
		echo"<td>".$row['customer_phone']."</td>";
		echo"<td>".$row['carname']."</td>";
		echo"<td>".$row['vehiclenumber']."</td>";
		echo"<td>".$row['Washpackage']."</td>";
		echo"<td>".$row['amount']."</td>";
		echo"<td>".$row['date']."</td>";
		if($row['payment']!="Not Paid"){echo"<td class='text-primary'><i><b>".$row['payment']."</b></i></td>";}
		else{echo"<td class='text-danger'><i><b>".$row['payment']."</b></i></td>";}		  	
		echo"<td><input type='submit' class='btn btn-success' value='Done' name='workdone'></td></form>";
		echo"<td><a href='worker.php?carstatus=".$row['id']."' class='btn btn-danger btn-sm'>Not Available</a></td>";
		echo"</tr>";
	}
	echo"</table>";
	echo"</div>";
	?>

	<div class='container'>
		
		  <div class="row">
		  
			 <div class="col-md-3">
				<a href="" class="btn btn-info">Action??</a>
			 </div>
		
			 <div class="col-md-3">
				<a href="workerupdation.php?updateprofile=edit" class="btn btn-info">Update Profile</a>
			 </div>
			 
			 <div class="col-md-3">
				<a href="workerupdation.php?workerpwd=change" class="btn btn-info">Change Password</a>
			 </div>
			 
			 <div class="col-md-3">
				<a href="workerbookinghistory.php" class="btn btn-info">My Booking History &raquo;</a>
			 </div>
			 			 
		  </div> <!-- ./row -->
		  
		  
	</div> <!-- /.container -->

  
 

  <!-- Footer -->
  <?php include("footer.php"); ?>

  <!-- Bootstrap core JavaScript -->
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>

<?php
//If Worker has not logged in
}
else
{
	header("location:index.php"); exit;
}
?>
