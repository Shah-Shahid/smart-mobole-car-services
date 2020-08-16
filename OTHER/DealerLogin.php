<?php
session_start();
include("connection.php");
include("Functions.php");

//session_unset();
?>



<!DOCTYPE html>
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

<body background="Images\car black.jpg">

 <div class="container"> <!-- Page Content -->
	  
	<!-- PHP code to welcome the dealer for first time  -->
	<?php
	if(isset($_SESSION['name'])) 
	{ 
		echo "<div class='alert alert-success'> Thank you <strong>".$_SESSION['name']."</strong> for choosing us. You can login and use our services, We will notify you through email shortly !  </div>";
		unset($_SESSION['name']);
	}
	?> 
	<?php
	if(isset($_SESSION['pwdchanged'])) 
	{ 
		echo "<div class='alert alert-success'><strong>".$_SESSION['pwdchanged']."</strong></div>";
		unset($_SESSION['pwdchanged']);
	}
	?> 
	<div id="msg" class="alert alert-warning" style="display:none"></div>  <!-- Used in javascript to print msg if login fields are empty  style="background:#C6C6EA"-->
	<!--<p class="lead" id="info"> If you are a new Dealer please Register First</p>-->
	<div class="row">
		<div class="col-lg-4 col-md-3 col-sm-2 col-xs-2 mb-2"></div>
		  <div class="col-lg-4 col-md-6 col-sm-8 col-xs-8 mb-2">
			<div class="card border-0" style="margin-top:25%;"><img class="card-img img-responsive" src="images\login-head.jpg" >
			 <div class="card-img-overlay">  <!-- to bring the card text over image -->
			  <div class="card-body">
				<span style="float:right;font-weight:bold;font-size:28px;"><a href="index.php" class="close text-warning">&times;</a></span>
				 <div class="form-group" style="margin-top:65%">
					<form action="DealerLogin.php" method="post" onsubmit="return check()">
					   <label for="email"> Email:</label>
					   <div> <input type="email" class="form-control glyphicon glyphicon-user" placeholder="Enter Your Email" name="email" style="background:#000;border-color:#000" id="email"></div>
					   <label for="password"> Password:</label>
					   <div> <input type="password" class="form-control glyphicon glyphicon-lock" placeholder="Enter Your password" name="password" style="background:#000;border-color:#000" id="password"></div>						
				 </div>
				 <div class="form-group">
					 <hr><input type="submit" class="btn btn-danger"  name="login" value="Log In" style="margin-left:35%;"><span><small> <a href="#" class="text-dark">Forget Password</a></small></span>			
					 <p class="lead text-white">If u are a new user click <a href="DealerRegistration.php" class="text-danger" style="text-decoration:none;margin-top:-7%;font-weight:bold"> Here </a> to register</p>
			     </div>
			  </div>
				</form></div>
			 </div>
		  </div>
		<div class="col-lg-4 col-md-3 col-sm-2 col-xs-2 mb-2"></div>
	</div>
		 
	</div>  <!-- /.row -->
 
 </div> <!-- /.container -->

  
  <!-- Bootstrap core JavaScript -->
  <script>
  function check()
  {
	  var email=document.getElementById("email").value;
	  var pwd=document.getElementById("password").value;
	  
	  if(email=="" || pwd=="")
	  {
		  document.getElementById("msg").style.display="block";
		  document.getElementById("msg").innerHTML="**Please fill all the fields!";
		  return false;
	  }
  }
  </script>
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>
<?php
if(isset($_POST['login']))
{
	$mail=sanitize($con, $_POST['email']);
	$pwd=sanitize($con, $_POST['password']);
	$pwd=md5($pwd);
	$result=mysqli_query($con, "SELECT * FROM login WHERE email='$mail' && password='$pwd' && status='1'");
	$rowcount=mysqli_num_rows($result);
	
	if($rowcount==true)
	{
		//echo "<script> window.location.assign('Dealer.php'); </script>";
		$row=mysqli_fetch_assoc($result);
		$_SESSION['dealer']=$row['firstname'];
		$_SESSION['dealer_id']=$row['id'];
		header("location:Dealer.php"); exit;
	}
	else
	{
		echo "<div class='alert alert-danger text-center' style='position:absolute;top:0;width:100%'>**Incorrect login details</div>";   		
	}
	
}