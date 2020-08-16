<?php
//session_start();
include("connection.php");
include("Functions.php");
include("sendmail.php");


// Registration for Dealer
if(isset($_POST['registerDealer']))
{
	//check if already registered
	$mail=mysqli_real_escape_string($con, $_POST['email']);
	$sql="SELECT * FROM login WHERE email='$mail'";
	$result=mysqli_query($con,$sql);
	$rowcount=mysqli_num_rows($result);
	if($rowcount==true)
	{
		$row=mysqli_fetch_assoc($result);
		$status=$row['status'];
		if($status==1)
		{$_SESSION['registered']="You are already Registered please click <a href='custlogin.php' class='alert-link'> HERE </a> to login";}
		else{$_SESSION['registered']="You have already applied, please wait for the approval or contact admin";}
		header("location:dealerregistration.php"); exit;
	
		
	}
	else
	{
		$fname=sanitize($con, $_POST['firstname']);
		$lname=sanitize($con, $_POST['lastname']);
		$contact=sanitize($con, $_POST['phone']);
		$email=sanitize($con, $_POST['email']);
		$address=sanitize($con, $_POST['address']);
		$workshop=sanitize($con, $_POST['workshop']);
		$district=sanitize($con, $_POST['district']);
		$pwd=sanitize($con, $_POST['password']);
		$lat=sanitize($con, $_POST['latitude']);
		$lon=sanitize($con, $_POST['longitude']);
	
	$password1=md5($pwd);
	
	$sql="INSERT INTO login(firstname, lastname, phone, email, address, workshop, district, password, lat, lon) VALUES ('$fname', '$lname', '$contact', '$email', '$address', '$workshop', '$district', '$password1', '$lat', '$lon')";
	if(!mysqli_query($con,$sql))
		{ die("Cannot Insert".mysqli_error() );}
	
		 // move_uploaded_file($_FILES["photo"]["tmp_name"],"Photos/".$_POST['phone'].".jpg");
		 // echo "<script> window.location.assign('DealerLogin.php?name=".$_POST['firstname']."'); </script>";
				$to = "shahid.sheikhpora@gmail.com";
				$subject = "New Dealer Request - ".$workshop;
				$message = "Please approve check the details and approve -- Address = ".$district." click here to approve: http://www.sheikhporaschool.org/smcs";
				$headers = "shahid.sheikhpora@gmail.com";
				sendmail($to,$subject,$message,$headers);		
			$_SESSION['name']=$fname." ".$lname."( Status= ".$_SESSION['mailstatus'].")";
			unset($_SESSION['mailstatus']);	
		  
		  header("location:index.php");
		  exit;
	}
				  
}
//Check Login Validation for Dealer, customer and Worker
	if(isset($_POST['login']))
	{
		$mail=sanitize($con, $_POST['email']);
		$pwd=sanitize($con, $_POST['password']);
		$pwd=md5($pwd);
		
		$dealer_result=mysqli_query($con, "SELECT * FROM login WHERE email='$mail' && password='$pwd' && status='1'");
		$customer_result=mysqli_query($con, "SELECT * FROM customerlogin WHERE email='$mail' && password='$pwd' && status='1'");
		$worker_result=mysqli_query($con, "SELECT * FROM workers WHERE email='$mail' && password='$_POST[password]'");
		
		$dealer_rowcount=mysqli_num_rows($dealer_result);
		$customer_rowcount=mysqli_num_rows($customer_result);
		$worker_rowcount=mysqli_num_rows($worker_result);
		
		if($dealer_rowcount==true)
		{
			$dealer_row=mysqli_fetch_assoc($dealer_result);
			$_SESSION['dealer']=$dealer_row['firstname'];
			$_SESSION['dealer_id']=$dealer_row['id'];
			header("location:Dealer.php"); exit;
		}
		elseif($customer_rowcount==true)
		{
			$customer_row=mysqli_fetch_assoc($customer_result);
			$_SESSION['user']=$customer_row['firstname'];
			$_SESSION['user_id']=$customer_row['id'];
			header("location:Customer.php"); exit;
		}
		elseif($worker_rowcount==true)
		{
			$worker_row=mysqli_fetch_assoc($worker_result);
			$_SESSION['worker']=$worker_row['firstname'];
			$_SESSION['worker_id']=$worker_row['id'];
			header("location:worker.php"); exit;
		}
		else
		{
			$_SESSION['invalidlogindetails']="**Incorrect login details";
			header("location:index.php"); exit;	  		
		}
		
	}
?>

<?php

// Registration for Customer
if(isset($_POST['registerCustomer']))
{
	//check if already registered
	$mail=sanitize($con, $_POST['email']);
	$sql="SELECT * FROM customerlogin WHERE email='$mail'";
	$result=mysqli_query($con,$sql);
	$rowcount=mysqli_num_rows($result);
	if($rowcount==true)
	{
		$row=mysqli_fetch_assoc($result);
		$status=$row['status'];
		if($status==1)
		{$_SESSION['registered']="You are already Registered please click <a href='custlogin.php' class='alert-link'> HERE </a> to login";}
		else{$_SESSION['registered']="You have already applied, please wait for the approval or contact admin";}
		header("location:index.php"); exit;
	
		
	}
	else
	{ 

		$fname=sanitize($con, $_POST['firstname']);
		
		$lname=sanitize($con, $_POST['lastname']);
		$contact=sanitize($con, $_POST['phone']);	
		$email=sanitize($con, $_POST['email']);		
		$address=sanitize($con, $_POST['address']);				
		$pwd=sanitize($con, $_POST['password']);		
		$password1=md5($pwd);
		
		$sql="INSERT INTO customerlogin(firstname, lastname, phone, email, address, password)  VALUES ('$fname', '$lname', '$contact', '$email', '$address', '$password1')";
		if(!mysqli_query($con,$sql))
			{ die("Cannot Insert".mysqli_error() );}
		//echo "<script> window.location.assign('CustLogin.php?name=".$_POST['firstname']."'); </script>";
		$_SESSION['name']=$fname." ".$lname;
		header("location:index.php");
		 exit;
	}
			
}


// Updation for Customer
if(isset($_POST['updateCustomer']))
{
		$id=sanitize($con, $_POST['id']);
		$fname=sanitize($con, $_POST['firstname']);
		$lname=sanitize($con, $_POST['lastname']);
		$contact=sanitize($con, $_POST['phone']);			
		$address=sanitize($con, $_POST['address']);
		$password=sanitize($con, $_POST['password']);
		$pwd=md5($password);
		
		$sql="SELECT password FROM customerlogin WHERE id='$id'";
		if(!($result=mysqli_query($con,$sql)))
			{ die("Cannot Insert".mysqli_error($con));}
		$row=mysqli_fetch_assoc($result);
		if($pwd==$row['password'])
		{		
			$sql="UPDATE customerlogin SET firstname='$fname', lastname='$lname', phone='$contact', address='$address' WHERE id='$id'";
			if(!mysqli_query($con,$sql))
				{ die("Cannot Insert".mysqli_error() );}
			$_SESSION['customerupdated']="<strong>".$fname."<strong>";
			header("location:Customer.php");
			 exit;	
		}
		else
		{
				$_SESSION['customernotupdated']="Your Password is not correct!  <a href='#'> Forget Password</a>";
			header("location:customerupdation.php?update=customer");	 exit;	
		}
}

// Change Customer Password
if(isset($_POST['changeUserPassword']))
{
	 $id=sanitize($con, $_POST['id']);
	 $sql="SELECT password FROM customerlogin WHERE customerlogin.id='$id'";
	 $result=mysqli_query($con, $sql);
	 $row=mysqli_fetch_assoc($result); 
		$old=sanitize($con, $_POST['oldpwd']);
		$new=sanitize($con, $_POST['newpwd']);
		$old=md5($old);
		$new=md5($new);
		$current=$row['password'];
		 if($old!=$current)
		{
			$_SESSION['customerpwdnotchanged']="Old Password is not correct !  ";
			header("location:customerupdation.php?user_pwd=change");		 exit;					
		}
		 else
		{ 
			$sql="UPDATE customerlogin SET customerlogin.password='$new' WHERE customerlogin.id='$id'";
			if(!mysqli_query($con, $sql))
				{ die("Cannot Insert".mysqli_error($con)); }
			$_SESSION['customerpwdchanged']="Your Password was Changed Successfully, Please login!";
			header("location:index.php");	 exit;
		} 
}

// Updation for Dealer
if(isset($_POST['updatedealer']))
{
		$id=sanitize($con, $_POST['id']);
		$fname=sanitize($con, $_POST['fname']);
		$lname=sanitize($con, $_POST['lname']);
		$contact=sanitize($con, $_POST['phone']);			
		$address=sanitize($con, $_POST['address']);
		$password=sanitize($con, $_POST['password']);
		$pwd=md5($password);
		
		$sql="SELECT password FROM login WHERE id='$id'";
		if(!($result=mysqli_query($con,$sql)))
			{ die("Cannot Insert".mysqli_error($con));}
		$row=mysqli_fetch_assoc($result);
		if($pwd==$row['password'])
		{
			$sql="UPDATE login SET firstname='$fname', lastname='$lname', phone='$contact', address='$address' WHERE id=$id && password='$pwd'";
			if(!mysqli_query($con,$sql))
				{ die("Cannot Insert".mysqli_error($con));}		
				$_SESSION['dealerupdated']=$fname." ".$lname;
				header("location:dealer.php");		 exit;	
		}	
		else
		{
			$_SESSION['dealerupdated']=$fname;
			header("location:dealerupdation.php?updateprofile=edit");	 exit;	
		}
}

// Change Dealer Password
if(isset($_POST['changeDealerPassword']))
{
	 $id=sanitize($con, $_POST['id']);
	 $sql="SELECT password FROM login WHERE id='$id'";
	 $result=mysqli_query($con, $sql);
	 $row=mysqli_fetch_assoc($result); 
		$old=sanitize($con, $_POST['oldpwd']);
		$new=sanitize($con, $_POST['newpwd']);
		$old=md5($old);
		$new=md5($new);
		$current=$row['password'];
		if($current==$old)
		{
			$sql="UPDATE login SET password='$new' WHERE id='$id'";
			if(!mysqli_query($con,$sql))
				{ die("Cannot Insert".mysqli_error($con) );}
			$_SESSION['pwdchanged']="Your Password was Changed Successfully, Please login!";
			header("location:index.php");	 exit;	
		}
		else
		{
				$_SESSION['pwdnotchanged']="Old Password is not correct !  ";
				header("location:dealerupdation.php?dealerpwd=change");		 exit;	
		}
}

// Updation for worker
if(isset($_POST['updateworker']))
{
		$id=sanitize($con, $_POST['id']);
		$fname=sanitize($con, $_POST['fname']);
		$lname=sanitize($con, $_POST['lname']);
		$contact=sanitize($con, $_POST['phone']);			
		$password=sanitize($con, $_POST['password']);
		//$pwd=md5($password);
		
		$sql="SELECT password FROM workers WHERE id='$id'";
		if(!($result=mysqli_query($con,$sql)))
			{ die("Cannot Insert".mysqli_error($con));}
		$row=mysqli_fetch_assoc($result);
		if($password==$row['password'])
		{
			$sql="UPDATE workers SET firstname='$fname', lastname='$lname', phone='$contact' WHERE id=$id && password='$password'";
			if(!mysqli_query($con,$sql))
				{ die("Cannot Insert".mysqli_error($con));}		
				$_SESSION['workerupdated']=$fname." ".$lname;
				header("location:worker.php");		 exit;	
		}	
		else
		{
			$_SESSION['workerupdated']=$fname;
			header("location:workerupdation.php?updateprofile=edit");	 exit;	
		}
}

// Change Worker Password
if(isset($_POST['changeWorkerPassword']))
{
	 $id=sanitize($con, $_POST['id']);
	 $sql="SELECT password FROM workers WHERE id='$id'";
	 $result=mysqli_query($con, $sql);
	 $row=mysqli_fetch_assoc($result); 
		$old=sanitize($con, $_POST['oldpwd']);
		$new=sanitize($con, $_POST['newpwd']);
		//$old=md5($old);
		//$new=md5($new);
		$current=$row['password'];
		if($current==$old)
		{
			$sql="UPDATE workers SET password='$new' WHERE id='$id'";
			if(!mysqli_query($con,$sql))
				{ die("Cannot Insert".mysqli_error($con) );}
			$_SESSION['pwdchanged']="Your Password was Changed Successfully, Please login!";
			header("location:index.php");	 exit;	
		}
		else
		{
				$_SESSION['pwdnotchanged']="Old Password is not correct !  ";
				header("location:workerupdation.php?workerpwd=change");		 exit;	
		}
}

?>