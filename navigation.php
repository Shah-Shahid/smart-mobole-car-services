

<!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#000">
    <div class="container">
      <a class="navbar-brand" href="index.php">SMCS </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar" >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav" style="margin-left:auto">  <!-- margin-left:auto to right align the menu aria-haspopup="true" aria-expanded="false"-->
          <li class="active"> <a class="nav-link" href="#">Home </a></li>
          <li> <a class="nav-link" href="about.php">About</a>       </li>
          <li> <a class="nav-link" href="services.php">Services</a> </li>
          <li> <a class="nav-link" href="contact.php">Contact</a>	</li>
		  <li> <a class="nav-link" href="admin/Admin.php">Admin</a>		</li>
		  <li> <a class="nav-link dropdown-toggle px-5"  style="box-shadow:2px 2px 2px 2px #888888;" href="#" id="ndd"  data-toggle="dropdown"  >User</a>
			<div class="dropdown-menu bg-dark"  style="position:absolute" aria-labelledby="ndd">
				 <a class="dropdown-item nav-link" href="#">Log Out </a>
				 <a class="dropdown-item nav-link" href="about.php">Change Password</a>       
				 <a class="dropdown-item nav-link" href="services.php">Edit Profile</a> 
			</div>	  
		  </li>
        </ul>
      </div>
    </div>
  </nav>