<!DOCTYPE html>
<?php
include("connection.php");
include("Functions.php");
include("sendmail.php");
?>

<?php
   if(isset($_SESSION['workdone']))
  {  echo "<div class='alert alert-success'>".$_SESSION['workdone']; 
	 echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
	 unset($_SESSION['workdone']);} 
  ?>
  
<?php
	if(isset($_POST['workdone']))
	{
		$book_id=sanitize($con, $_POST['booking_id']);
		$pay_status=sanitize($con, $_POST['pay_status']);
		if($pay_status!="Not Paid"){ $sql="UPDATE booking set status='Done' WHERE id='$book_id'";}
		else{$sql="UPDATE booking SET status='Done', payment='Offline/Paid to Worker' WHERE id='$book_id'";}
		if(!mysqli_query($con, $sql))
		{
			die("Error in updation--".mysqli_error($con));
		}
		//SEND CONFIRMATION MAIL TO CUSTOMER WITH WORK DONE STATUS
			$result1=mysqli_query($con, "SELECT email FROM customerLogin WHERE id=(SELECT cid FROM booking WHERE id='$book_id')");
			$customer_email=mysqli_fetch_assoc($result1);
			$dealer_result=mysqli_query($con, "SELECT did FROM booking WHERE id='$book_id'");
			$dlr=mysqli_fetch_assoc($dealer_result);
			$did=$dlr['did'];
			$to = $customer_email['email'];
			$subject = "Vehicle Washed!!";
			$message = "Your Vehicle has been Washed, Please take your keys.Make sure you pay your bill if not paid! 
						Please give your feedback to so that we can improve, click: http://localhost/smcs/dealer_ratings.php?rate_id=".$did;
			$headers = "shahid.sheikhpora@gmail.com";
			sendmail($to,$subject,$message,$headers);
			$_SESSION['workdone']="Work and Payment Status  Updated Successfully! --".$_SESSION['mailstatus']; 
			unset($_SESSION['mailstatus']);
			header("location:workstatus.php?work_id=".$book_id); exit;
	}		
?>
<?php if(isset($_GET['work_id']))
	{ 
	$id=$_GET['work_id'];
?>
	<html>
		<head>
			<title>SMCS Workers Status Portal </title>
			<link rel="stylesheet" href="css/bootstrap.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
			<script>
			
			function printContent()
				{
					var restorepage=document.body.innerHTML;
					var printContent=document.getElementById("container").innerHTML;
					document.body.innerHTML=printContent;
					window.print();
				}
			/* $(document).ready(function(){	  
				$("#print").on("click", function(){alert("hii");
					$("#container").printThis();  
					//return false; // why false?
				});					
			}); */
		</script>
		</head>
		<body>
		<div class="container">
		<div class="row">
		<div class="col-md-12">	
			<div class = "panel panel-success" id="container">
					<div class = "panel-heading">
						<h3 class = "panel-title text-primary">Work Status Updation</h3>
					</div>
						<div class = "panel-body">						
						 <table class = "table table-responsive">
						 <?php
						  $sql="SELECT date,vehiclenumber,payment,amount,status, 
									(SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
										(SELECT customerLogin.phone FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer_phone,
											(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
												(SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage
													 FROM booking WHERE booking.id='$id'";
								if(!$result=mysqli_query($con, $sql)){die("Details cannot be fetched!".mysqli_error($con));}
								$row=mysqli_fetch_assoc($result); 
						 ?>
							
							<tr>
							   <td>Customer Name </td><td><?php echo $row['customer']; ?></td>
							</tr>
							<tr>
							   <td>Customer Mobile</td> <td><?php echo $row['customer_phone']; ?></td>
							</tr>
							<tr>
							   <td>Vehicle Category</td><td><?php echo $row['carname']; ?></td>
							</tr>
							<tr>
							   <td>Your Package Name</td><td><?php echo $row['Washpackage']; ?></td>
							</tr>
							<tr>
							   <td>Package Amount</td><td><?php echo $row['amount']; ?></td>
							</tr>
							<tr>
							   <td>Vehicle Number</td><td><?php echo $row['vehiclenumber']; ?></td>
							</tr>
							<tr>
							   <td>Booking Date and Time</td><td><?php echo $row['date']; ?></td>
							</tr>
							<tr>
								<td>Work Status</td>
								<?php
								   if($row['status']!="Pending"){echo"<td class='text-info'>".$row['status']."</td>"; }
									else{echo"<td class='text-danger'><i>".$row['status']."</i></td>";}
								?>
							</tr>
							<tr>
							   <td>Payment Status</td>
							   <?php
								   if($row['payment']!="Not Paid"){echo"<td class='text-primary'><i><b>".$row['payment']."</b></i></td>";}
									else{echo"<td class='text-danger'><i><b>".$row['payment']."</b></i></td>";}	
							    ?>
							</tr>
						 </table>
						</div>
							<p class="lead">**Please Take Payments if Not paid</p>
			</div><!-- ./panel -->
			<div>
				
				<form method="POST" action="workstatus.php">
				<input type="hidden" value="<?php echo $id; ?>" name="booking_id">
				<input type="hidden" value="<?php echo $row['payment']; ?>" name="pay_status">
				<input type="submit" class="btn btn-success px-4" value="Work Done" id="workdone" name="workdone">
				<input type="button" class="btn btn-info px-4" value="Print" id="print" name="print" onclick="printContent()">		
			    <a href="index.php" class="btn btn-danger">Close</a></td>
				</form>
			</div>
		</div><!-- ./col -->
		</div><!-- ./row -->
		</div><!-- ./container -->
		</body>
		 <!-- Bootstrap core JavaScript -->
		 <script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
</html>
<?php
	}
	else{	header("location:index.php");	}
?>