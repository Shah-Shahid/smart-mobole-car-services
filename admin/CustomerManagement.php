<?php
session_start();
include("..\connection.php");

//If Admim has logged in else go to login page[see at bottom]
if(isset($_SESSION['admin_id']))
{
?>

<!-- PHP code to Approve New Customer Reguests  -->
<?php
if(isset($_GET['app']))
{
	$id=$_GET['app'];
	mysqli_query($con, "UPDATE customerLogin set status='1' WHERE id='$id'" );
	//echo "<script> window.location.assign('CustomerManagement.php'); </script>";
	$_SESSION['message']="Customer has been approved sucessfully !";
	$_SESSION["msg_type"]="success";
	header("location:CustomerManagement.php"); exit;
}
?>
<!-- PHP code to Dis Approve Registered Customers   -->
<?php
if(isset($_GET['dapp']))
{
	$id=$_GET['dapp'];
	mysqli_query($con, "UPDATE customerLogin set status='0' WHERE id='$id'" );
	//echo "<script> window.location.assign('CustomerManagement.php'); </script>";
	$_SESSION['message']="Customer disapproved was done !";
	$_SESSION["msg_type"]="warning";
	header("location:CustomerManagement.php"); exit;
}
?>
<!-- PHP code to Delete the Customers  approved or disapproved -->
<?php
if(isset($_GET['del']))
{
	$id=$_GET['del'];
	mysqli_query($con, "DELETE FROM customerLogin WHERE id='$id'" );
	//echo "<script> window.location.assign('CustomerManagement.php'); </script>";
	$_SESSION['message']="Customer has been deleted sucessfully !";
	$_SESSION["msg_type"]="danger";
	header("location:CustomerManagement.php"); exit;
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
        <div class="col-lg-12 col-xs-hidden">
          <h1 class="display-4 text-white mt-5" >Smart Mobile Car Services</h1> <!-- display-4 for large size -->
          <p class="lead mb-5 text-white-50">   <!--50=opacity -->SMCS is one of the features in the automobile industry that lets you find the right dealers 
											 from the application.	It brings cleaning service at your doorsteps and also saves your time and energy.</p>
        </div>
      </div>
    </div>
  </header>  

  <!-- Page Content -->
  
 <div class="container-fluid">
 <?php
 if(isset($_SESSION['message']))
 {
	 echo "<div class='alert alert-".$_SESSION['msg_type']."'>".$_SESSION['message']."</div>"; unset($_SESSION['message']);
 }
 ?>
 <div class="row">
      <div class="col-lg-12 mb-5">
	   <div  class="table-responsive"> <!--div for Table new Customers table-->
        <h3 class="bg-warning p-2">Manage New Customer Requests here</h3>
		<?php 
		  $result=mysqli_query($con, "SELECT * FROM customerlogin WHERE status='0'");
		  $rowcount=mysqli_num_rows($result);	
			if($rowcount==true)
			{
				echo "<table class='table table-striped table-hover'>";
						echo "<tr>";
							echo "<th> Customer Name</th>";
							echo "<th> Email</th>";
							echo "<th> Contact</th>";
							echo "<th> Address</th>";
							echo "<th> Action</th>";
							echo "<th> Delete</th>";
						echo "</tr>";
					
					
					while($row=mysqli_fetch_array($result))
					{
						echo "<tr>";
							echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
							echo "<td>".$row['email']."</td>";
							echo "<td>".$row['phone']."</td>";
							echo "<td>".$row['address']."</td>";
							?>
							 <td> <a class="btn btn-success" name="approve" href="CustomerManagement.php?app=<?php echo $row['id']; ?> "> APPROVE</a> </td>
							 <td> <a class="btn btn-danger" name="delete" href="CustomerManagement.php?del=<?php echo $row['id']; ?> "> DELETE</a> </td>
							 <?php
						echo "</tr>";						
					}
				echo "</table>";
			}
			else { echo "<div class='alert alert-info'> No Pending Requests Yet..!</div>"; }
		?>
		</div>
		<div class="table-responsive"> <!--div for Table Registered Customers table-->
        <h3 class="bg-success p-2">Manage Exixting Customers here</h3>
		<?php 
		  $result=mysqli_query($con, "SELECT * FROM customerlogin WHERE status='1'");
		  $rowcount=mysqli_num_rows($result);	
			if($rowcount==true)
			{
				echo "<table class='table table-striped table-hover '>";
						echo "<tr>";
							echo "<th> Customer Name</th>";
							echo "<th> Email</th>";
							echo "<th> Contact</th>";
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
							echo "<td>".$row['address']."</td>";
							?>
							 <td> <a class="btn btn-info" name="disApprove" href="CustomerManagement.php?dapp=<?php echo $row['id']; ?> "> Disapprove</a> </td>
							 <td> <a class="btn btn-danger" name="delete" href="CustomerManagement.php?del=<?php echo $row['id']; ?> "> DELETE</a> </td>
							 <?php
						echo "</tr>";						
					}
				echo "</table>";
			}
			else { echo "<div class='alert alert-info'> No Registered Customers Yet..!</div>"; }
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