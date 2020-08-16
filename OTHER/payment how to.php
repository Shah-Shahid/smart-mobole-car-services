
Step 1 :

At the click of payment button by customer on your website, create an order in your system and generate the required payload for payment request.
Parameters of payload are provided below (https://developer.paytm.com/docs/v1/payment-gateway/?utm_source=Business_Website)


Step 2:

/*Generate checksumhash using Paytm library with parameters in key value pairs. Using the payload and checksumhash make an HTML form post and redirect
customer to Paytm server. Code snippets and Github links for the checksum utility and HTML form post are provided below.*/
<?php
    require_once("encdec_paytm.php");
    define("merchantMid", "rxazcv89315285244163");
    // Key in your staging and production MID available in your dashboard
    define("merchantKey", "gKpu7IKaLSbkchFS");
    // Key in your staging and production merchant key available in your dashboard
    define("orderId", "order1");
    define("channelId", "WEB");
    define("custId", "cust123");
    define("mobileNo", "7777777777");
    define("email", "username@emailprovider.com");
    define("txnAmount", "100.12");
    define("website", "WEBSTAGING");
    // This is the staging value. Production value is available in your dashboard
    define("industryTypeId", "Retail");
    // This is the staging value. Production value is available in your dashboard
    define("callbackUrl", "https://<Merchant_Response_URL>");
    $paytmParams = array();
    $paytmParams["MID"] = merchantMid;
    $paytmParams["ORDER_ID"] = orderId;
    $paytmParams["CUST_ID"] = custId;
    $paytmParams["MOBILE_NO"] = mobileNo;
    $paytmParams["EMAIL"] = email;
    $paytmParams["CHANNEL_ID"] = channelId;
    $paytmParams["TXN_AMOUNT"] = txnAmount;
    $paytmParams["WEBSITE"] = website;
    $paytmParams["INDUSTRY_TYPE_ID"] = industryTypeId;
    $paytmParams["CALLBACK_URL"] = callbackUrl;
    $paytmChecksum = getChecksumFromArray($paytmParams, merchantKey);
    $transactionURL = "https://securegw-stage.paytm.in/theia/processTransaction";
    // $transactionURL = "https://securegw.paytm.in/theia/processTransaction"; // for production
?>
<html>
    <head>
        <title>Merchant Checkout Page</title>
    </head>
    <body>
        <center><h1>Please do not refresh this page...</h1></center>
        <form method='post' action='<?php echo $transactionURL; ?>' name='f1'>
            <?php
                foreach($paytmParams as $name => $value) {
                    echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
                }
            ?>
            <input type="hidden" name="CHECKSUMHASH" value="<?php echo $paytmChecksum ?>">
        </form>
        <script type="text/javascript">
            document.f1.submit();
        </script>
    </body>
</html>

Step 2:

//HTML FORM POST 
<html>
    <head>
        <title>Merchant Check Out Page</title>
    </head>
    <body>
        <center><h1>Please do not refresh this page...</h1></center>
        <form method="post" action="https://securegw-stage.paytm.in/theia/processTransaction?ORDER_ID=order1" name="f1">
            <table border="1">
                <tbody>
                    <input type="hidden" name="MID" value="rxazcv89315285244163">
                    <input type="hidden" name="WEBSITE" value="WEBSTAGING">
                    <input type="hidden" name="ORDER_ID" value="order1">
                    <input type="hidden" name="CUST_ID" value="cust123">
                    <input type="hidden" name="MOBILE_NO" value="7777777777">
                    <input type="hidden" name="EMAIL" value="username@emailprovider.com">
                    <input type="hidden" name="INDUSTRY_TYPE_ID" value="Retail">
                    <input type="hidden" name="CHANNEL_ID" value="WEB">
                    <input type="hidden" name="TXN_AMOUNT" value="100.12">
                    <input type="hidden" name="CALLBACK_URL" value="https://Merchant_Response_URL>">
                    <input type="hidden" name="CHECKSUMHASH" value="ZWdMJOr1yGiFh1nns2U8sDC9VzgUDHVnQpG
                    pVnHyrrPb6bthwro1Z8AREUKdUR/K46x3XvFs6Xv7EnoSOLZT29qbZJKXXvyEuEWQIJGkw=">
                </tbody>
            </table>
        <script type="text/javascript">
            document.f1.submit();
        </script>
        </form>
    </body>
</html>

Step 3:

Customer fills the payment details and is redirected to bank page for authorization. Once the transaction is authorized, Paytm receives the response from the
bank and returns a status to your website via your callback URL. Response attributes description and sample HTML form post is provided below
<html>
   <head>
     <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
     <title>Paytm Secure Online Payment Gateway</title>
   </head>
   <body>
      <table align='center'>
            <tr>
            <td><STRONG>Transaction is being processed,</STRONG></td>
            </tr>
            <tr>
            <td><font color='blue'>Please wait ...</font></td>
            </tr>
            <tr>
            <td>(Please do not press 'Refresh' or 'Back' button</td>
            </tr>
      </table>
      <FORM NAME='TESTFORM' ACTION='https://<Merchant_Response_URL>' METHOD='POST'>
            <input type='hidden' name='CURRENCY' value='INR'>
            <input type='hidden' name='CUST_ID' value='cust123'>
            <input type='hidden' name='GATEWAYNAME' value='WALLET'>
            <input type='hidden' name='RESPMSG' value='Txn Success'>
            <input type='hidden' name='BANKNAME' value='WALLET'>
            <input type='hidden' name='PAYMENTMODE' value='PPI'>
            <input type='hidden' name='MID' value='rxazcv89315285244163'>
            <input type='hidden' name='RESPCODE' value='01'>
            <input type='hidden' name='TXNID' value='20180821111212800110168085600021958'>
            <input type='hidden' name='TXNAMOUNT' value='100.12'>
            <input type='hidden' name='ORDERID' value='order1'>
            <input type='hidden' name='STATUS' value='TXN_SUCCESS'>
            <input type='hidden' name='BANKTXNID' value='5357590'>
            <input type='hidden' name='TXNDATE' value='2018-08-21 15:16:11.0'>
            <input type='hidden' name='CHECKSUMHASH'   value='YjtlLUVs6gQhR8RuUltwOsGnGXBg7gpdMRAKYU/ qiTZCeJZmwbciUFmwtT6RmwBmpwVswSiknJK7iEBch27q627uzTXKxJ0vzoMs68AE9A='>
      </FORM>
   </body>
 <script type="text/javascript">  document.forms[0].submit();</script>    
</html>


Step 4:

Checksumhash received in response of transaction needs to verified on merchant server using Paytm library with all the parameters in key value pairs. 
Code snippets and Github links for the checksum utility are provided below

<?php
    $paytmParams = $_POST;
    $merchantKey="gKpu7IKaLSbkchFS";
    $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
    $isValidChecksum = verifychecksum_e($paytmParams, $merchantKey, $paytmChecksum);
    if($isValidChecksum == "TRUE") {
        echo "<b>Checksum Matched</b>";
    } else {
        echo "<b>Checksum MisMatch</b>";
    }
?>

Step 5 :

Validate transaction response via server side request using Transaction Status API. This API requires checksumhash in request and its verification in response. The status should be treated as the final status of the transaction
On completion of your integration -

Post completion of integration on your staging environment, do a complete transaction from order summary page on your website or mobile app

    Attempt a test transaction using test paymodes credentials
    Ensure you re-verify transaction response with Transaction Status API via server to server call in payment flow and not separately as a one time activity
    See the transaction details in “Test Data” mode on your dashboard

Once the test transaction is complete, move your code to live environment with production account details. Note that production accounts details are available after you have activated your account on the dashboard

Lastly, it's recommended that you read about Managing Refunds and late payment notifications

In case of any issues with integration, please get in touch