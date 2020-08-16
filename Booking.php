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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <title>Smart Mobile Car Services</title> 
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/rating_style.css">
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <!-- Bootstrap core CSS -->
  <style>
	  div.background{
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
</head>

<body class="bg-light" onload="getLocation();">

  <!-- Navigation -->
  <?php include("navigation.php");?>

  <!-- Header -->
  <header class="bg-primary py-5 mb-0 ">
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
		 <form method="POST" action="logout.php">
			 <p style="border:6px solid #000;float:right;border-radius:10px;background-color:#E0FFFF;color:white;font-weight:bold;font-size:20px"><span class="p-3 text-uppercase"><kbd><?php echo "  ".$_SESSION['user']."  "; ?></kbd></span>
			 <input type="submit" class="btn btn-dark"  value="Log Out" name="customer_logout"></form></p>
	</div>
 </div>
 
	<div class="container">
			  
		  <?php
		  if(isset($_GET['customer_id']))
		  {
		  ?>
		  
		  <!-- HTML Code to select the Vehicle type for booking-->
		  <div class="row">
		  <form action="booking.php" method="GET" name="frmbook1" onsubmit="return fill()">
		  <h3 style="text-shadow:5px 5px 5px #FF0000;">WASH YOUR CAR</h3>               
				<p>Select the service you require and choose either Car or Truck size of vehicle. Pick the available time slot that suits your schedule.
				Just share online your location and car details, we will confirm you soon for  car washing services at your doorstep.</p> 
				<p>Enter your information to confirm. Click here to return to the <a href="services.php">Services</a> page at any time.</p>	
			
			<div class="col-md-12"><h4 class="bg-success p-2">Choose Vehicle Type</h4>
			<span> <input type="submit" style="float:right" class="btn btn-info mb-2" style="float:right" value="Proceed"></span></div>
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
						<p class="lead text-white bg-dark"> <input type="radio" class="mx-4" name="vehicleType" value="<?php echo $row['id']; ?>" id="<?php echo $row['category']; ?>" onclick=""> <?php echo $row['name']; ?>  </p>					
						</label>
					</div>
					<span id="fillcar" class="text-danger font-weight-bold"></span>
				</div>
					 <?php   }  ?>
		 </div>	 <!-- /.row --> 
				<div class="row">
					 <input type="hidden" name="cust_id" value="<?php echo $_GET['customer_id']; ?>">					 
					 <input type="submit" class="btn btn-info" value="Proceed">
				</div>
				</form>	
							
		
			
		  
		  <?php }?>
		  <?php
		  if(isset($_GET['vehicleType']))
		  {
		  ?>
		  
		  <!-- HTML Code to select the Vehicle type for booking-->
		  <div class="row">		  
			<div class="col-md-12">
				<form action="booking.php" method="GET" name="frmbook2">
				<h4 class="bg-dark text-white p-2">Choose Wash Package</h4>
				<span><input type="submit" class="btn btn-info" style="float:right" value="Next"></span>
			</div>
		  </div>
		  <div class="row">
			  <?php
				$result=mysqli_query($con, "SELECT * FROM packages");
				while($row=mysqli_fetch_array($result))
				{
			  ?>
			<div class="col-md-3">
			
				<div class="card m-2">
					<div class="card-body"><h5><?php echo $row['name']; ?></h5><hr> <p class="lead text-primary font-weight-bold" style="font-size:28px">&#8377; <?php echo $row['amount']; ?> </p>
						<p class="text-center"><?php echo $row['description']; ?></p>
					</div>
					<label for="<?php echo $row['id']; ?>">
					<div class="card-footer text-center"><input type="radio" name="package" value="<?php echo $row['id']; ?>" id="<?php echo $row['id']; ?>"></div>
					</label>
					
				</div>	 
			</div>				
			 <?php  }  ?>
			 
		  </div>
		  <div class="row">
			  <input type="hidden" name="custom_id" value="<?php echo $_GET['cust_id']; ?>">
			  <input type="hidden" name="carid" value="<?php echo $_GET['vehicleType']; ?>">
			  <input type="submit" class="btn btn-info" value="Next" value="get selected value">
		  </div>
		  </form>
		  <?php } ?>
		  
		  
		  <?php
		  if(isset($_GET['package']))
		  {
		  ?>
		  
		  <!-- HTML Code to select the Time and location for booking-->
		  <div class="row">
			<div class="col-md-12">
			<p>Just share online your location and car details, we will confirm you soon for  car washing services at your doorstep.</p>
			<h4 class="bg-success p-1">Choose Time and Location</h4><hr></div>
		  </div>
		  
		<div class="row my-3">
					<div class="col-md-12">
						<p class="lead bg-light">Click to pick datetime: </p>						
							<div class="input-group date form_datetime col-md-6" data-date="2019-05-16T05:30:07Z" data-date-format="mm/dd/yyyy hh:ii" data-link-field="dtp_input1">
	<form method="POST" action="book.php">
								<input type="text" class="form-control sel" size="16" name="datetime" id="datetime" value="" readonly onchange="checkDate();">
								<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
								<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
							</div>											
						<div class="col-md-6"><span id="errdatetime" class="text-danger pl-3"></span></div>					
						<input type="hidden" id="dtp_input1" value="">
					</div>
		</div>	<!-- ./row-->											
		<div class="row">
			<div class="col-md-6">
				
						<div class="form-group"><h5>Select City You are In</h5><hr> 
							<select class="form-control" name="district" id="district" onchange="changeSecond();">
								<option value="">---Select Your City---</option>
								<option value="baramulla">Baramulla</option> <option value="srinagar">Srinagar</option> <option value="anantnag">Anantnag</option> 
								<option value="kulgam">Kulgam</option> <option value="pulwama">Pulwama</option> <option value="bandipora">Bandipora</option> 
								<option budgam>Budgam</option> <option value="ganderbal">Ganderbal</option> <option value="kupwara">Kupwara</option> 
								<option value="kargil">Kargil</option> <option value="leh">Leh</option> <option value="shopian">Shopian</option>
								
							</select>
						</div>	
						
						<div class="form-group">
							<label for="carnumber">Vehicle Number</label>
							<input type="text" id="carnumber" name="carnumber" class="form-control" placeholder="Your Vehicle Number here...">
							
						</div>
	
							<h5>Choose Dealer</h5><hr> 
							<input type="hidden" id="lat" name="latitude">
							<input type="hidden" id="lon" name="longitude">
						    <div>	
								<select class='form-control' name='dealer' id="area"><option value="">---Choose Dealer---</option></select>
								<span id="dealer_rate"></span>
							</div>
							<div class="forn-control">	
								<br><button class="btn btn-info btn-sm" data-target="#ShowDealerInfo" data-toggle="modal" id="dinfo">View Dealer Details</button>
								
							</div>							
								
									
								
							
							
												
			</div>					
			<div class="col-md-6">
				
						<div><h5>Location Map</h5><hr> 
							<div class="bg-primary" id="map" style="width:550px;height:350px">
								Loading Map...
								

							</div>							
						</div>						
			</div>											
		</div>
		
				  <input type="hidden" name="customer_id" value="<?php echo $_GET['custom_id']; ?>">
				  <input type="hidden" name="carid" value="<?php echo $_GET['carid']; ?>">
				  <input type="hidden" name="packageid" value="<?php echo $_GET['package']; ?>">
				  <input type="submit" class="btn btn-info" style="float:right" value="Book">
	</form>	
	
	
	<!-- Modal to Show Dealer Details on Customer Request data-backdrop="false" -->
	<div class="modal fade" id="ShowDealerInfo" role="dialog"  tabindex="-1">
		<div class="modal-dialog" >
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title">
						***
					</p>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
						
						<div id="fillDealer">
							
						</div>
						
				</div>
				<div class="modal-footer">
					<div class="form-group">
						
						<button type="button" class="btn btn-warning" data-target="#ShowDealerReview" data-toggle="modal" id="Allreviews">Show Reviews</button>
						<button class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal to Show Dealer All reviews on Customer Request  data-backdrop="false"-->
	<div class="modal fade" id="ShowDealerReview" role="dialog"  tabindex="-1" >
		<div class="modal-dialog" >
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title">Dealer rating And Reviews</p>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
						
						<div id="fillDealerReview">
							
						</div>
						
				</div>
				<div class="modal-footer">
					<div class="form-group">
						
						<button type="button" class="btn btn-warning" id="">FeedBack</button>
						<button class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
		  <?php } ?>
	</div> <!-- /.container -->
  
  
  
	

  <!-- Footer -->
 <?php include("footer.php"); ?>
 <script>
  //Show Personal details Of Dealer in Modal through Ajax call
	$(document).ready(function(){
	  $("#dinfo").on("click",function(){
		  var dealer = $("#area").children("option:selected").val();
		if(dealer==""){ alert("Please Select Some Dealer to show"); return false;}		
		else
		{	var xmlhttp; 		
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
					document.getElementById("fillDealer").innerHTML=res;
					}
			}		
		xmlhttp.open("GET","populate.php?dealerinfo="+dealer, true);
		xmlhttp.send();
		}
	  });
	});
  </script>
   <script>
  //Show Personal details Of Dealer in Modal through Ajax call
	$(document).ready(function(){
	  $("#area").on("change",function(){
		  var dealer_id = $("#area").children("option:selected").val();
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
					var res2=xmlhttp.responseText;
					document.getElementById("dealer_rate").innerHTML=res2;
					}
			}		
		xmlhttp.open("GET","populate.php?dealer_rating="+dealer_id, true);
		xmlhttp.send();		
	  });
	});
  </script>
  
  <script>
  //Show All Reviews of dealer and hide Profile details dealer Modal
	$(document).ready(function(){
	  $("#Allreviews").click(function(){
		  var d_id = $("#area").children("option:selected").val();
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
					var res3=xmlhttp.responseText;
					document.getElementById("fillDealerReview").innerHTML=res3;
					}
			}		
		xmlhttp.open("GET","populate.php?dealer_review="+d_id, true);
		xmlhttp.send();	
		  
	  });
	});
  
  </script>

  <!-- Bootstrap core JavaScript -->
   <script>
  function fill()
  {
	  var cartype=document.getElementById("vehicleType").value;
	  if(cartype="")
	  {
		  document.getElementById("fillcar").innerHTML="**Please Select Vehicle Type First"; 
		  return false;
	  }
  }
 
  var bookDate;
  var today;
  var bookd;
	function checkDate()
	{
		document.getElementById("errdatetime").innerHTML="";
		bookDate=document.getElementById("datetime").value;
		var curdate=new Date();
		//alert(bookDate);
		//alert(curdate);
		var bookday=bookDate.substring(0,2);
		var bookmonth=bookDate.substring(3,5);
		var bookyear=bookDate.substring(6,10);
		var bookhour=bookDate.substring(13,15);
		var bookminutes=bookDate.substring(16,18);
		var bookperiod=bookDate.substring(19,21);		
			var dd=curdate.getDate();
			var mm=curdate.getMonth()+1;
			var yyyy=curdate.getFullYear();
				if(dd<10){dd='0'+dd;}
				if(mm<10){mm='0'+mm;}
			var today1=yyyy+'-'+mm+'-'+dd;
			 bookd=bookyear+'-'+bookmonth+'-'+bookday;
			//alert(bookd);
			//alert(today1);
		if(bookd < today1){document.getElementById("errdatetime").innerHTML="**Select Date Greater Than Today"; return false;}
		today = today1;
		checkTime(bookhour,bookminutes,bookperiod);
	}
	
	function checkTime(h,m,period)
	{
		document.getElementById("errdatetime").innerHTML="";
		var hour=h;
		var minute=m;
		var period=period;
		var curdate=new Date();
		curminute=curdate.getMinutes();
			 hour=parseInt(hour);
			if(period=="pm"){hour+=12;}
			if(hour >= 21 && period == "pm"){document.getElementById("errdatetime").innerHTML="<br>**Please Select working hours only too late"; return false;}
			if(hour <= 6 && period == "am"){document.getElementById("errdatetime").innerHTML="<br>**Please Select working hours only too early"; return false;}
			var curhour=curdate.getHours();
			if(hour<curhour || minute<curminute && today == bookd){document.getElementById("errdatetime").innerHTML="<br>**Invalid Past Time"; return false;}
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
		  
		//getLocation();
		latitude=document.getElementById("lat").value;
		longitude=document.getElementById("lon").value;
		console.log(latitude);	
		console.log(longitude);
		
		xmlhttp.open("GET","populate.php?lat="+latitude+"&lon="+longitude, true);
		xmlhttp.send();
	}
  
</script>
								
 </body> 
 <script>
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
</script>
 <script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
 
 <script type="text/javascript">
		
		$('.form_datetime').datetimepicker({
       weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1,
    });
   
</script> 


<script>								
function loadMap()
{
	var l=document.getElementById("lat").value;
	var ln=document.getElementById("lon").value;
	console.log(l);
	// The location of Uluru
  var srinagar = {lat:33.778175, lng:76.57617139999999};

  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 10, center: srinagar});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: srinagar, map: map});
}

</script>
 
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0ZstPSwFqXVs-9ac6IJPE2YFtQjueUjE&callback=loadMap">
    </script>	  
	

</html>

<?php
//If User has not logged in AIzaSyDyelnf6euwpeLI7pdOj-FsazrdgzobZ_s
}
else
{
	header("location:index.php"); exit;
}
?>

