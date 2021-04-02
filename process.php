<?php 
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
//Fetch Value from Form Submitted
// Parameters Accouring to Form Submitted at index.php -- Start
$custname=$_POST['CUST_NAME'];  
$custemail=$_POST['CUST_EMAIL'];
$custmobile=$_POST['CUST_MOBILE'];
$custaddressline1=$_POST['CUST_ADDRESS_LINE1'];
$custaddressline2=$_POST['CUST_ADDRESS_LINE2'];
$custaddresscity=$_POST['CUST_ADDRESS_CITY'];
$custaddressstate=$_POST['CUST_ADDRESS_STATE'];
$custaddresscountry=$_POST['CUST_ADDRESS_COUNTRY'];
$custaddresspostalcode=$_POST['CUST_ADDRESS_POSTAL_CODE'];
$orderid=$_POST['ORDER_ID'];
$ordervalue=$_POST['TXN_AMOUNT'];
// Parameters Accouring to Form Submitted at index.php -- End
//Fetch Value From KP Environment file
require_once 'kpenv/config.php';
$paramList = array();
$paramList["KP_ENVIRONMENT"] = KP_ENVIRONMENT; /// Set in kpenv/config.php file
$paramList["KPMID"] = KPMID; /// Set in kpenv/config.php file
$paramList["KPMIDKEY"] = KPMIDKEY; /// Set in kpenv/config.php file
$paramList["TXN_CURRENCY"] = TXN_CURRENCY;/// Set in kpenv/config.php file 
///Create Customer From API Pass Customer Parameters to https://pispp.kwikpaisa.com/API/v1/CreateCustomer
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://pispp.kwikpaisa.com/API/v1/CreateCustomer',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('KP_ENVIRONMENT' => $paramList["KP_ENVIRONMENT"],'KPMID' => $paramList["KPMID"],'KPMIDKEY' => $paramList["KPMIDKEY"],'CUST_NAME' => $custname,'CUST_EMAIL' => $custemail,'CUST_MOBILE' => $custmobile,'CUST_ADDRESS_LINE1' => $custaddressline1,'CUST_ADDRESS_LINE2' => $custaddressline2,'CUST_ADDRESS_CITY' => $custaddresscity,'CUST_ADDRESS_STATE' => $custaddressstate,'CUST_ADDRESS_COUNTRY' => $custaddresscountry,'CUST_ADDRESS_POSTAL_CODE' => $custaddresspostalcode),
));
$response = curl_exec($curl);
curl_close($curl);
$response;
//Make Variable of Customer ID Received From API Call
$customerId=json_decode(($response),true);
$customerIdvalue=$customerId["CUST_KP_ID"];

///Now Create Order ID and Payment Token By Passing Parameters To https://pispp.kwikpaisa.com/API/v1/Order
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://pispp.kwikpaisa.com/API/v1/Order',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('KP_ENVIRONMENT' => $paramList["KP_ENVIRONMENT"],'KPMID' => $paramList["KPMID"],'KPMIDKEY' => $paramList["KPMIDKEY"],'CUST_KP_ID' => $customerIdvalue,'TXN_CURRENCY' => $paramList["TXN_CURRENCY"],'TXN_AMOUNT' => $ordervalue,'ORDER_ID' => $orderid),
));
$response = curl_exec($curl);
curl_close($curl);
$response;
//Make Variable of Customer ID Received From API Call
$OrderDetails=json_decode(($response),true);
$KP_Txn_OrderID=$OrderDetails["KP_Txn_OrderID"];
$KP_Txn_Signature=$OrderDetails["KP_Txn_Signature"];
$KP_Txn_Token=$OrderDetails["KP_Txn_Token"];
?>
<title>Just Passing Main paramList to KP Gateway Log</title><body>
<center><h1>Please do not refresh and close this page/window...</h1></center>
<form id="paymentform" method="post" action="<?php echo KP_TXN_URL ?>" name="f1">
    <input type="hidden" name="KPMID" value="<?php echo KPMID ?>"/>
    <input type="hidden" name="CUST_KP_ID" value="<?php echo $customerIdvalue ?>"/>
    <input type="hidden" name="KP_Txn_OrderID" value="<?php echo $KP_Txn_OrderID ?>"/>
    <input type="hidden" name="KP_Txn_Signature" value="<?php echo $KP_Txn_Signature ?>"/>
    <input type="hidden" name="KP_Txn_Token" value="<?php echo $KP_Txn_Token ?>"/>
    <input type="hidden" name="KP_Return_URL" value="<?php echo CALLBACK_URL ?>"/>
    <script type="text/javascript">document.f1.submit();</script>
  </form>
