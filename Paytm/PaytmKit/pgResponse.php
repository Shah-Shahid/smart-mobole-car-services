<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
require_once("../../connection.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		if(isset($_POST['ORDERID'], $_POST['TXNAMOUNT']))
		{
			$b_id=$_POST['ORDERID'];
			$transactionDetails=json_encode($paramList);
			$sql="UPDATE booking set payment='Paid Online',response='$transactionDetails' WHERE id='$b_id'";
			if(!mysqli_query($con, $sql)){	die("Payment Could Not be Updated".mysqli_error($con));	}
		echo"Payment Done amount ".$_POST['TXNAMOUNT']." Saved in Database";}
		
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	}
	else {
		if(isset($_POST['ORDERID'],$_POST['TXNAMOUNT']))
		{
			echo "<b>Transaction status is failure</b><br/><br>";
		}
	}

	if (isset($_POST) && count($_POST)>0 )
	{ 
		 /* foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
				
		} 
		$tr=json_encode($paramList);
		print_r($tr); */
		 if(isset($_POST['ORDERID'],$_POST['TXNAMOUNT']))
		{
			echo "<b>Transaction Amount ==</b>".$_POST['TXNAMOUNT']."<br/>";
			echo "<b>ORDER-ID == </b>".$_POST['ORDERID'];
		} 
	}
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>
<script>
var tr
</script>