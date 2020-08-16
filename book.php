<!DOCTYPE html>
<?php
//session_start();
include("connection.php");
include("Functions.php");
include("sendmail.php");
?>

<?php
   if(isset($_SESSION['Paymentdone']))
  {  echo "<div class='alert alert-success'>".$_SESSION['paymentdone']; 
	 echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
	 unset($_SESSION['paymentdone']);} 
  ?>
  
<?php if(isset($_GET['pay_id']))
	{ 
	$id=$_GET['pay_id'];
?>
	<html>
		<head>
			<title> Booking Summary </title>
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
			</script>
		</head>
		<body>
		<div class="container">
		<div class="row">
		<div class="col-md-12">	
			<div class = "panel panel-success" id="container">
					<div class = "panel-heading">
						<h3 class = "panel-title text-primary">Booking Summary</h3>
					</div>
						<div class = "panel-body">						
						 <table class = "table table-responsive">
						 <?php
						  $sql="SELECT date,vehiclenumber,cid,payment, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
									(SELECT login.workshop FROM login WHERE login.id=booking.did) AS dealer,
										(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
											(SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage,
												(SELECT workers.firstname FROM workers WHERE workers.id=booking.worker) AS Workername,
													(SELECT workers.phone FROM workers WHERE workers.id=booking.worker) AS Workerphone,
														booking.amount FROM booking WHERE booking.id='$id'";
								if(!$result=mysqli_query($con, $sql)){die("Details cannot be fetched!".mysqli_error($con));}
								$row=mysqli_fetch_assoc($result); 
						 ?>
							
							<tr>
							   <td>Customer Name </td><td><?php echo $row['customer']; ?></td>
							</tr>
							<tr>
							   <td>Dealer/Workshop</td> <td><?php echo $row['dealer']; ?></td>
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
							   <td>Worker's Name</td><td><?php echo $row['Workername'] ?></td>
							</tr>
							<tr>
							   <td>Workers Contact</td><td><?php echo $row['Workerphone'] ?></td>
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
							<p class="lead">**To make payment offline please save this, while making payments show this to our worker</p>
			</div><!-- ./panel -->
			<div>
				
				<form method="POST" action="checkout.php">
				<input type="hidden" value="<?php echo $id; ?>" name="booking_id">
				<input type="hidden" value="<?php echo $row['cid']; ?>" name="Customer_id">
				<input type="hidden" value="9797724745" name="mobile">
				<input type="hidden" value="<?php echo $row['amount']; ?>" name="amount">
				<input type="submit" class="btn btn-success px-4" value="Make online  Payment" id="paynow" name="paynow">
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
	
		
	
	<?php } elseif(isset($_SESSION['user_id'])) {?>
		<html>
			<head>
				<title> Booking Summary </title>
				<link rel="stylesheet" href="css/bootstrap.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
				<script>
				function printContent()
				{
					var restorepage=document.body.innerHTML;
					var printContent=document.getElementById("container1").innerHTML;
					document.body.innerHTML=printContent;
					window.print();
					window.location.assign('Customer.php');
				}
				/* $(document).ready(function(){	  
					$("#print1").on("click", function(){
						window.print();  
						return false; // why false?
					});					
				}); */
				</script>
			</head>
		<body >
<?php	
		if(!isset($_POST['dealer'])){header("location:customer.php");}//to prevent error on page reload
		$customer=sanitize($con, $_POST['customer_id']);
		$dealer=sanitize($con, $_POST['dealer']);		
		$cartype=sanitize($con, $_POST['carid']);
		$package=sanitize($con, $_POST['packageid']);		
		$datetime=sanitize($con, $_POST['datetime']);
		$date = date("Y-m-d H:i:s",strtotime($datetime));		
		$number=sanitize($con, $_POST['carnumber']);
		
		 $sql1="INSERT INTO booking(cid, did, vehicleType, vehiclenumber, package, amount, date) VALUES ('$customer', '$dealer', '$cartype', '$number', '$package', (SELECT amount FROM packages WHERE id='$package'), '$date')";
			if(!mysqli_query($con, $sql1)) { die("Cannot Save your booking Please try Again!! ".mysqli_error($con)); }				
					$last_id = mysqli_insert_id($con);
					echo "<div class='alert alert-success>Booking Done Please be patient our worker will contact u soon</div>";	 	
		?>		

		
			<div class="container">
			<div class="row">
			<div class="col-md-12">	
				<?php
					if(!$ruslt=mysqli_query($con, "SELECT email FROM login WHERE id='$dealer'")){die("Dealer Mail cannot be fetched!".mysqli_error($con));}
					$mail=mysqli_fetch_assoc($ruslt);
					$to = $mail['email'];
					$subject = "You Have a New Booking - ".$number;
					$message = "Please approve and assign worker as soon as possible".$date."  Click here: http://sheikhporaschool.org/smcs";
					$headers = "shahid.sheikhpora@gmail.com";
					sendmail($to,$subject,$message,$headers);		
				echo"<div class='alert alert-success'>".$_SESSION['mailstatus']."</div>";
				unset($_SESSION['mailstatus']);
				?>
				<div class = "panel panel-success" id="container1">
					<div class = "panel-heading">
						<h3 class = "panel-title text-primary">Booking Summary</h3>
					</div>
						<div class = "panel-body">						
						 <table class = "table table-responsive">
						 <?php
						  $sql="SELECT date,payment, (SELECT customerLogin.firstname FROM customerLogin WHERE customerLogin.id=booking.cid) AS customer, 
									(SELECT login.workshop FROM login WHERE login.id=booking.did) AS dealer,
										(SELECT vehicletype.name FROM vehicletype WHERE vehicletype.id=booking.vehicleType) AS carname,
											(SELECT packages.name FROM packages WHERE packages.id=booking.package) AS Washpackage,
												booking.amount FROM booking WHERE booking.id='$last_id'";
								if(!$result=mysqli_query($con, $sql)){die("Details cannot be fetched!".mysqli_error($con));}
								$row=mysqli_fetch_assoc($result); 
						 ?>
							
							<tr>
							   <td>Customer Name </td><td><?php echo $row['customer']; ?></td>
							</tr>
							<tr>
							   <td>Dealer/Workshop</td> <td><?php echo $row['dealer']; ?></td>
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
							   <td>Vehicle Number</td><td><?php echo $number; ?></td>
							</tr>
							<tr>
							   <td>Booking Date and Time</td><td><?php echo $date; ?></td>
							</tr>
							<tr>
							   <td>Worker's Name</td><td class="text-danger"><i>Wait for Email</i></td>
							</tr>
							<tr>
							   <td>Workers Contact</td><td class="text-danger"><i>Wait for Email</i></td>
							</tr>
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
							<p class="lead">**You Can pay Online,, Please don't make payments until you get the booking Confirmation with Worker Details.</p>
							<p class="lead">**To make payment offline please save this, while making payments show this to our worker</p>
				</div><!-- ./panel -->
				<div>
				
					<form method="POST" action="checkout.php">
					<input type="hidden" value="<?php echo $last_id; ?>" name="booking_id">
					<input type="hidden" value="<?php echo $customer; ?>" name="Customer_id">
					<input type="hidden" value="9797724745" name="mobile">
					<input type="hidden" value="<?php echo $row['amount']; ?>" name="amount">
					<input type="submit" class="btn btn-primary px-4" value="Make online Payment" id="paynow" name="paynow">
					<input type="button" class="btn btn-info px-4" value="Save" id="print1" name="print" onclick="printContent()">
				</div>
			</form>
			</div><!-- ./col -->
			</div><!-- ./row -->
			</div><!-- ./container -->
			
			
			
			
			
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
	
	
	<?php //}//else Close important
			/* echo"<div class='p-2 border-2 bg-light'>";
			echo "<h3 class='p-2 bg-success'> Booking Summary</h3>";
			echo "<p class='lead'>  Customer Name".$customer."</p>";
			echo "<p class='lead'>  Dealer Name".$dealer."</p>";
			echo "<p class='lead'>  Vehicle Type".$cartype."</p>";
			echo "<p class='lead'>  Vehicle Number".$number."</p>";
			echo "<p class='lead'>  Wash Package".$package."</p>";
			echo "<p class='lead'>  Booking Date".$date."</p>";
			echo "</div>";			
				if(!$ruslt=mysqli_query($con, "SELECT email FROM login WHERE id='$dealer'")){die("Dealer Mail cannot be fetched!".mysqli_error($con));}
				$mail=mysqli_fetch_assoc($ruslt);
				$to = $mail['email'];
				$subject = "You Have a New Booking - ".$number;
				$message = "Please approve and assign worker as soon as possible".$date."  Click here: http://sheikhporaschool.org/smcs";
				$headers = "shahid.sheikhpora@gmail.com";
				sendmail($to,$subject,$message,$headers);		
			echo"<div class='alert alert-success'>".$_SESSION['mailstatus']."</div>";
			unset($_SESSION['mailstatus']);	 */
			
					
			?>
	