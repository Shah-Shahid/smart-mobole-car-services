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
  <?php require_once('Register.php'); ?>
</head>

<body background="images/bg-header.jpg" onload="getLocation()">

  <?php include("navigation.php");?>

  <!-- Header <div class="container ">  <div class="row">-->
  <header >
    
    
        <div class="col-lg-12 embed-responsive"> <img class="img-responsive" src="images/hr.jpg"  "> 
          <!--<h1 class="display-4 text-white mt-5" >Smart Mobile Car Services</h1>
          <p class="lead mb-5 text-white-50">  SMCS is one of the features in the automobile industry that lets you find the right dealers 
											 from the application.	It brings cleaning service at your doorsteps and also saves your time and energy.</p>-->
        </div>
      
    
  </header>  
  

  <!-- Page Content -->
  
   <?php
  if(isset($_SESSION['registered']))
  {
	  echo "<div class='alert alert-danger m-0'> <strong>**".$_SESSION['registered']."**</strong>";
	  echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
	  unset($_SESSION['registered']);
  }
  ?>
  
  
<div class="container"><div class="row"><div class="col-lg-12 px-0"><p class="lead mb-0 p-2" style="background-color:rgb(0,255,0,0.6);width:100%" >Please Enter the following details</p></div></div>
<div class="row " style="background-color:#E0FFFF" > 
 <div class="col-md-4 d-block m-auto pb-2">
  
	<form action="Register.php" method="post" enctype="multipart/form-data" style="background-color:#E0FFFF" onsubmit="return validateForm()">	
		 <div class="form-group">
			<label for="fname">First Name:</label>
			<input type="text" class="form-control" name="firstname" placeholder="Enter Firstname" id="fname">
			<span id="userfname" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="lname">Last Name:</label>
			<input type="text" class="form-control" name="lastname" placeholder="Enter Lastname" id="lname">  
			<span id="userlname"class="text-danger font-weight-bold" ></span>
		 </div>
		 <div class="form-group">
			<label for="phone">Phone:</label>
			<input type="phone" class="form-control" name="phone" placeholder="Enter Phone Number" id="phone"> 
			<span id="userphone" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="mail">Email:</label>
			<input type="email" class="form-control" name="email" placeholder="Enter Valid Email..." id="mail">
			<span id="usermail" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="address">Address/Tehsil:</label>
			<input type="text" class="form-control" name="address" placeholder="Enter Address and Tehsil" id="address">
			<span id="useraddress" class="text-danger font-weight-bold"></span>
		 </div>
		 
		 
 </div>
  <div class="col-md-4 d-block m-auto " style="background-color:#E0FFFF">
		 		 
		 <div class="form-group">
			<label for="workshop">Workshop Name:</label>
			<input type="text" class="form-control" name="workshop" placeholder="Enter Name of Work Station" id="workshop">
			<span id="userworkshop" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="district">Select Workshop District:</label>
			<select class="form-control" name="district" id="district">
				<option value="">---Select District---</option>
				<option value="baramulla">Baramulla</option> <option value="srinagar">Srinagar</option> <option value="anantnag">Anantnag</option> 
				<option value="kulgam">Kulgam</option> <option value="pulwama">Pulwama</option> <option value="bandipora">Bandipora</option> 
				<option budgam>Budgam</option> <option value="ganderbal">Ganderbal</option> <option value="kupwara">Kupwara</option> 
				<option value="kargil">Kargil</option> <option value="leh">Leh</option> <option value="shopian">Shopian</option>
			</select>
			<span id="userdistrict" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="pwd">Choose Password:</label>
			<input type="password" class="form-control" name="password" placeholder="Create Password" id="pwd">
			<span id="userpwd" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="pwd1">Confirm Password:</label>
			<input type="password" class="form-control" name="password1" placeholder="Confirm Password" id="pwd1">
			<span id="userpwd1" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="photo">Choose Photo (Only JPG < 5MB)</label>
			<input type="file" name="photo" class="form-control" id="photo" /> 
			<span id="userphoto"></span>
		 </div>
		 <input type="hidden" id="lat" name="latitude">
		 <input type="hidden" id="lon" name="longitude">    
 </div>

 <div class="col-md-4 embed-responsive" style="background-color:#E0FFFF"><img class="img-responsive" src="images/car-wash2.jpg" style="width:100%;opacity:0.7"></div>
 
		<div class="form-group  py-0 my-0" style="width:100%; background-color:#FFFACD">
			<input type="submit" class="form-control btn btn-primary my-2 mx-4" name="registerDealer" value="Register" style="width:250px">  
			<input type="reset" class="form-control btn btn-primary ml-4 mx-4" name="reset" value="Reset" style="width:250px">  
		</div> 
	</form>
</div> <!-- /.row -->
</div> <!-- /.container -->
  

  <!-- Footer -->
 <?php include("footer.php"); ?>

  
  <!--JavaScript validateForm() -->
  <script>
  
	  
	function getLocation() 
		{
		  if (navigator.geolocation) {	navigator.geolocation.getCurrentPosition(showPosition, showError);	  } 
		  else {	alert( "Geolocation is not supported by this browser.");	 }
		}

	function showPosition(position) 
		{
			var latitude=position.coords.latitude; 
			var longitude=position.coords.longitude;			
			document.getElementById("lat").value = latitude;  
		    document.getElementById("lon").value = longitude;
	    }
		function showError(error) 
		{
		  switch(error.code) 
		  {
				case error.PERMISSION_DENIED:
				  alert("User denied the request for Geolocation.");
				  break;
				case error.POSITION_UNAVAILABLE:
				  alert("Location information is unavailable.");
				  break;
				case error.TIMEOUT:
				  alert("The request to get user location timed out.");
				  break;
				case error.UNKNOWN_ERROR:
				  alert("An unknown error occurred.");
				  break;
		  }
		} 
  
  function validateForm()
  {
	  //getLocation(); //find coordinates and fill in hidden input fields
	  
	  
	  var firstname = document.getElementById("fname").value;
	  var lastname = document.getElementById("lname").value;
	  var mobile = document.getElementById("phone").value;
	  var email = document.getElementById("mail").value;
	  var password = document.getElementById("pwd").value;
	  var confirmPassword = document.getElementById("pwd1").value;
	  var address = document.getElementById("address").value;
	  var workshopName = document.getElementById("workshop").value;
	  var district = document.getElementById("district").value;
	  
	  //clear all span tags first
	  document.getElementById("userfname").innerHTML="";
	  document.getElementById("userlname").innerHTML="";
	  document.getElementById("userphone").innerHTML="";
	  document.getElementById("usermail").innerHTML="";
	  document.getElementById("userpwd").innerHTML="";
	  document.getElementById("userpwd1").innerHTML="";
	  document.getElementById("useraddress").innerHTML="";
	  document.getElementById("userworkshop").innerHTML="";
	  document.getElementById("userdistrict").innerHTML="";
	  
	  if(firstname=="")
	  {
		  document.getElementById("userfname").innerHTML="**Please fill this field"; 
		  return false;
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
	  
	  if(address=="")
	  {
		  document.getElementById("useraddress").innerHTML="**Please fill this field"; 
		  return false;
	  }
	  
	  if(address.length <3 || address.length > 40)
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
	  
	  if(workshopName=="")
	  {
		  document.getElementById("userworkshop").innerHTML="**Please fill this field"; 
		  return false;
	  }
	  
	  if(workshopName.length <=2 || workshopName.length > 30)
	  {
		  document.getElementById("userworkshop").innerHTML="**Workshop Name must be 3-30 characters"; 
		  return false;
	  }
	  
	  if(!isNaN(workshopName))
	  {
		  document.getElementById("userworkshop").innerHTML="**Please enter valid workshop name"; 
		  return false;
	  }
	  
	  //Check if any Special Character Is Filled
	  var splChars = "*|,\":<>[]{}`\';()@&$#%-+=";
		for (var i = 0; i < workshopName.length; i++)
			{
				if (splChars.indexOf(workshopName.charAt(i)) != -1)
				{
					document.getElementById("userworkshop").innerHTML="**Please dont fill special characters"; 
					return false;
				}
			}
	  
	  if(district=="")
	  {
		  document.getElementById("userdistrict").innerHTML="**Please Select District"; 
		  return false;
	  }
	  
	  
	  if(password=="")
	  {
		  document.getElementById("userpwd").innerHTML="**Please fill this field"; 
		  return false;
	  }
	  
	  if(password.length < 4 || password.length >8)
	  {
		  document.getElementById("userpwd").innerHTML="**Password must be 4-8 Characters"; 
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
	  
	  
	  
	  
	  
  }
  
  </script>
  <!-- Bootstrap core JavaScript -->
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>

</body>

</html>
