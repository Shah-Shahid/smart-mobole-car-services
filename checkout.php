<?php
session_start();
if(isset($_POST['paynow']))
{
	$book_id=$_POST['booking_id'];
	$customer_id=$_POST['Customer_id'];
	$phone=$_POST['mobile'];
	$amount=$_POST['amount'];
}
?>
<!DOCTYPE html>
<html>
	<head>
	    
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
		<meta name="author" content="">
		<title> SMCS Online Payment</title>
		<link rel="stylesheet" href="css/bootstrap.css">
	</head>
<body>
	<form method="post" action="Paytm/PaytmKit/pgRedirect.php">
		<div class="container">
		<div class="row">
		<div class="col-md-12">	
			<div class = "panel panel-success" id="container">
				<div class = "panel-heading">
					<h3 class = "panel-title bg-success p-2">Please proceed only if you agree to deduct the said amount</h3>
				</div>
					<div class = "panel-body">
						<table class="table table-responsive">   <!--All fields here are mandatory except phone-->
							<tbody>
	
								<tr>
									<td><label>ORDER_ID::*</label></td>
									<td><input id="ORDER_ID" tabindex="1" maxlength="12" size="12"
										name="ORDER_ID" autocomplete="off"
										value="<?php echo $book_id; ?>" readonly>
									</td>
								</tr>
								<tr>
									<td><label>CUSTID ::*</label></td>
									<td><input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" readonly value="<?php echo $customer_id; ?>"></td>
								</tr>
						
								<tr>
									<td><label>txnAmount*</label></td>
									<td><input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" size="12" readonly value="<?php echo $amount;?>"></td>															
								</tr>
								<tr>
									<td><label>phone</label></td>
									<td><input title="phone" tabindex="11" type="text" name="phone" value="<?php echo $phone;?>">	</td>
									
								</tr>
								</tbody>
							</table>
							<input type="hidden" id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail">
							<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
								
							<div class="form-group"><input class="btn btn-info px-5" value="Proceed to Pay" type="submit"	onclick=""></div>	
							</form>
					</div>
			</div>
		</div><!-- ./col -->
		</div><!-- ./row -->
		</div><!-- ./container -->
									
								
		



</body>
</html>