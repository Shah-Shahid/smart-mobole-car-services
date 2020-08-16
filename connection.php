<?php
$servername="localhost";
$username="root";
$password="";
$db_name="smcs";
$con=mysqli_connect($servername, $username, $password, $db_name); 
if(!$con) { die("Connection Error !".mysqli_error());	}



?>