<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$db_name="smcs";
$con=mysqli_connect($servername, $username, $password, $db_name); 
if(!$con) { die("Connection Error !".mysqli_error());	}
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

<body background="Images\login-bg.jpg">

  <!-- Page Content -->
  <div class="container" >
  
  <!-- PHP code to welcome the Customer for first time #E6E6FA -->
<?php
if(isset($_SESSION['name'])) 
{ 
	 echo "<div class='alert alert-success'> Thank you <strong>".$_SESSION['name']."</strong> for choosing us. You can login and use our services, We will notify you through email shortly ! </div>";
	session_unset();
} 
?> 
  

<!--<p class="lead text-center"> If you are a new Customer please Register First</p>-->
<div class="row">
	<div class="col-md-4 mb-5"><div style="background-image:url('login.png');"></div></div>
      <div class="col-md-4 mb-5" style="margin-top:15%">
        <div class="card border-0"><img class="card-img" src="images\login-head.jpg" >
		 <div class="card-img-overlay">  <!-- to bring the card text over image -->
          <div class="card-body">
            <span style="margin-left:35%"><img src="images\login-icon.png" style="width:50px"></span>
			<form action="CustLogin.php" method="post">
             <div class="form-group" style="margin-top:50%">
				   <label for="email"> Name:</label>
				   <div> <input type="email" class="form-control glyphicon glyphicon-user" placeholder="Enter Your Email" name="email" style="background:#C6C6EA" id="email"></div>
				   <label for="password"> Password:</label>
				   <div> <input type="password" class="form-control glyphicon glyphicon-lock" placeholder="Enter Your password" name="password" style="background:#C6C6EA" id="password"></div>				
			 </div>
			 <div class="form-group">
				 <hr><input type="submit" class="btn btn-warning"  name="login" value="Log In" style="margin-left:35%;margin-top:-7%;">
				 
			
			 <p class="lead">If u are a new user click <a href="CustRegistration.php" style="text-decoration:none;margin-top:-7%"> here </a> to register</p>
           </div></div>
				
			
			    </form>
		 </div> 
		</div>
      </div>
	  <div class="col-md-4 mb-5"></div>
  <!-- /.row style="background:#E6E6FA"-->
  </div>
  </div>
  <!-- /.container -->

 

  <!-- Bootstrap core JavaScript -->
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>
<?php
if(isset($_POST['login']))
{
	$mail=$_POST['email'];
	$pwd=$_POST['password'];
	$pwd=md5($pwd);
	$result=mysqli_query($con, "SELECT * FROM customerlogin WHERE email='$mail' && password='$pwd' && status='1'");
	$rowcount=mysqli_num_rows($result);	
	if($rowcount==true)
	{
		echo "<script> window.location.assign('Customer.php'); </script>";
	}
	else
	{
		echo "Invalid Customer";
		
	}
	
}