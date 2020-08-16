<!DOCTYPE html>
<?php
//session_start();
include('Register.php'); 
//If User has logged in else go to login page[see at bottom]
if(isset($_SESSION['user_id']))
{
	//echo $_SESSION['user'];
	$id=$_SESSION['user_id'];
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
  <header class="py-1" ><img class="img-responsive" src="images/register-header.jpg" style="width:100%;opacity:0.7;">
    <span><form method="POST" action="logout.php"> <input type="submit" class="btn btn-warning" style="position:fixed;top:50px;right:0px;z-index:999;" value="Log Out" name="customer_logout"></form></span>
  </header>   
  
  <!-- Page Content -->
  
  <?php
		if(isset($_SESSION['customernotupdated'])) 
		{ 
			echo "<div class='alert alert-warning'> <strong>".$_SESSION['customernotupdated']."</strong>";
			echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
			unset($_SESSION['customernotupdated']);
		}
	?>
	<?php
		if(isset($_SESSION['customerpwdnotchanged'])) 
		{ 
			echo "<div class='alert alert-warning'><strong>".$_SESSION['customerpwdnotchanged']."</strong> <a href='#'>forget Password</a>";
			echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
			unset($_SESSION['customerpwdnotchanged']);
		}
	?>
  
  <?php
  if(isset($_GET['update']))
  {
	 $sql="SELECT * FROM customerlogin WHERE id='$id'";
	 $result=mysqli_query($con,$sql);
	 $row=mysqli_fetch_assoc($result);  
  ?>

 
  
<div class="row" > 
 <div class="col-md-3 embed-responsive"><img class="img-responsive" src="images/listing_img4.jpg" style="width:100%;opacity:0.7"></div>
  <div class="col-md-6 d-block m-auto " style="background-color:#E0FFFF;">
   <p class="lead  p-2" style="background-color:rgb(0,255,0,0.7);">Please Check the following details</p>
	
		<form action="register.php" method="post" enctype="multipart/form-data"  onsubmit="return validateForm()">
		 <div class="form-group" >
			<label for="fname">First Name:</label>  
			<input type="text" class="form-control" name="firstname" placeholder="Enter Firstname" id="fname" value="<?php echo $row['firstname']; ?>"> 
			<span id="userfname" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="lname">Last Name:</label>
			<input type="text" class="form-control" name="lastname"  placeholder="Enter Lastname" id="lname" value="<?php echo $row['lastname']; ?>">
			<span id="userlname"class="text-danger font-weight-bold" ></span>			
		 </div>
		 <div class="form-group">
			<label for="phone">Phone:</label>
			<input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" id="phone" value="<?php echo $row['phone']; ?>">
			<span id="userphone" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="address">Address</label>
			<input type="text" class="form-control" name="address" placeholder="Enter Your Address" id="address" value="<?php echo $row['address']; ?>">
			<span id="useraddress" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="password">Enter Password</label>
			<input type="password" class="form-control" name="password" placeholder="Enter Your Password" id="password">
			<span id="customererpwd" class="text-danger font-weight-bold"></span>
		 </div>
		 <input type="hidden" value="<?php echo $id; ?>" name="id">
		 <div class="form-group text-center">
			<input type="submit" class="form-control btn btn-primary" name="updateCustomer" value="Update" style="width:100px">  
			<input type="reset" class="form-control btn btn-primary ml-4" name="reset" value="Reset" style="width:100px">  
		 </div>
	 </form>
	
 </div>
 <div class="col-md-3 embed-responsive"><img class="img-responsive" src="images/facts_bg.jpg" style="width:100%;opacity:0.7"></div>

 
  <?php } ?> <!-- /.container -->
  
  
  <div class="row">
  <div class="col-md-4 ml-5">
  
  
  <?php
  if(isset($_GET['user_pwd']))
  {
	  //$id=sanitize($con, $_GET['user_pwd']);
	  
  ?>
  
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
				<input type="submit" class="btn btn-primary px-5 mx-3" value="Confirm" name="changeUserPassword">
				<a href="customer.php" class="btn btn-danger px-5">Cancel</a>
			  </div>
	</form>
  <?php } ?>
 
  </div>  <!-- ./col-sm-12 -->
  </div>  <!-- ./row -->

  </div>
  <!-- Footer -->
  <?php include("footer.php"); ?>  
  
  
 <!--JavaScript validateForm() -->
 <script>
  function validateForm()
  {
	  var firstname = document.getElementById("fname").value;
	  var lastname = document.getElementById("lname").value;
	  var mobile = document.getElementById("phone").value;
	  var email = document.getElementById("mail").value;
	  var password = document.getElementById("pwd").value;
	  var confirmPassword = document.getElementById("pwd1").value;
	  var address = document.getElementById("address").value;
	  
	  
	  //clear all span tags first
	  document.getElementById("userfname").innerHTML="";
	  document.getElementById("userlname").innerHTML="";
	  document.getElementById("userphone").innerHTML="";
	  document.getElementById("usermail").innerHTML="";
	  document.getElementById("userpwd").innerHTML="";
	  document.getElementById("userpwd1").innerHTML="";
	  document.getElementById("useraddress").innerHTML="";
	  
	  if(firstname=="")
	  {
		  document.getElementById("userfname").innerHTML="**Please fill this field"; 
		  return false;
	  }
	  
	  //Check if any Special Character Is Filled
	  var splChars = "*|,\":<>[]{}`\';()@&$#%-+=";
		for (var i = 0; i < firstname.length; i++)
			{
				if (splChars.indexOf(firstname.charAt(i)) != -1)
				{
					document.getElementById("userfname").innerHTML="**Please dont fill special characters"; 
					return false;
				}
			}
	  
	  if(firstname.length <=2 || firstname.length >=20 )
	  {
		  document.getElementById("userfname").innerHTML="**First Name must be 3-20 characters"; 
		  return false;
	  }
	  
	  if(!isNaN(firstname))
	  {
		  document.getElementById("userfname").innerHTML="**Numbers are Not Allowed"; 
		  return false;
	  }
	  
	  if(lastname=="")
	  {
		  document.getElementById("userlname").innerHTML="**Please fill this field"; 
		  return false;
	  }
	  
	  if(lastname.length <=2 || lastname.length >=20)
	  {
		  document.getElementById("userlname").innerHTML="**Last Name must be 3-20 characters"; 
		  return false;
	  }
	  
	  if(!isNaN(lastname))
	  {
		  document.getElementById("userlname").innerHTML="**Numbers are Not Allowed"; 
		  return false;
	  }
	 
	   //Check if any Special Character Is Filled
	  var splChars = "*|,\":<>[]{}`\';()@&$#%-+=";
		for (var i = 0; i < lastname.length; i++)
			{
				if (splChars.indexOf(lastname.charAt(i)) != -1)
				{
					document.getElementById("userlname").innerHTML="**Please dont fill special characters"; 
					return false;
				}
			}
	  
	  if(mobile=="")
	  {
		  document.getElementById("userphone").innerHTML="**Please fill this field"; 
		  return false;
	  }
	  
	  if(isNaN(mobile) || mobile.length!=10)
	  {
		  document.getElementById("userphone").innerHTML="**Please enter valid mobile Number"; 
		  return false;
	  }
	  
	   //Check if any Special Character Is Filled
	  var splChars = "*|,\":<>[]{}`\';()@&$#%-+=";
		for (var i = 0; i < mobile.length; i++)
			{
				if (splChars.indexOf(mobile.charAt(i)) != -1)
				{
					document.getElementById("userphone").innerHTML="**Please dont fill special characters"; 
					return false;
				}
			}
	  /*
	  if(email=="")
	  {
		  document.getElementById("usermail").innerHTML="**Please fill this field"; 
		  return false;
	  }
	  
	   //Check if any Special Character Is Filled
	  var splChars = "*|,\":<>[]{}`\';()&$#%-+=";
		for (var i = 0; i < password.length; i++)
			{
				if (splChars.indexOf(password.charAt(i)) != -1)
				{
					document.getElementById("userpwd").innerHTML="**Please dont fill special characters"; 
					return false;
				}
			}
	  */
	  if(password=="")
	  {
		  document.getElementById("userpwd").innerHTML="**Please fill this field"; 
		  return false;
	  }
	  
	  if(password.length >10)
	  {
		  document.getElementById("userpwd").innerHTML="**Password length must be less than 11"; 
		  return false;
	  }
	  
	   //Check if any Special Character Is Filled
	  var splChars = "*|,\":<>[]{}`\';()&$#%-+=";
		for (var i = 0; i < password.length; i++)
			{
				if (splChars.indexOf(password.charAt(i)) != -1)
				{
					document.getElementById("userpwd").innerHTML="**Please dont fill special characters"; 
					return false;
				}
			}
	  
	  if(confirmPassword=="")
	  {
		  document.getElementById("userpwd1").innerHTML="**Please fill this field"; 
		  return false;
	  }
	  
	  if(confirmPassword!=password)
	  {
		  document.getElementById("userpwd1").innerHTML="**Password and Confirm Password does not match"; 
		  return false;
	  }
	  
	   //Check if any Special Character Is Filled
	  var splChars = "*|,\":<>[]{}`\';()&$#%-+=";
		for (var i = 0; i < confirmPassword.length; i++)
			{
				if (splChars.indexOf(confirmPassword.charAt(i)) != -1)
				{
					document.getElementById("userpwd1").innerHTML="**Please dont fill special characters"; 
					return false;
				}
			}
	  
	  if(address=="")
	  {
		  document.getElementById("useraddress").innerHTML="**Please fill this field"; 
		  return false;
	  }
	  
	  if(address.length>=40 || address.length<=3)
	  {
		  document.getElementById("useraddress").innerHTML="**Address must be 3-20 characters"; 
		  return false;
	  }
	  
	  if(!isNaN(address))
	  {
		  document.getElementById("useraddress").innerHTML="**Please enter valid address"; 
		  return false;
	  }
	  
	   //Check if any Special Character Is Filled
	  var splChars = "*|,\":<>[]{}`\';()@&$#%-+=";
		for (var i = 0; i < address.length; i++)
			{
				if (splChars.indexOf(address.charAt(i)) != -1)
				{
					document.getElementById("useraddress").innerHTML="**Please dont fill special characters"; 
					return false;
				}
			}
	  
	  
  }
  
  </script>
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