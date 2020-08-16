<!DOCTYPE html>
<?php
session_start();
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  </head>

<body style="background-color: #e2e2e2;">

 <?php include("navigation.php");?>

  <!-- Header -->
  <header class="bg-primary py-4 mb-5">
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
  
<!-- PHP code to welcome the dealer for first time  -->
	<?php
	if(isset($_SESSION['name'])) 
	{ 
		echo "<div class='alert alert-success'> Thank you <strong>".$_SESSION['name']."</strong> for choosing us. You can login and use our services, We will notify you through email shortly !";
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['name']);
	}
	?> 
<!-- PHP code to alert if customer's password changed successfully-->
	<?php
	if(isset($_SESSION['pwdchanged'])) 
	{ 
		echo "<div class='alert alert-success'><strong>".$_SESSION['pwdchanged']."</strong>";
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['pwdchanged']);
	}
	?> 
<!-- PHP code to alert if Dealer entered invalid login details-->
	<?php
	if(isset($_SESSION['invalidlogindetails'])) 
	{ 
		echo "<div class='alert alert-danger'> <strong> ".$_SESSION['invalidlogindetails']." </strong>";
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['invalidlogindetails']);
	}
	?> 

<!-- PHP code to welcome the Customer for first time-->
	<?php
	if(isset($_SESSION['name'])) 
	{ 
		echo "<div class='alert alert-success'> Thank you <strong>".$_SESSION['name']."</strong> for choosing us. You can login and use our services, We will notify you through email shortly !";
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['name']);
	} 
	?> 
<!-- PHP code to alert if customer's password changed successfully-->
	<?php
	if(isset($_SESSION['customerpwdchanged'])) 
	{ 
		echo "<div class='alert alert-success alert-dismissable'> <strong> ".$_SESSION['customerpwdchanged']." </strong>";
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['customerpwdchanged']);
	}
	?>
 <!-- PHP code to alert if customer entered invalid login details-->
	<?php
	/* if(isset($_SESSION['invalidcustomer'])) 
	{ 
		echo "<div class='alert alert-danger'> <strong> ".$_SESSION['invalidcustomer']." </strong>";
		echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		unset($_SESSION['invalidcustomer']);
	} */
	?> 
	<?php
	  if(isset($_SESSION['registered']))
	  {
		  echo "<div class='alert alert-danger m-0'> <strong>**".$_SESSION['registered']."**</strong>";
		  echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
		  unset($_SESSION['registered']);
	  }
	  ?>
	

  <!-- Page Content -->
  <div class="container">
	
    <div class="row">
      <div class="col-md-6 mb-4">
        <h2>What We Do</h2>
        <hr>
        <p>	Customers & Dealers needs to register in the application and customers can schedule the car service at his own priority times.
						 	Searching for the best option for a customer in terms of budget location and time.!</p>
        <p>	This portal is user-friendly. Provides with the best services anywhere as per the customer requirement.
			Its now easy using idle parking time to get the car washed and owners can carry out other activities, such as shopping, working, etc.</p>
        <a class="btn text-white  bg-dark" href="admin/admin1.php">MORE &raquo;</a>
      </div>
      <div class="col-md-3">
        <h2 class="bg-info text-white p-2">Contact Us</h2>
        <hr>
        <address>
          <strong>Kashmir</strong>
          <br>Srinagar
          <br>Rawalpora 190005
          <br><br>        
          <abbr title="Phone">Phone:</abbr>
          (+91) 9797724745
          <br>
          <abbr title="Email">Email:</abbr>
          <a href="mailto:shahid.sheikhpora@gmail.com">Smart_mcs@gmail.com</a>
        </address>
      </div>
   
	 <div class="col-md-3" style="background-color: #e2e2e2;">
        <div class="card" style="background-color: #e2e2e2;">
          <div class="card-body text-white">
            <h4 class="card-title bg-success p-2">Click Below To Login</h4><hr>   <img class="card-img img-responsive" src="images\caar3.jpg">        
          </div>
          <div class="card-footer text-center">
            <button class="btn btn-primary form-control" data-target="#CustomerLoginModal" data-toggle="modal">Login</button>
		  </div>							
		</div>
     </div>
	</div> <!-- ./row-->
	 <!-- ///////////////////////////////////////////***NEW ROW ***///////////////////////////////////////////////////////////// -->
	<div class="row" >
	
	 <div class="col-md-2" style="background: url(images/bg-adbox.jpg) no-repeat;">
        
            <h6 style="background-color:gray;border-radius:6px" class="p-2 text-center font-weight-bold">OUR SERVICES</h6>        
            <p>We offer three main services for your car washing needs. Each includes cleaning of both the interior and exterior of the vehicle</p>
            <p class="" style="background-color:gray;"><a  class="text-white btn" href="services.php">READ MORE</a></p>
		  
     </div>
	 
	 <div class="col-md-2" style="background: url(images/bg-adbox.jpg) no-repeat;">
			<h6 style="background-color:gray;border-radius:6px" class="p-2 text-center font-weight-bold">BOOK ONLINE</h6>       
            <p>Try our online booking application for maximum convenience.</p>
            <p class="" style="background-color:gray;"><a  class="text-white btn" href="contact.php">READ MORE</a></p>
     </div>
	 
	 <div class="col-md-2 " style="background: url(images/bg-adbox.jpg) no-repeat;">
			<h6 style="background-color:gray;border-radius:6px" class="p-2 text-center font-weight-bold">Our Special Offers</h6>        
            <p>Try our services and you might be one of lucky winners of rewards</p>
             <p class="" style="background-color:gray;"><a  class="text-white btn" href="contact.php">READ MORE</a></p>
     </div>
	 
	 <div class="col-md-2" style="background: url(images/bg-adbox.jpg) no-repeat;">
			<h6 style="background-color:gray;border-radius:8px" class="p-2 text-center">get in touch with us</h6>      
            <p>And we love the challenge of doing something diferent and something special</p>
            <p class="" style="background-color:gray;"><a  class="text-white btn" href="contact.php">READ MORE</a></p>
     </div>
	 
	 <div class="col-md-4 " style="background: url(images/listing_img4.jpg) no-repeat;">
			<p class="lead p-2 text-center bg-dark text-white" style="border-radius:10px">OUR GALARY</p> 
			<p>And we love the challenge of doing something diferent and something specialAnd we love the challenge of doing something 
			diferent and something special</p><p class="text-white">“Have a look of our photo gallery here.” </p>
            <p style="float:right" ><a  href=""class="text-white btn btn-sm bg-dark">VIEW IMAGES</a></p>
     </div>
	</div> <!-- /.row -->
	
  </div> <!-- /.container -->
  
  <!-- Bootstrap Modal for Customer, Dealer and worker login -->
    <div class="modal fade" id="CustomerLoginModal" data-backdrop="false" tabindex="-1" style=" background-color: rgba(0,0,0,0.6);">
		<div class="modal-dialog" >
			<div class="modal-content">
				<div class="modal-header bg-warning">
					<h4 class="modal-title">Enter Login Details </h4> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="material-icons" style="float:right;">&#xe853;</i>
					<button class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body bg-light">
					<div id="customerempty" class="alert alert-warning" style="display:none"><button class="close" data-dismiss="alert">&times;</button></div>  <!-- Used in javascript to print msg if login fields are empty -->
					<form action="register.php" method="POST" onsubmit="return checkCustomer()">
						<div class="form-group">
							<i class="material-icons">&#xe0be;</i><label for="email"> Email:</label>
							<input type="email" class="form-control glyphicon glyphicon-user" placeholder="Enter Your Email" name="email" style="background:#C6C6EA" id="email">
						</div>
						<div class="form-group">
							<i class="material-icons">&#xe897;</i><label for="password"> Password:</label>
							<input type="password" class="form-control glyphicon glyphicon-lock" placeholder="Enter Your password" name="password" style="background:#C6C6EA" id="password">
						</div>	
				</div>
				<div class="modal-footer bg-light">
					<div class="form-group">
						<input type="submit" class="btn btn-primary"  name="login" value="Log In" id="login">
						<button class="btn btn-danger" data-dismiss="modal">Close</button>
						<span><small> <a href="#" class="text-dark">Forget Password</a></small></span>				
						<p class="lead">If u are a new user click<button type="button" class="btn btn-success btn-sm" data-target="#register_modal" data-toggle="modal">Here</button>to register</p>
					 </form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Bootstrap Modal for link to Registration Page-->
	<div class="modal fade" id="register_modal" data-backdrop="false" tabindex="-1" style=" background-color: rgba(0,0,0,0.6);">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header bg-warning">
					<h4 class="modal-title">Dealer Login</h4>
					<button class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div id="dealerempty" class="alert alert-warning" style="display:none"><button class='close' data-dismiss='alert'>&times;</button></div>  <!-- Used in javascript to print msg if login fields are empty -->
						<div class="form-group">
							<a href="CustRegistration.php" class="btn btn-primary">Customer</a>
							<a href="DealerRegistration.php" class="btn btn-primary"> Dealer</a>
						</div>
				</div>
				<div class="modal-footer bg-light">
					<div class="form-group">
						<button class="btn btn-danger" data-dismiss="modal">Close</button>			
					</div>
				</div>
			</div>
		</div>
	</div>

  <!-- Footer -->
  <?php include("footer.php"); ?>

  <!-- Bootstrap core JavaScript -->
 
  <script>
  function checkDealer()
  {
	  //document.getElementById("dealerempty").style.display="none";
	  var email=document.getElementById("dealeremail").value;
	  var pwd=document.getElementById("dealerpassword").value;
	  
	  if(email=="" || pwd=="")
	  {
		  document.getElementById("dealerempty").style.display="block";
		  document.getElementById("dealerempty").innerHTML="**Please fill all the fields";
		  return false;
	  }
  }
  function checkCustomer()
  {
	  var email=document.getElementById("email").value;
	  var pwd=document.getElementById("password").value;
	  
	  if(email=="" || pwd=="")
	  {
		  document.getElementById("customerempty").style.display="block";
		  document.getElementById("customerempty").innerHTML="**Please fill all the fields";
		  return false;
	  }
  }
 </script>
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>


</body>

</html>
