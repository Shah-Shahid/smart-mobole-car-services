<!DOCTYPE html>
<?php
session_start();
include("connection.php");
include("Functions.php");

//If Worker has logged in else go to login page[see at bottom]
if(isset($_SESSION['worker_id']))
{
	//$dealerName=$_SESSION['dealer'];
	$id=$_SESSION['worker_id'];
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

<body style="background-color:#FFEBCD">

  <!-- Navigation -->
  <?php include("navigation.php");?>

  <!-- Header -->    
  <header class="py-1 " ><img class="img-responsive" src="images/register-header.jpg" style="width:100%;opacity:0.7;">
    <span><form method="POST" action="logout.php"><input type="submit" class="btn btn-warning" style="position:fixed;top:50px;right:0px;z-index:999;" value="Log Out" name="worker_logout"></form></span>
  </header>       
   
	
	  <?php
		if(isset($_SESSION['workerupdated'])) 
		{ 
			echo "<div class='alert alert-warning'> Mr. <strong>".$_SESSION['workerupdated']."</strong> Your password is incorrect <a href='#'>forget Password</a>";
			echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
			unset($_SESSION['workerupdated']);
		}
		?>
		<?php
		if(isset($_SESSION['pwdnotchanged'])) 
		{ 
			echo "<div class='alert alert-warning'><strong>".$_SESSION['pwdnotchanged']."</strong> <a href='#'>forget Password</a>";
			echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
			unset($_SESSION['pwdnotchanged']);
		}
		?>
 
 <!-- Page Content -->  
<div class="row" > 
 <div class="col-md-3 embed-responsive"><img class="img-responsive" src="images/listing_img4.jpg" style="width:100%;opacity:0.7"></div>
	
	<?php 
		if(isset($_GET['updateprofile']))
		{
			$sql="SELECT firstname, lastname, phone FROM workers WHERE id='$id'";
			 $result=mysqli_query($con,$sql);
			 $row=mysqli_fetch_assoc($result); 
	?>
     <div class="col-md-6 d-block m-auto " style="background-color:#E0FFFF;">
	  <p class="lead  p-2" style="background-color:rgb(0,255,0,0.7);">Please Check the following details</p>
	
		<form action="register.php" method="post" enctype="multipart/form-data"  onsubmit="return validateForm()">
		 <div class="form-group" >
			<label for="fname">First Name:</label>  
			<input type="text" class="form-control" name="fname" placeholder="Enter Firstname" id="fname" value="<?php echo $row['firstname']; ?>"> 
			<span id="workerfname" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="lname">Last Name:</label>
			<input type="text" class="form-control" name="lname"  placeholder="Enter Lastname" id="lname" value="<?php echo $row['lastname']; ?>">
			<span id="workerlname"class="text-danger font-weight-bold" ></span>			
		 </div>
		 <div class="form-group">
			<label for="phone">Phone:</label>
			<input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" id="phone" value="<?php echo $row['phone']; ?>">
			<span id="workerphone" class="text-danger font-weight-bold"></span>
		</div>
		 <div class="form-group">
			<label for="password">Enter Password</label>
			<input type="password" class="form-control" name="password" placeholder="Enter Your Password" id="password">
			<span id="workerpwd" class="text-danger font-weight-bold"></span>
		 </div>
		 <input type="hidden" value="<?php echo $id; ?>" name="id">
		 <div class="form-group text-center">
			<input type="submit" class="form-control btn btn-primary" name="updateworker" value="Update" style="width:100px">  
			<a  href="worker.php" class="btn btn-danger">Cancel</a>  
		 </div>
	 </form>
	
 </div>
	<?php  }  ?>
	
	 <?php
  if(isset($_GET['workerpwd']))
  {  
  ?>
	<div class="col-md-6 d-block m-auto " style="background-color:#E0FFFF;">
	  <p class="lead  p-2" style="background-color:rgb(0,255,0,0.7);">Please Check the following details</p>
  
		  <form method="POST" action="register.php">
			  <div class="form-group">
				  <label>Enter Your Old Password</label>
				  <input type="password" class="form-control" placeholder="Old Password" name="oldpwd">
				  <label>Enter Your New Password</label>
				  <input type="password" class="form-control" placeholder="Enter New Password" name="newpwd">
				  <label>Confirm Your New Password</label>
				  <input type="password" class="form-control" placeholder="Re-Enter New Password"><br>
				  
				  <input type="hidden" value="<?php echo $id; ?>" name="id">
			  </div>
			  <div class="form-group text-center">
				<input type="submit" class="btn btn-primary px-5 mx-3" value="Confirm" name="changeWorkerPassword">
				<a href="worker.php" class="btn btn-danger px-5">Cancel</a>
			  </div>
		  </form>
	</div>
  <?php } ?>
 <div class="col-md-3 embed-responsive"><img class="img-responsive" src="images/facts_bg.jpg" style="width:100%;opacity:0.7"></div>
 
  </div>  <!-- ./row -->
  <!-- Footer 
  <?php include("footer.php"); ?>  -->
  
  
 <!--JavaScript validateForm() -->
 
  <!-- Bootstrap core JavaScript -->
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