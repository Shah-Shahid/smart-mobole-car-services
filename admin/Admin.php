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
  
  <style>
  .adminlogin
  {
	  margin-left:30%;
  }
  </style>
</head>
<body>

<?php
include("..\connection.php");
session_start();
//If Admim has logged in else go to login page[see at bottom]
if(isset($_SESSION['admin_id']))
{
	//echo $_SESSION['admin'];
	//$id=$_SESSION['admin_id'];
?>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="admin.php">Admin Module (Only You Can See) </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar" >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav" style="margin-left:auto">  <!-- margin-left:auto to right align the menu -->
          <li class=" active">
            <a class="nav-link" href="../index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li >
            <a class="nav-link" href="../about.php">About</a>
          </li>
          <li>
            <a class="nav-link" href="../services.php">Services</a>
          </li>
          <li>
            <a class="nav-link" href="../contact.php">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="bg-primary py-3 mb-5 hidden-xs">
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

  <!-- Page Content -->
  <?php
	if(isset($_SESSION['car_added'])) 
	{ 
		echo "<div class='alert alert-success'>".$_SESSION['car_added'];
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['car_added']);
	}
	?> 
	<?php
	if(isset($_SESSION['package_added'])) 
	{ 
		echo "<div class='alert alert-success'>".$_SESSION['package_added'];
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['package_added']);
	}
	?>
  
 <h1>Admin Module here</h1>
 <div class="row">
      <div class="col-md-4 mb-5">
        
            <h4 class="card-title">Add New Vehicle Type</h4>        
            <a href="update.php?car=newcar" class="btn btn-primary">Click Here</a><br>
			
			<h4 class="card-title">Add New Wash Package</h4>			
			<a href="update.php?package=newpackage" class="btn btn-primary">Click Here</a>
			
			<h4 class="card-title">Manage Bookings</h4>			
			<a href="bookingmanagement.php" class="btn btn-primary">Click Here</a>
			
			<h4 class="card-title">All Dealer</h4>			
			<a href="dealer_all.php" class="btn btn-primary">Click Here</a>
          
       
      </div>
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h4 class="card-title bg-warning p-2">Manage Customers</h4>
            <p class="card-text">Approve the new Customer requests. You can Delete the Registered Customers as well.</p>
          </div>
          <div class="card-footer">
            <a href="CustomerManagement.php" class="btn btn-info">Click Here!</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h4 class="card-title  bg-warning p-2">Manage Dealers</h4>
            <p class="card-text">Approve the new dealer requests. You can Delete the Registered dealers as well. </p>
          </div>
          <div class="card-footer">
            <a href="DealerManagement.php" class="btn btn-info">Click Here!</a>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  
  <!-- /.container -->
  
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="text-center text-white">Copyright &copy; Smart Mobile Car Services 2019 | All rights Reserved &reg;</p>
    </div><!-- /.container -->    
  </footer>

	 <?php
	//If Admin has not logged in The following login Page will be shown 
	}
	else
	{
	?>
		
		<div class="row bg-dark">
			<div class="col-sm-6 bg-light m-5">
				<div ><p style="float:right;font-weight:bold;font-size:28px;margin-bottom:10px"><a href="..\index.php">&times;</a></p></div>
				<form method="POST" action="admin.php">
					<div class="form-group m-5 p-5">
						<label for"email">Email ID</label>
						<input type="text" name="email" id="email" class="form-control" placeholder="Enter Email...">
						<label>Password</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Enter Password..."><br>
						<input type="submit" class="btn btn-primary mx-5 px-5" value="Login" name="adminlogin" id="">
						
					</div>
				</form>
			</div> <!-- ./col-sm-6 -->
		</div> <!-- ./row -->
		
	<?php		
	}
	?> 
  
  <!-- Bootstrap core JavaScript -->
  
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>

<?php		
if(isset($_POST['adminlogin']))
{
	$email=mysqli_real_escape_string($con, $_POST['email']);
	$password=mysqli_real_escape_string($con, $_POST['password']);
	$sql="SELECT * FROM admin WHERE email='$email' && password='$password'";
	$result=mysqli_query($con, $sql);
	$rowcount=mysqli_num_rows($result);	
	if($rowcount==true)
	{
		$row=mysqli_fetch_assoc($result);
		$_SESSION['admin']=$row['email'];$_SESSION['admin_id']=$row['id'];
		header("location:admin.php"); exit;
	}
	else
	{
		echo "<div class='alert alert-danger text-center' style='position:absolute;top:0;width:100%'>**Incorrect login details</div>";  exit;		
	}

}	
?> 

