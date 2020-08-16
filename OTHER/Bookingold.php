<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("connection.php");
//If User has logged in else go to login page[see at bottom]
if(isset($_SESSION['user_id']))
{
	//echo $_SESSION['user'];
	$id=$_SESSION['user_id'];
?>



<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Smart Mobile Car Services</title>
  <!-- Bootstrap core CSS -->
  <style>
  div.background{
	  background-color:#E0FFFF;
  }
  div.background:hover
  {
  opacity:0.5;
  }
  .sel
  {
	  
	  background-color:#E0FFFF;
	  border:none;
	 box-shadow:0 5px 25px rgba(0,0,0,.5);
	 -webkit-appearance:button;
	 outline:none;  
  }
  .sel:hover, active
  {
	  box-shadow:0 5px 25px rgba(0,0,0,.5);
	  border:none;
  }
  </style>
  <link rel="stylesheet" href="css/bootstrap.css">
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>

<body class="bg-light">

  <!-- Navigation -->
  <?php include("navigation.php");?>

  <!-- Header -->
  <header class="bg-primary py-5 mb-5">
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
  
 <div class="row">
	 <div class="col-md-12">
		 <p style="border:6px solid #000;float:right;border-radius:10px;background-color:#E0FFFF;color:white;font-weight:bold;font-size:20px"><span class="p-3 text-uppercase"><kbd><?php echo "  ".$_SESSION['user']."  "; ?></kbd></span>
		 <a onclick="<?php //unset($_SESSION['user']); ?>" href="custlogin.php" class="btn btn-dark" style="text-decoration:none;" >Log Out</a></p>
	 <div>
 </div>
 
<h1>Customer Booking Page</h1>
	<div class='container'>
			  
		  <?php
		  if(isset($_GET['wash_id']))
		  {
		  ?>
		  
		  <!-- HTML Code to select the Vehicle type for booking-->
		  <div class="row">
			<div class="col-md-12"><h4 class="bg-success p-2">Choose Vehicle Type</h4><hr></div>
		  </div>
		 <div class="row">
		  <?php
			$result=mysqli_query($con, "SELECT * FROM vehicletype");
			while($row=mysqli_fetch_array($result))
			{
		  ?>
		  
				<div class="col-md-3">
				<div class=" form-group embed-responsive background">
					<label for="<?php echo $row['category']; ?>">	
					<img class="img-responsive form-control h-50" src="<?php echo $row['image']; ?>">					
					<p class="lead text-white bg-dark"> <input type="radio" class="mx-4" name="vehicleType" value="<?php echo $row['category']; ?>" id="<?php echo $row['category']; ?>"> <?php echo $row['name']; ?>  </p>					
					</label>
				</div></div>
				 <?php   }  ?>			 
		</div>	 <!-- /.row --> 
			<a href="booking.php?next=<?php echo $id;?>" class="btn btn-info" style="float:right">Next</a>
		  
		  <?php }?>
		  <?php
		  if(isset($_GET['next']))
		  {
		  ?>
		  
		  <!-- HTML Code to select the Vehicle type for booking-->
		  <div class="row">
			<div class="col-md-12"><h4 class="bg-dark text-white p-2">Choose Wash Package</h4><hr></div>
		  </div>
		  <div class="row">
			  <?php
				$result=mysqli_query($con, "SELECT * FROM packages");
				while($row=mysqli_fetch_array($result))
				{
			  ?>
			<div class="col-md-3">
				<div class="card m-2">
					<div class="card-body"><h5><?php echo $row['name']; ?></h5><hr> <p class="lead text-primary font-weight-bold" style="font-size:28px">&#8377; <?php echo $row['amount']; ?> </p><hr>
						<p class="text-center"><?php echo $row['description']; ?></p>
					</div>
					<label for="<?php echo $row['id']; ?>">
					<div class="card-footer text-center"><input type="radio" name="package" value="<?php echo $row['id']; ?>" id="<?php echo $row['id']; ?>"></div>
					</label>
				</div>
								
			 </div>
			 <?php  }  ?>
		  </div>
		  <a href="booking.php?timing=<?php echo $id;?>" class="btn btn-success" style="float:right">Choose Time and Location</a>
		  <?php } ?>
		  
		  
		  <?php
		  if(isset($_GET['timing']))
		  {
		  ?>
		  
		  <!-- HTML Code to select the Time and location for booking-->
		  <div class="row">
			<div class="col-md-12"><h4 class="bg-success p-2">Choose Time and Location</h4><hr></div>
		  </div>
		  
		<div class="row my-3">
				<div class="col-md-8">
					
						
    
						<div class="form-group">							
							<div class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
								<input class="form-control" size="16" type="text" value="" readonly>
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							</div>
							<input type="hidden" id="dtp_input1" value="" /><br/>           
						</div>
						
            
						<span id="errdatetime" class="text-danger pl-3"></span>
				</div>
		</div>	<!-- ./row-->											
		<div class="row">
			<div class="col-md-6">
				
						<div ><h5>Select This</h5><hr> 
							<form method="post" action="">
							<select class="form-control" name="district" id="district" onchange="changeSecond();">
								<option value="">---Select District---</option>
								<option value="baramulla">Baramulla</option> <option value="srinagar">Srinagar</option> <option value="anantnag">Anantnag</option> 
								<option value="kulgam">Kulgam</option> <option value="pulwama">Pulwama</option> <option value="bandipora">Bandipora</option> 
								<option budgam>Budgam</option> <option value="ganderbal">Ganderbal</option> <option value="kupwara">Kupwara</option> 
								<option value="kargil">Kargil</option> <option value="leh">Leh</option> <option value="shopian">Shopian</option>
								
							</select>
						</div>	
							</form> 
							<h5>Choose Dealer</h5><hr> 
							<input type="hidden" id="lat" name="latitude">
							<input type="hidden" id="lon" name="longitude">
						    <div id="area">	</div>						
								
									
								
							
							
												
			</div>					
			<div class="col-md-6">
				
						<div ><h5>Location Map</h5><hr> 
						<select id="form-control">
								<?php		
								$result1=mysqli_query($con, "SELECT * FROM login");
								while($rows=mysqli_fetch_array($result1))
								{
								?>								
								<option value="<?php echo $rows['id'];?>"><?php echo $rows['workshop'];?> ----  <?php echo $rows['address']; ?></option>
								<?php  }  ?>
						</select>								
						</div>						
			</div>											
		</div>
		<a href="#" class="btn btn-info" style="float:right">Done</a>
		  <?php } ?>
	</div> <!-- /.container -->
  

  <!-- Footer -->
 <?php include("footer.php"); ?>

  <!-- Bootstrap core JavaScript -->
   
	

  <script>
 
  var bookDate;
  var today;
  var fromTime;
	function checkDate()
	{
		document.getElementById("errdate").innerHTML="";
		var dat=document.getElementById("date").value;
		var curdate=new Date();
			var dd=curdate.getDate();
			var mm=curdate.getMonth()+1;
			var yyyy=curdate.getFullYear();
				if(dd<10){dd='0'+dd;}
				if(mm<10){mm='0'+mm;}
			var today1=yyyy+'-'+mm+'-'+dd;
		if(dat < today1){document.getElementById("errdate").innerHTML="**Select Date Greater Than Today"; return false;}
		bookDate = dat;
		today = today1;
	}
	
	function checkFromTime()
	{
		document.getElementById("errfromhour").innerHTML="";
		var fromhour=document.getElementById("fromhour").value;
		var fromam_pm=document.getElementById("fromam_pm").value;
		var curdate=new Date();
			var fromhrs=parseInt(fromhour);
			if(fromam_pm=="PM"){fromhrs+=12;}
			if(fromhrs >= 21 && fromam_pm == "PM"){document.getElementById("errfromhour").innerHTML="<br>**Please Select working hours only too late"; return false;}
			if(fromhrs <= 6 && fromam_pm == "AM"){document.getElementById("errfromhour").innerHTML="<br>**Please Select working hours only too early"; return false;}
			var hour=curdate.getHours();
			if(fromhrs<=hour && fromam_pm != "null" && today == bookDate){document.getElementById("errfromhour").innerHTML="<br>**Past time not valid"; return false;}
			fromTime=fromhrs;
	}
	
	function checkToTime()
	{
		document.getElementById("errtohour").innerHTML="";
		var tohour=document.getElementById("tohour").value;
		var toam_pm=document.getElementById("toam_pm").value;
		var curdate=new Date();
			var tohrs=parseInt(tohour);
			if(toam_pm=="PM"){tohrs+=12;}
			if(tohrs >= 21 && toam_pm == "PM"){document.getElementById("errtohour").innerHTML="<br>**Please Select working hours only too late"; return false;}
			if(tohrs <= 6 && toam_pm == "AM"){document.getElementById("errtohour").innerHTML="<br>**Please Select working hours only too early"; return false;}
			var hour = curdate.getHours();
			if(tohrs <= fromTime && toam_pm != "null"){document.getElementById("errtohour").innerHTML="<br>**Past time not valid"; return false;}
	}
	
	
        function changeSecond()
		{
			var xmlhttp;
			
			
			
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
				{
				  if (xmlhttp.readyState==4 && xmlhttp.status==200)
						{						
						var res=xmlhttp.responseText;
						document.getElementById("area").innerHTML=res;
						}
				}
				
				//getLocation(); 
			  //get user geolocation and send his coordinates to find nearest dealers
				function showPosition(position) 
							{
								 document.getElementById("lat").value=position.coords.latitude; 
								 document.getElementById("lon").value=position.coords.longitude;
							 
							}
						function showError(error) 
							{
							  switch(error.code) 
							  {
									case error.PERMISSION_DENIED:
									  alert("You denied the request for Geolocation.");
									  break;
									case error.POSITION_UNAVAILABLE:
									  alert(" Your Location information is unavailable.");
									  break;
									case error.TIMEOUT:
									  alert("The request to get Your location timed out.");
									  break;
									case error.UNKNOWN_ERROR:
									  alert("An unknown error occurred.");
									  break;
							  }
							} 
						function getLocation() 
							{
							  if (navigator.geolocation) {	navigator.geolocation.getCurrentPosition(showPosition, showError);	  } 
							  else {	alert( "Geolocation is not supported by this browser.");	 }
							}

						
			
			  
			getLocation();
			latitude=document.getElementById("lat").value;
			longitude=document.getElementById("lon").value;
			console.log(latitude);	
			console.log(longitude);
			
			xmlhttp.open("GET","populate.php?lat="+latitude+"&lon="+longitude, true);
			xmlhttp.send();
        }
       
  </script>
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="other/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="other/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>

</body>

</html>

<?php
//If User has not logged in
}
else
{
	header("location:custlogin.php"); exit;
}
?>

