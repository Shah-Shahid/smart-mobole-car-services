<!DOCTYPE html>
<?php
session_start();
include("../connection.php");
include("../Functions.php");

//If Admin has logged in else go to login page[see at bottom]
if(isset($_SESSION['admin_id']))
{
	//echo $_SESSION['user'];
	//$id=$_SESSION['user_id'];
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
  <?php include("../navigation.php");?>

  <!-- Header -->    
  <header class="py-1 " ><img class="img-responsive" src="../images/register-header.jpg" style="width:100%;opacity:0.7;">
    
  </header>   
  
  <!-- Insert if new vehicle is added -->
  
   <?php
  if(isset($_POST['addcar']))
  {
	  $name=sanitize($con, $_POST['name']);
	  $category=sanitize($con, $_POST['category']);
	  move_uploaded_file($_FILES["photo"]["tmp_name"],"../Images/".$_POST['category'].".jpg");
	  $img="Images/".$_POST['category'].".jpg";
	  
	 $sql="INSERT INTO vehicletype(category, image, name) VALUES('$category',  '$img', '$name')";
	 if(!mysqli_query($con,$sql)){ die("Cannot add".mysqli_error($con));  }
	 $_SESSION['car_added']="Vehicle Added Successfully!";
	 header('location:admin.php'); exit;
  }   
  ?> 
  
   <!-- Insert if new package is added -->
	<?php
	  if(isset($_POST['addpackage']))
	  {
		  $name=sanitize($con, $_POST['name']);
		  $carid=sanitize($con, $_POST['carid']);
		  $amount=sanitize($con, $_POST['amount']);
		  $description=sanitize($con, $_POST['description']);
		  
		 $sql="INSERT INTO packages(name,carid, amount, description) VALUES('$name',  '$carid', '$amount', '$description')";
		 if(!mysqli_query($con,$sql)){ die("Cannot add".mysqli_error($con));  }
		 $_SESSION['package_added']="New Package Added Successfully!";
		 header('location:admin.php'); exit;
	  }   
	  ?> 
 
 <!-- Page Content -->  
<div class="row" > 
 <div class="col-md-3 embed-responsive"><img class="img-responsive" src="../images/listing_img4.jpg" style="width:100%;opacity:0.7"></div>
  
   <!-- form to add new vehicle type -->
	<?php 
		if(isset($_GET['car']))
		{
	?>
	<div class="col-md-6 d-block m-auto " style="background-color:#E0FFFF;">
   <p class="lead  p-2" style="background-color:rgb(0,255,0,0.7);">Please New Car details here</p>
	<form action="update.php" method="post" enctype="multipart/form-data"  onsubmit="return validateForm()">
		 <div class="form-group" >
			<label for="name">Car Name:</label>  
			<input type="text" class="form-control" name="name" placeholder="Enter Car Name" id="name"> 
			<span id="carname" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="lname">Car Category:</label>
			<input type="text" class="form-control" name="category"  placeholder="Enter Category" id="category">
			<span id="carcategory"class="text-danger font-weight-bold" ></span>			
		 </div>
		 <div class="form-group">
			<label for="photo">Choose Photo (Only JPG < 5MB)</label>
			<input type="file" name="photo" class="form-control" id="photo" /> 
			<span id="carphoto"></span>
		 </div>
		  <div class="form-group text-center">
			<input type="submit" class="form-control btn btn-primary" name="addcar" value="Add Vehicle" style="width:100px">   
		 </div>
	</form>
    </div>   <!-- ./col -->
	<?php  }  ?>
	
	   <!-- form to add new Wash Package -->
	<?php 
		if(isset($_GET['package']))
		{
	?>
	<div class="col-md-6 d-block m-auto " style="background-color:#E0FFFF;">
   <p class="lead  p-2" style="background-color:rgb(0,255,0,0.7);">Please New package details here</p>
	<form action="update.php" method="post" enctype="multipart/form-data"  onsubmit="return validateForm()">
		 <div class="form-group" >
			<label for="name">New Package Name:</label>  
			<input type="text" class="form-control" name="name" placeholder="Enter Package Name" id="name"> 
			<span id="packagename" class="text-danger font-weight-bold"></span>
		 </div>
		 <div class="form-group">
			<label for="category">Package for:</label>
			<select id="category" class="form-control" name="carid">
				<?php		
					$result1=mysqli_query($con, "SELECT * FROM vehicletype");
					while($rows=mysqli_fetch_array($result1))
					{
					?>								
					<option value="<?php echo $rows['id'];?>"><?php echo $rows['name'];?></option>
				<?php  }  ?>
			</select>
			<span id="carcategory"class="text-danger font-weight-bold" ></span>			
		 </div>
		 <div class="form-group">
			<label for="cartype">Package Amount:</label>			
			<input type="text" class="form-control" name="amount"  placeholder="Enter amount" id="amount">			
			<span id="packageamount"class="text-danger font-weight-bold" ></span>			
		 </div>
		 <div class="form-group">
			<label for="description">Description:</label>
			<textarea name="description" id="description" class="form-control" rows="3" cols="50"></textarea>
			<span id="packagedescription"class="text-danger font-weight-bold" ></span>			
		 </div>
		 
		  <div class="form-group text-center">
			<input type="submit" class="form-control btn btn-primary" name="addpackage" value="Add Package" style="width:120px">   
		 </div>
	</form>
   </div>
	<?php  }  ?>
 <div class="col-md-3 embed-responsive"><img class="img-responsive" src="../images/facts_bg.jpg" style="width:100%;opacity:0.7"></div>
 
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
	header("location:admin.php"); exit;
}
?>