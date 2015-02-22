<?php

include "PxPay_Curl.inc.php";

class CheckoutController extends Controller {

    private $PxPay_Url = "https://sec.paymentexpress.com/pxaccess/pxpay.aspx";
    private $PxPay_Userid = "webstudio_dev"; #Important! Update with your UserId
    private $PxPay_Key = "15027d94e4d1c4e03a1232b038d0204ddae3ba2b22466b5f3e4d513fd9dae615"; #Important! Update with your Key

    /**
     * Declares class-based actions.
     */

    public function actions() {
        
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $pxpay = new PxPay_Curl($PxPay_Url, $PxPay_Userid, $PxPay_Key);

        if (isset($_REQUEST["result"])) {
            # this is a redirection from the payments page.
            print_result();
        } elseif (isset($_REQUEST["Submit"])) {
            # this is a post back -- redirect to payments page.
            redirect_form();
        } else {
            # this is a fresh request -- display the purchase form.
            print_form();
        }
    }

    public function actionRead() {
        echo "readddddd";
    }

    public function actionCreate() {

        if (isset($_REQUEST["result"])) {
            # this is a redirection from the payments page.
            print_result();
        } elseif (isset($_REQUEST["Submit"])) {
            # this is a post back -- redirect to payments page.
            redirect_form();
        } else {
            # this is a fresh request -- display the purchase form.
            print_form();
        }
    }

    public function actionWriteImage() {
        $temp_request = $this->getClientPost();
        $request = $temp_request;
        $imageSrc = $this->getInputData($request['type'], $request['src']);
        $foldername = realpath(Yii::app()->basePath . '/../images');

        if (!file_exists($foldername)) {
            mkdir($foldername, 0777);
        }
        $extention = $this->getInputType($request['type']);
        file_put_contents($foldername . DIRECTORY_SEPARATOR . $request['imagename'] . $extention, $imageSrc);
        $ImageUrl = "http://" . $_SERVER['SERVER_NAME'] . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . $request['imagename'] . $extention;

        echo $ImageUrl;
    }

    private function getInputData($inputDataType, $inputData) {
        $tempInput = "";
        if ($inputDataType == "image/jpeg") {
            $tempInput = str_replace('data:image/jpeg;base64,', '', $inputData);
        } elseif ($inputDataType == "application/pdf") {
            $tempInput = str_replace('data:application/pdf;base64,', '', $inputData);
        } elseif ($inputDataType == "image/png") {
            $tempInput = str_replace('data:image/png;base64,', '', $inputData);
        } elseif ($inputDataType == "image/gif") {
            $tempInput = str_replace('data:image/gif;base64,', '', $inputData);
        }
        $data = base64_decode($tempInput);
        return $data;
    }

    private function getInputType($inputDataType) {
        $tempInput = "";
        if ($inputDataType == "image/jpeg") {
            $tempInput = ".jpg";
        } elseif ($inputDataType == "application/pdf") {
            $tempInput = ".pdf";
        } elseif ($inputDataType == "image/png") {
            $tempInput = ".png";
        } elseif ($inputDataType == "image/gif") {
            $tempInput = ".gif";
        }
        return $tempInput;
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        
    }

    public function print_result() {
        global $pxpay;
        $orderid = crulTest();
        $enc_hex = $_REQUEST["result"];
        #getResponse method in PxPay object returns PxPayResponse object
        #which encapsulates all the response data
        $rsp = $pxpay->getResponse($enc_hex);


        # the following are the fields available in the PxPayResponse object
        $Success = $rsp->getSuccess();   # =1 when request succeeds
        $AmountSettlement = $rsp->getAmountSettlement();
        $AuthCode = $rsp->getAuthCode();  # from bank
        $CardName = $rsp->getCardName();  # e.g. "Visa"
        $CardNumber = $rsp->getCardNumber(); # Truncated card number
        $DateExpiry = $rsp->getDateExpiry(); # in mmyy format
        $DpsBillingId = $rsp->getDpsBillingId();
        $BillingId = $rsp->getBillingId();
        $CardHolderName = $rsp->getCardHolderName();
        $DpsTxnRef = $rsp->getDpsTxnRef();
        $TxnType = $rsp->getTxnType();
        $TxnData1 = $rsp->getTxnData1();
        $TxnData2 = $rsp->getTxnData2();
        $TxnData3 = $rsp->getTxnData3();
//    $Boodk = $rsp->getTxnData4();
        $CurrencySettlement = $rsp->getCurrencySettlement();
        $ClientInfo = $rsp->getClientInfo(); # The IP address of the user who submitted the transaction
        $TxnId = $rsp->getTxnId();
        $CurrencyInput = $rsp->getCurrencyInput();
        $EmailAddress = $rsp->getEmailAddress();
        $MerchantReference = $rsp->getMerchantReference();
        $ResponseText = $rsp->getResponseText();
        $TxnMac = $rsp->getTxnMac(); # An indication as to the uniqueness of a card used in relation to others

        header("Location: http://api.localhost/order/getbook?bookid=" . $orderid);
        die();


        if ($rsp->getSuccess() == "1") {


            header('Location: http://staging.trendsideas.com', true, 'parameters');
            $result = "The transaction was approved.";
            # Sending invoices/updating order status within database etc.
            if (!isProcessed($TxnId)) {
                # Send emails, generate invoices, update order status etc.
            }
        } else {
            $result = "The transaction was declined.";
        }

        print <<<HTMLEOF
<html>
<head>
<title>Direct Payment Solutions PxPay transaction result</title>
</head>
<body>
<h1>Direct Payment Solutions PxPay transaction result</h1>
<p>$result</p>
  <table border=1>
	<tr><th>Name</th>				<th>Value</th> </tr>
	<tr><td>Success</td>			<td>$Success</td></tr>
	<tr><td>TxnType</td>			<td>$TxnType</td></tr>
	<tr><td>CurrencyInput</td>		<td>$CurrencyInput</td></tr>
	<tr><td>MerchantReference</td>	<td>$MerchantReference</td></tr>
	<tr><td>TxnData1</td>			<td>$TxnData1</td></tr>
	<tr><td>TxnData2</td>			<td>$TxnData2</td></tr>
	<tr><td>TxnData3</td>			<td>$TxnData3</td></tr>
	<tr><td>AuthCode</td>			<td>$AuthCode</td></tr>
	<tr><td>CardName</td>			<td>$CardName</td></tr>
	<tr><td>CardHolderName</td>		<td>$CardHolderName</td></tr>
	<tr><td>CardNumber</td>			<td>$CardNumber</td></tr>
	<tr><td>DateExpiry</td>			<td>$DateExpiry</td></tr>
	<tr><td>CardHolderName</td>		<td>$CardHolderName</td></tr>
	<tr><td>ClientInfo</td>			<td>$ClientInfo</td></tr>
	<tr><td>TxnId</td>				<td>$TxnId</td></tr>
	<tr><td>EmailAddress</td>		<td>$EmailAddress</td></tr>
	<tr><td>DpsTxnRef</td>			<td>$DpsTxnRef</td></tr>
	<tr><td>BillingId</td>			<td>$BillingId</td></tr>
	<tr><td>DpsBillingId</td>		<td>$DpsBillingId</td></tr>
	<tr><td>AmountSettlement</td>	<td>$AmountSettlement</td></tr>
	<tr><td>CurrencySettlement</td>	<td>$CurrencySettlement</td></tr>
	<tr><td>TxnMac</td>				<td>$TxnMac</td></tr>
	<tr><td>ResponseText</td>		<td>$ResponseText</td></tr>
</table>
</body>
</html>
HTMLEOF;
    }

#******************************************************************************
# Database lookup to check the status of the order or shopping cart
#******************************************************************************

    public function isProcessed($TxnId) {
        # Check database if order relating to TxnId has alread been processed
        return false;
    }

#******************************************************************************
# This function prints a blank purchase form.
#******************************************************************************
//function print_form() {
//    print <<<HTMLEOF
//<html>
//<head>
//<title>Direct Payment Solutions PxPay transaction sample</title>
//</head>
//<body>
//<h1>Direct Payment Solutions PxPay transaction result</h1>
//<p>
//You have indicated you would like to buy some widgets.
//</p>
//<p>
//Please enter the number of widgets below, and enter your
//shipping details.
//</p>
//<form method="post">
//<table>
//  <tr>
//    <td>Quantity:</td>
//    <td><input name="Quantity" type="text"/></td>
//    <td>@ $0.01 ea</td>
//  </tr>
//  <tr>
//    <td>Reference:</td>
//    <td><input name="Reference" type="text"/></td>
//  </tr>  
//  <tr>
//    <td>Ship to</td>
//    <td></td>
//  </tr>
//  <tr>
//    <td>Address line 1:</td>
//    <td><input name="Address1" type="text"/></td>
//  </tr>
//  <tr>
//    <td>Address line 2</td>
//    <td><input name="Address2" type="text"/></td>
//  </tr>
//    <tr>
//    <td>Address line 3</td>
//    <td><input name="Address3" type="text"/></td>
//  </tr>
//</table>
//<input name="Submit" type="submit" value="Submit"/>
//Click submit to go to the secure payment page.
//</form>
//</body>
//</html>
//HTMLEOF;
//}
#******************************************************************************
# This function formats data into a request and redirects to the
# Payments Page.
#******************************************************************************

    public function redirect_form() {
        global $pxpay;

        $request = new PxPayRequest();

        $http_host = getenv("HTTP_HOST");
        $request_uri = getenv("SCRIPT_NAME");
        $server_url = "http://$http_host";
        #$script_url  = "$server_url/$request_uri"; //using this code before PHP version 4.3.4
        #$script_url  = "$server_url$request_uri"; //Using this code after PHP version 4.3.4
        $script_url = (version_compare(PHP_VERSION, "4.3.4", ">=")) ? "$server_url$request_uri" : "$server_url/$request_uri";

        # the following variables are read from the form
        $Quantity = $_REQUEST["Quantity"];
        $MerchantReference = $_REQUEST["Reference"];
        $Address1 = $_REQUEST["Address1"];
        $Address2 = $_REQUEST["Address2"];
        $Address3 = $_REQUEST["Address3"];

        #Calculate AmountInput
        $AmountInput = 0.01 * $Quantity;

        #Generate a unique identifier for the transaction
        $TxnId = uniqid("ID");



        #Set PxPay properties
        $request->setMerchantReference($MerchantReference);
        $request->setAmountInput($AmountInput);
        $request->setTxnData1($Address1);
        $request->setTxnData2($Address2);
//    $array = array(
//        "firstName" => "John",
//        "lastName" => "Doe",
//    );
//    $request->setTxnData3(json_encode($array));
        $request->setTxnData3($Address3);
        $request->setTxnType("Purchase");
        $request->setCurrencyInput("NZD");
        $request->setEmailAddress("your_email@paymentexpress.com");
        $request->setUrlFail($script_url);   # can be a dedicated failure page
        $request->setUrlSuccess($script_url);   # can be a dedicated success page
        $request->setTxnId($TxnId);

        #The following properties are not used in this case
        # $request->setEnableAddBillCard($EnableAddBillCard);    
        # $request->setBillingId($BillingId);
        # $request->setOpt($Opt);
        #Call makeRequest function to obtain input XML
        $request_string = $pxpay->makeRequest($request);

        #Obtain output XML
        $response = new MifMessage($request_string);
        #Parse output XML
        $url = $response->get_element_text("URI");
        $valid = $response->get_attribute("valid");
        error_log($url);
        #Redirect to payment page
        header("Location: " . $url);
    }

    function crulTest() {
        $data = array("buyfromuser" => "23", "total" => "22", "note" => "test", "status" => 3);
        $data_string = json_encode($data);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://api.localhost/order/");

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//"buyfromuser":"0","total":"10","note":"test","status":0
// in real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));
// receive server response ...
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);
        $return = json_decode($server_output);
        return $return->orderid;
    }

}
