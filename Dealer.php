<!DOCTYPE html>
<?php
include("connection.php");
include("Functions.php");
include("sendmail.php");
//session_start();

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
  <?php
  if(isset($_SESSION['workeradded']))
  {  echo "<div class='alert alert-success'>".$_SESSION['workeradded']; 
	 echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
	 unset($_SESSION['workeradded']);}
  ?>
  <?php
	if(isset($_SESSION['dealerupdated'])) 
	{ 
		echo "<div class='alert alert-success'> Thank you <strong>".$_SESSION['dealerupdated']."</strong> Your details were updated Successfully.. !";
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['dealerupdated']);
	}
	?>
	<?php
	if(isset($_SESSION['workeradded'])) 
	{ 
		echo "<div class='alert alert-success'>".$_SESSION['workeradded'];
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['workeradded']);
	}
	?>
	<?php
	if(isset($_SESSION['booking_rejected'])) 
	{ 
		echo "<div class='alert alert-danger'>".$_SESSION['booking_rejected'];
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['booking_rejected']);
	}
	?>
	<!--<div id="worker_not_added_Error" class="alert alert-warning"><button class='close' data-dismiss='alert'>&times;</button></div>-->
<h1>Dealer Home Page</h1>

<?php
if(isset($_POST['assignworker']))
{
	$worker_id=sanitize($con, $_POST['worker']);
	$book_id=sanitize($con, $_POST['book_id']);
	$sql="UPDATE booking set worker='$worker_id' WHERE id='$book_id'";
	if(!mysqli_query($con, $sql))
	{
		die("Error in updation--".mysqli_error($con));
	}
	//SEND CONFIRMATION MAIL TO CUSTOMER WITH WORKER AND TIME DETAILS
		$result1=mysqli_query($con, "SELECT email,phone FROM customerLogin WHERE id=(SELECT cid FROM booking WHERE id='$book_id')");
		$customer_email=mysqli_fetch_assoc($result1);
		$to = $customer_email['email'];
		$subject = "Your Booking Has been Approved!";
		$message = "The worker will contact u soon please be petient!".$customer_email['phone']."If u want to pay online please click here: http://localhost/smcs/book.php?pay_id=".$book_id;
		$headers = "shahid.sheikhpora@gmail.com";
		sendmail($to,$subject,$message,$headers);
		
		//SEND MAIL TO WORKER WITH BOOKING, CUSTOMER AND TIME DETAILS
		$result=mysqli_query($con, "SELECT email,phone FROM workers WHERE id='$worker_id'");
		$worker_email=mysqli_fetch_assoc($result);
		$to = $worker_email['email'];
		$subject = "NEW Booking for you";
		$message = "Mr Worker Please contact This Number ".$worker_email['phone']." and please update status after work is done. update here: http://localhost/smcs/workstatus.php?work_id=".$book_id;
		$headers = "shahid.sheikhpora@gmail.com";
		sendmail($to,$subject,$message,$headers);
		$_SESSION['workeradded']="Worker and Status Updated Successfully! --".$_SESSION['mailstatus']."--".$worker_id; 
		unset($_SESSION['mailstatus']);
	header("location:dealer.php"); exit;
}

if(isset($_GET['del_id']))
{
	$del_book_id=sanitize($con, $_GET['del_id']);
	/* $sql="DELETE FROM booking WHERE id='$del_book_id'";
	if(!mysqli_query($con, $sql))
	{
		die("Error in updation--".mysqli_error($con));
	}*/
		$to = "shahid.shahid.rasool200@gmail.com";
		$subject = "rejected booking id - ".$del_book_id;
		$message = "This dealer has rejected the booking!";
		$headers = "shahid.sheikhpora@gmail.com";
		sendmail($to,$subject,$message,$headers);		
	$_SESSION['booking_rejected']="This booking history has been deleted From You, Customer?? and admin informed!--".$_SESSION['mailstatus'];
	unset($_SESSION['mailstatus']);	
	header("location:dealer.php"); exit;
}
?>
<?php
	$sql="SELECT id,amount,date, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
						(SELECT login.workshop FROM login WHERE login.id=booking.did) AS dealer,
							(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
								booking.vehiclenumber, (SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage
								    FROM booking WHERE booking.did='$id' AND booking.worker='0' ORDER BY date DESC";
	
	echo"<div class='table-responsive'>";
	echo"<table class='table table-striped'><tr>";	
	echo"<th>Booking ID</th>";	
	echo"<th>Customer ID</th>";	
	echo"<th>Dealer ID</th>";	
	echo"<th>Vehicle Type</th>";	
	echo"<th>Vehicle Number</th>";	
	echo"<th>Package</th>";
	echo"<th>amount</th>";
	echo"<th>Date</th>";	
	echo"<th>Assign Worker</th>";
	echo"<th>Action</th>";
	echo"<th>More...</th>";
	echo"</tr>";
	$line=0;
	if(!$result=mysqli_query($con, $sql)) {  die("Cannot Read Booking Records".mysqli_error($con));  }
	while($row=mysqli_fetch_array($result))
	{
		echo"<tr>";
		echo"<form method='POST' action='Dealer.php'>";
		echo"<input type='hidden' name='book_id' value='".$row['id']."'>";
		echo"<td>".$row['id']."</td>";
		echo"<td>".$row['customer']."</td>";
		echo"<td>".$row['dealer']."</td>";
		echo"<td>".$row['carname']."</td>";
		echo"<td>".$row['vehiclenumber']."</td>";
		echo"<td>".$row['Washpackage']."</td>";
		echo"<td>".$row['amount']."</td>";
		echo"<td>".$row['date']."</td>"; 
		
		$qry="SELECT * FROM workers WHERE status=0";$line++;
		echo"<td><select name='worker' id='worker".$line."'>";
		//echo"<option value=''>--Assign Worker--</option>";
		$r=mysqli_query($con, $qry);
		while($rw=mysqli_fetch_array($r))
		{			
			echo "<option value=".$rw['id'].">".$rw['firstname']."</option>";
		}
		echo"</td></select>";
		
		echo"<td><input type='submit' class='btn btn-success' value='Accept' name='assignworker' onsubmit='return checkworker(".$line.")'></td></form>";
		echo"<td><a href='Dealer.php?del_id=".$row['id']."' class='btn btn-danger'>Reject</a></td>";
		echo"</tr>";
	}
	echo"</table>";
	echo"</div>";
	?>

	<div class='container'>
		
		  <div class="row">
		  
			 <div class="col-md-3">
				<a href="dealerupdation.php?addworker=add" class="btn btn-info">Add worker</a>
			 </div>
		
			 <div class="col-md-3">
				<a href="dealerupdation.php?updateprofile=edit" class="btn btn-info">Update Profile</a>
			 </div>
			 
			 <div class="col-md-3">
				<a href="dealerupdation.php?dealerpwd=change" class="btn btn-info">Change Password</a>
			 </div>
			 
			 <div class="col-md-3">
				<a href="dealerbookinghistory.php" class="btn btn-info">Booking History &raquo;</a>
			 </div>
			 			 
		  </div> <!-- ./row -->
		  
		  
	</div> <!-- /.container -->

  
 

  <!-- Footer -->
  <?php include("footer.php"); ?>

  <!-- Bootstrap core JavaScript -->
  <script>
	function checkworker(line)
	{
		var workerID="worker"+line;alert(workerID);
		var worker=document.getElementById(workerID).value;
		if(worker=="")
		{
			alert("Please Assign worker");
			//document.getElementById("worker_not_added_Error").innerHTML="Please Assign worker";
			return false;
		}
	}
  
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
