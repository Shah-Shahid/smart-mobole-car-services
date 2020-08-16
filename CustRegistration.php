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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	
</head>

<body background="Images\car black.jpg" style="opacity:0.9" class="bdy">

  <!-- Navigation -->
  
 
  
    <div class="container ">
      <div class="row">
     
  
  <!-- Page Content -->
  
  <?php
  if(isset($_SESSION['registered']))
  {
	  echo "<div class='alert alert-danger m-0'> <strong>**".$_SESSION['registered']."**</strong>";
	  echo "<button class='close' data-dismiss='alert'>&times;</button></div>";
	  unset($_SESSION['registered']);
  }
  ?>

 
  

	
		<form action="Register.php" method="post" enctype="multipart/form-data" id="custregister" onsubmit="return validateForm()">
		
		 
<!-- Registration step 1 Modal to enter the Personal details  -->
	<div class="modal fade" id="CustomerRegister1" data-backdrop="false" data-keyboard="false" tabindex="-1" style=" background-color: rgba(0,0,0,0.6);">
		<div class="modal-dialog" >
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h4 class="modal-title">Enter login Details</h4>
					<button type="button" class="close" id="cancel">&times;</button>
				</div>
				<div class="modal-body">
					<p class="lead text-info"><small>Fields marked with <span class="text-danger">*</span> are necessary.</small></p>	
					<div class="form-group" >
						<label for="fname">First Name:<span class="text-danger">*</span></label>  
						<input type="text" class="form-control" name="firstname" placeholder="Enter Firstname" id="fname"> 
						<span id="userfname" class="text-danger font-weight-bold"></span>
					</div>
					<div class="form-group">
						<label for="lname">Last Name:<span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="lastname"  placeholder="Enter Lastname" id="lname">
						<span id="userlname"class="text-danger font-weight-bold" ></span>			
					</div>
					 
					<div class="form-group">
						<label for="dob">Select Date of Birth:</label>
						<input type="date" class="form-control" name="dob" id="dob">
						<span id="userdob"class="text-danger font-weight-bold" ></span>			
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="button" class="btn btn-primary" id="step2">Next</button>
						<button type="button" class="btn btn-info" id="cancel">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- Registration step 2 Modal to enter the login details  -->
	<div class="modal fade" id="CustomerRegister2" data-backdrop="false" tabindex="-1" style=" background-color: rgba(0,0,0,0.6);">
		<div class="modal-dialog" >
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Enter Your login Details</h4>
					<button type="button" class="close" id="cancel">&times;</button>
				</div>
				<div class="modal-body">
						
						<div class="form-group">
							<label for="mail">Email:<span class="text-danger">*</span></label>
							<input type="email" class="form-control" name="email" placeholder="Enter Valid Email..." id="mail">
							<span id="usermail" class="text-danger font-weight-bold"></span>
						</div>
						<div class="form-group">
							<label for="pwd">Choose Password:<span class="text-danger">*</span></label>
							<input type="password" class="form-control" name="password" placeholder="Create Password" id="pwd">
							<span id="userpwd" class="text-danger font-weight-bold"></span>			
						</div>
						<div class="form-group">
							<label for="pwd1">Confirm Password:<span class="text-danger">*</span></label>
							<input type="password" class="form-control" name="password1" placeholder="Confirm Password" id="pwd1"> 
							<span id="userpwd1" class="text-danger font-weight-bold"></span>			
						</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="button" class="btn btn-primary" id="backtostep1">Previous</button>
						<button type="button" class="btn btn-primary" id="step3">Next</button>
						<button type="button" class="btn btn-info" id="cancel">Cancel</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<!-- Registration step 3 Modal to enter the Contact details  -->
	<div class="modal fade" id="CustomerRegister3" data-backdrop="false" tabindex="-1" style="background-color: rgba(0,0,0,0.6);" >
		<div class="modal-dialog" >
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Contact Details</h4>
					<button type="button" class="close" id="cancel">&times;</button>
				</div>
				<div class="modal-body">
					<div id="customerempty" class="alert alert-warning" style="display:none"><button class="close" data-dismiss="alert">&times;</button></div>  <!-- Used in javascript to print msg if login fields are empty -->
						
						<div class="form-group">
							<label for="phone">Phone:<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" id="phone">
							<span id="userphone" class="text-danger font-weight-bold"></span>
						</div>	
						<div class="form-group">
							<label for="address">Address</label>
							<input type="text" class="form-control" name="address" placeholder="Enter Your Address" id="address">
							<span id="useraddress" class="text-danger font-weight-bold"></span>
						</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<button type="button" class="btn btn-primary" id="backtostep2">Previous</button>
						<input type="submit" class="form-control btn btn-primary" name="registerCustomer" value="Register" style="width:100px">
						<button type="button" class="btn btn-info" id="cancel">Cancel</button>						
					</div>
				</div>
			</div>
		</div>
	</div>
	 </form>
	
 </div><!--./row-->
</div><!-- /.container -->
  
  

  
  
  
 <!--JavaScript validateForm() -->
 <script>
  function validateForm()
  {	  
	  var mobile = document.getElementById("phone").value;	 
	  var address = document.getElementById("address").value;	  
	  //clear all span tags first  
	  document.getElementById("userphone").innerHTML="";
	  document.getElementById("useraddress").innerHTML="";  
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
	  if(address=="")
	  {
		  document.getElementById("useraddress").innerHTML="**Please fill this field"; 
		  return false;
	  }	  
	  if(address.length>=40 || address.length<=5)
	  {
		  document.getElementById("useraddress").innerHTML="**Address must be 5-40 characters"; 
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
  
 <script>
 //prevent form submission on enter key 
  $('#custregister').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
    if (keyCode === 13) { 
     e.preventDefault();
     return false;
		}
	});
 //Show Personal details Registration form on page load
	$(document).ready(function(){	  
		$("#CustomerRegister1").modal();	  
	});
	
//Validation for first Name on blur effect
	$(document).ready(function(){	  
		$("#fname").on("blur", function(){
			$('#userfname').text('');
			var first_name = $('#fname').val();	
			if (first_name.length < 1)	{	 $('#userfname').text('**Please Fill This Field');  return false;   }
			if (first_name.length < 3 || first_name.length > 20)	{	 $('#userfname').text('**First Name must be 3-20 characters');   return false;   }
			if(!isNaN(first_name)){$('#userfname').text('**Numbers are Not Allowed');   return false; }
			if(sp=filter(first_name)==0){$('#userfname').text('**Please dont fill special characters');   return false; }
		});			
	}); 

//Show Login details Registration form on button click and hide Personal details Registration form after validation
	$(document).ready(function(){
	  $("#step2").click(function(){
		  $('#userfname').text('');
		  $('#userlname').text('');
		  var first_name = $('#fname').val();
		  var last_name = $('#lname').val();
		 //Validation for first Name field
			if (first_name.length < 1)	{	 $('#userfname').text('**Please Fill This Field');  return false;   }
			else if(first_name.length < 3 || first_name.length > 20){$('#userfname').text('**First Name must be 3-20 characters');   return false; }
			else if(!isNaN(first_name)){$('#userfname').text('**Numbers are Not Allowed');   return false; }
			else if(sp=filter(first_name)==0){$('#userfname').text('**Please dont fill special characters');   return false; }
			
		//Validation for Secondt Name field
			else if (last_name.length < 1)	{	 $('#userlname').text('**Please Fill This Field');  return false;   }
			else if(last_name.length < 3 || last_name.length > 20){$('#userlname').text('**Last Name must be 3-20 characters');   return false; }
			else if(!isNaN(last_name)){$('#userlname').text('**Numbers are Not Allowed');   return false; }
			else if(sp=filter(last_name)==0){$('#userlname').text('**Please dont fill special characters');   return false; }
			
			else{	
			$("#CustomerRegister1").modal('hide');
			$("#CustomerRegister2").modal();}
	  });
	});
	
//Show Personal details Registration form on button click and hide Login details Registration form
	$(document).ready(function(){
	  $("#backtostep1").click(function(){
		$("#CustomerRegister2").modal('hide');
		$("#CustomerRegister1").modal();
	  });
	});
	
//Show Contact details Registration form on button click and hide Login details Registration form
	$(document).ready(function(){
	  $("#step3").click(function(){
		  $('#usermail').text('');
		  $('#userpwd').text('');
		  $('#userpwd1').text('');
		  var email = $('#mail').val();
		  var password = $('#pwd').val();
		  var password1 = $('#pwd1').val();
		 //Validation for email field
			if (email.length < 1)	{	 $('#usermail').text('**Please Fill This Field');  return false;   }
			//else if(first_name.length < 3 || first_name.length > 20){$('#userfname').text('**First Name must be 3-20 characters');   return false; }
			//else if(!isNaN(first_name)){$('#userfname').text('**Numbers are Not Allowed');   return false; }
			//else if(sp=filter(first_name)==0){$('#userfname').text('**Please dont fill special characters');   return false; }
			
		//Validation for password field
			else if (password.length < 1)	{	 $('#userpwd').text('**Please Fill This Field');  return false;   }
			else if(password.length < 4 || password.length > 8){$('#userpwd').text('**Password must be 4-8 Characters');   return false; }
			//else if(!isNaN(last_name)){$('#userlname').text('**Numbers are Not Allowed');   return false; }
			else if(sp=filter(password)==0){$('#userpwd').text('**Please dont fill special characters');   return false; }
			else if(password!=password1){$('#userpwd1').text('**Password and Confirm Password does not match');   return false; }
			else{	
			$("#CustomerRegister2").modal('hide');
			$("#CustomerRegister3").modal();}
	  });
	});
	
//Show Login details Registration form on button click and hide Contact details Registration form
	$(document).ready(function(){
	  $("#backtostep2").click(function(){
		$("#CustomerRegister3").modal('hide');
		$("#CustomerRegister2").modal();
	  });
	});

//close Registration form amd jump to index page	
	$(document).ready(function(){
	  $("[id='cancel']").click(function(){
		window.location.assign('index.php');
	  });
	});
	
</script>
<script>
function filter(str)
{
	var splChars = "*|,\":<>[]{}`\';()@&$#%-+=";
		for (var i = 0; i < str.length; i++)
			{
				if (splChars.indexOf(str.charAt(i)) != -1)
				{
					//document.getElementById("userlname").innerHTML="**Please dont fill special characters"; 
					return 0;
				}
			}
			return 1;
}
</script>

  <!-- Bootstrap core JavaScript -->
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
 
</body>

</html>