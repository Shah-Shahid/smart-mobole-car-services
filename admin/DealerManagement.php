<?php
//session_start();
include("..\connection.php");
include("..\sendmail.php");

//If Admim has logged in else go to login page[see at bottom]
if(isset($_SESSION['admin_id']))
{
?>


<!-- PHP code to Approve New Dealer Reguests  -->
<?php
if(isset($_GET['app']))
{
	$id=$_GET['app'];
	mysqli_query($con, "UPDATE login set status='1' WHERE id='$id'" );
	$result=mysqli_query($con, "SELECT email FROM login WHERE id='$id'");
	$dealer_mail=mysqli_fetch_assoc($result);
		$to = $dealer_mail['email'];
		$subject = "Welcome!! - Registration Approved!";
		$message = "Congrtulations you can now login and take benefit from Our services. Click here to login http://sheikhporaschool.org/smcs";
		$headers = "shahid.sheikhpora@gmail.com";
		sendmail($to,$subject,$message,$headers);		
	$_SESSION['message']="Dealer has been approved Successfully !".$_SESSION['mailstatus'];
	$_SESSION['msg_type']="success";
	unset($_SESSION['mailstatus']);
	header("location:DealerManagement.php"); exit;
}
?>
<!-- PHP code to Dis Approve Registered Dealers   -->
<?php
if(isset($_GET['dapp']))
{
	$id=$_GET['dapp'];
	mysqli_query($con, "UPDATE login set status='0' WHERE id='$id'" );
	//echo "<script> window.location.assign('DealerManagement.php'); </script>";
	$_SESSION['message']="Dealer disapproval was done !";
	$_SESSION['msg_type']="warning";
	header("location:DealerManagement.php"); exit;
}
?>
<!-- PHP code to Delete the Dealers  approved or disapproved -->
<?php
if(isset($_GET['del']))
{
	$id=$_GET['del'];
	mysqli_query($con, "DELETE FROM login WHERE id='$id'" );
	//echo "<script> window.location.assign('DealerManagement.php'); </script>";
	$_SESSION['message']="Dealer has been deleted Successfully !";
	$_SESSION['msg_type']="danger";
	header("location:DealerManagement.php"); exit;
}
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  
  
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="admin.php">Admin Home </a>
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
  <header class="bg-primary py-5 mb-2">
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
  
 <div class="container">
   <?php 
   if(isset($_SESSION['message'])) 
{  
	  echo "<div class='alert alert-".$_SESSION['msg_type']."'>".$_SESSION['message']."</div>";  unset($_SESSION['message']); unset($_SESSION['message']); 
	} 
	?>
	 <div class="row">
      <div class="col-lg-12 mb-5">
	    <div>   <!--div for Table new dealers table-->
        <h3 class="bg-warning p-2">Manage New Dealer Requests here</h3><hr>
		<?php 
		  $result=mysqli_query($con, "SELECT * FROM login WHERE status='0'");
		  $rowcount=mysqli_num_rows($result);	
			if($rowcount==true)
			{
				echo "<table class='table table-striped table-hover'>";							
						echo "<tr>";
							echo "<th> Dealer Name</th>";				
							echo "<th> Email</th>";
							echo "<th> Contact</th>";
							echo "<th> Workshop Name</th>";
							echo "<th> Location</th>";
							echo "<th> Action</th>";
							echo "<th> Delete</th>";
						echo "</tr>";
					
					
					while($row=mysqli_fetch_array($result))
					{
						echo "<tr>";
							echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
							echo "<td>".$row['email']."</td>";
							echo "<td>".$row['phone']."</td>";
							echo "<td>".$row['workshop']."</td>";
							echo "<td>".$row['address']."</td>";
							?>
							 <td> <a class="btn btn-success" name="approve" href="DealerManagement.php?app=<?php echo $row['id']; ?> "> APPROVE</a> </td>
							 <td><input type="hidden" value="<?php echo $row['id']; ?> " id="did"> <a class="btn btn-danger remove" name="delete" href="#"> DELETE</a> </td>
							 <?php
						echo "</tr>";						
					}
				echo "</table>";
			}
			else { echo "<div class='alert alert-info'> No Pending Requests Yet..!</div>"; }
		?>
		</div>
		<div> <!-- div for Table Registered dealers table-->
        <h3 class="bg-success p-2">Manage Existing Dealers here</h3><hr>
		<?php 
		  $result=mysqli_query($con, "SELECT * FROM login WHERE status='1'");
		  $rowcount=mysqli_num_rows($result);	
			if($rowcount==true)
			{
				echo "<table class='table table-striped table-hover'>";
						echo "<tr class='info'>";
							echo "<th> Dealer Name</th>";
							echo "<th> Email</th>";
							echo "<th> Contact</th>";
							echo "<th> Workshop Name</th>";
							echo "<th> Location</th>";
							echo "<th> Action</th>";
							echo "<th> Delete</th>";
						echo "</tr>";
					
					
					while($row=mysqli_fetch_array($result))
					{
						echo "<tr>";
							echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
							echo "<td>".$row['email']."</td>";
							echo "<td>".$row['phone']."</td>";
							echo "<td>".$row['workshop']."</td>";
							echo "<td>".$row['address']."</td>";
							?>
							 <td> <a class="btn btn-info" name="disapprove" href="DealerManagement.php?dapp=<?php echo $row['id']; ?> "> Dis Approve</a> </td>
							<td><input type="hidden" value="<?php echo $row['id']; ?> " id="did2"> <a class="btn btn-danger remove2" name="delete" href="#"> DELETE</a> </td>
							 <?php
						echo "</tr>";						
					}
				echo "</table>";
			}
			else { echo "<div class='alert alert-info'> No Dealers Registered Yet..!</div>"; }
		?>
		</div>
      </div>
    </div>
    <!-- /.row -->
   </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script>
  //code to show confirm dialog on delete on new requests
	  $(document).ready(function(){
		$(".remove").click(function(){
			var id=$("#did").val();
			if(confirm('Are you sure to delete this record?')){//alert("deleted");
				window.location.assign("DealerManagement.php?del="+id);
				return false;
			}
			return true;
		});
	}); 
	
	//code to show confirm dialog on delete on registered dealers
	$(document).ready(function(){
		$(".remove2").click(function(){
			var id=$("#did2").val();
			if(confirm('Are you sure to delete this record?')){
				window.location.assign("DealerManagement.php?del="+id);
				return false;
			}
			return true;
		});
	}); 
	</script> 
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