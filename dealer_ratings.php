<!DOCTYPE html>
<?php
session_start();
include("connection.php");
if(isset($_POST['rate']))
{

$dealer = $_POST['did'];
$customer = $_POST['cname'];
$comments = $_POST['comments'];
$ratings = $_POST['ratings'];


$res = mysqli_query($con, "insert into dealer_ratings(did, name, rating, comments) values('$dealer', '$customer', '$ratings', '$comments')");

    if($res)
    {
		$_SESSION['feedback']="Thank you Your feedback is saved, will be uploaded soon!";
		header("location:dealer_ratings.php?feedback=saved");
        //echo "Your feedback is saved";
    }
    else
    {
        echo " OOPs!! there is some error. Please check the fields";
    }

}
?>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<style>
			.rating 
			{
			  display: inline-block;
			  position: relative;
			  height: 50px;
			  line-height: 50px;
			  font-size: 50px;
			}

			.rating label {
			  position: absolute;
			  top: 0;
			  left: 0;
			  height: 100%;
			  cursor: pointer;
			}

			.rating label:last-child {
			  position: static;
			}

			.rating label:nth-child(1) {
			  z-index: 5;
			}

			.rating label:nth-child(2) {
			  z-index: 4;
			}

			.rating label:nth-child(3) {
			  z-index: 3;
			}

			.rating label:nth-child(4) {
			  z-index: 2;
			}

			.rating label:nth-child(5) {
			  z-index: 1;
			}

			.rating label input {
			  position: absolute;
			  top: 0;
			  left: 0;
			  opacity: 0;
			}

			.rating label .icon {
			  float: left;
			  color: transparent;
			}

			.rating label:last-child .icon {
			  color: #000;
			}		

			.rating:not(:hover) label input:checked ~ .icon,
			.rating:hover label:hover input ~ .icon {
			  color: #09f;
			}

			.rating label input:focus:not(:checked) ~ .icon:last-child {
			  color: #000;
			  text-shadow: 0 0 5px #09f;
			}
	</style>
	
</head>
</body>
<div class="container bg-light">
	<div class="row">
		<div class="col-md-12">
		<?php if(isset($_GET['rate_id']))
		{
			$did=$_GET['rate_id'];
			?>
			<form method="POST" action="dealer_ratings.php">
				<div>
					<span>Logo Here</span>
					<h1 class="display-4 bg-primary text-white p-3">Smart Mobile Car services</h1><hr>
				</div>
				<div>
					<?php
						$qry="SELECT workshop FROM login WHERE id=".$did;
						if(!$rslt=mysqli_query($con,$qry)){	die("Dealer Name Cannot be fetched ".mysqli_error($con));	}
						$row=mysqli_fetch_assoc($rslt);
					?>
					<h2 class=" text-primary">Dealer : <?php echo $row['workshop']; ?></h2>
					<h4 class="lead text-info">Thank You for Choosing us</h4>
					<p class="lead">Please give your feedback if my services are satisfactory</p>
					<div class="form-group">
						<label for="cname">Name</label>
						<input type="text" class="form-control" placeholder="Enter Your Name" name="cname" id="cname">
					</div>
					<div class="form-group">
						<p class="lead">Enter Your feedback</p><span id="counter">200 </span>
						<textarea class="form-control" name="comments" id="comments" cols="30" rows="3" maxlength="200" placeholder="[Optional]  Maximium 200 words..." ></textarea>
						
						<input type="hidden" name="ratings" value="1" id="rate">
						<input type="hidden" name="did" value="<?php echo $did ?>" id="dealer">
					</div>			
				</div>
				<!--  HTML Code for stars pasted from https://codepen.io/neilpomerleau/pen/wzxzQr with pure CSS-->
				<div class="rating">
					  <label>
							<input type="radio" name="stars" value="1" />
							<span class="icon">★</span>
					  </label>
					  <label>
							<input type="radio" name="stars" value="2" />
							<span class="icon">★</span>
							<span class="icon">★</span>
					  </label>
					  <label>
							<input type="radio" name="stars" value="3" />
							<span class="icon">★</span>
							<span class="icon">★</span>
							<span class="icon">★</span>   
					  </label>
					  <label>
							<input type="radio" name="stars" value="4" />
							<span class="icon">★</span>
							<span class="icon">★</span>
							<span class="icon">★</span>
							<span class="icon">★</span>
					  </label>
					  <label>
							<input type="radio" name="stars" value="5" />
							<span class="icon">★</span>
							<span class="icon">★</span>
							<span class="icon">★</span>
							<span class="icon">★</span>
							<span class="icon">★</span>
					  </label>
				</div>				
				<input type="submit" value="Submit Feedback" name="rate" class="btn btn-success px-3" style="margin-left:35%">				
			</form>
		<?php } ?>
		<?php
		if(isset($_GET['feedback']))
		{
		?>
		<div  style="margin-top:10%;margin-left:20%" class="text-success">
			<h2><?php	echo$_SESSION['feedback']; unset($_SESSION['feedback']);	?></h2>
		</div>
		<?php  }  ?>
        </div>	<!-- ./col -->
	</div>	<!-- ./row -->
</div>	<!-- ./container -->
<script>
		$(':radio').change(function() {
			console.log('New star rating: ' + this.value);
			$("#rate").val(this.value);
		});
		
		$('#comments').keyup(function(){   
			var len = $('#comments').val(); 
			if(len.length >=200){alert("You have entered maximium 200 characters!");}
			$('#counter').text(200-len.length);
			});
	
	</script>
  </body>
  </html>