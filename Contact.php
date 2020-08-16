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
   <!-- <link rel="stylesheet" href="css/services_style.css"> -->
  
</head>

<body style="background-color: #e2e2e2;">

  <!-- Navigation -->
  <?php include("navigation.php") ?>

  <!-- Header
  <header class="bg-primary py-5 mb-5">
    <div class="container ">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="display-4 text-white mt-5" >Smart Mobile Car Services</h1>
          <p class="lead mb-5 text-white-50">   SMCS is one of the features in the automobile industry that lets you find the right dealers 
											 from the application.	It brings cleaning service at your doorsteps and also saves your time and energy.</p>
        </div>
      </div>
    </div>
  </header>   -->

  <!-- Page Content <h1>Contact Information Here</h1>-->
  
 <div class="container">
	<div class="row m-5 pt-5">
		<div class="col-md-5">
				<div>
					<h2>CONTACT INFO</h2>
					<ul class="contact">
						<li>
							<p>
								<span class="home"></span> <strong><em> Car Wash</em> NIELIT, Rangreth Srinagar</strong>
							</p>
						</li>
						<li>
							<p class="phone">
								<abbr title="Phone">Phone:</abbr> (+91) 9797724745
							</p>
						</li>
						<li>
							<p class="fax">
								<abbr title="Fax">Fax:</abbr> (+91) 7006654570
							</p>
						</li>
						<li>
							<p class="mail">
								<abbr title="Email">Email:</abbr> shahid.sheikhpora@gmail.com
							</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-md-7">
				<h1 style="font-family:Helvatica" >CONTACT</h1>
				<h2 style="font-family:sans serif" class="text-muted">SEND US A QUICK MESSAGE</h2>
				<p class="lead">
					Reach us here:
				</p>
				<form action="conctact.php" method="post" class="form-horizontal">
					<div class="form-group">
						<label for="fname" class="control-label">First Name</label>
						<input type="text" reuired value="" class="form-control" name='f_name' id="fname">
					</div>
					<div class="form-group">
						<label for="lname" class="control-label">Last Name</label>
						<input type="text" reuired value="" class="form-control" id="lname" name='l_name'>
					</div>
					<div class="form-group">
						<label for="email" class="control-label">Email Address</label>
						<input type="text" reuired value="" id="email" class="form-control" name='e_address'>
					</div>
					<div class="form-group">
						<label for="msg" class="control-label">Message</label>
						<textarea name='msg' id="msg" class="form-control" reuired></textarea>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-dark" value="Send Message">
					</div>
				</form>
			</div>
		
	</div>
 </div> <!-- /.container -->

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