<?php
 session_start();
 $uri = 'http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$back_url = explode ("paypal/", $uri);
 require_once("library.php");
/* Please change your details*/
$template_name = 'index.html'; // here add form page name
define('EMAIL_ADD', 'yourorderaccountemail@domainname.com'); // "Order Email"
define('PAYPAL_EMAIL_ADD', 'yourpaypalemail@paypal.com'); // "Paypal Email"
/************************************************/

require_once("paypal_class.php");
$p 				= new paypal_class(); // paypal class
$p->admin_mail 	= EMAIL_ADD; // set notification email
$action 		= $_REQUEST["action"];
switch($action){
case "process": 
	$_SESSION['payer_email'] = $_POST["payer_email"];
	$_SESSION['product_name'] = $_POST["product_name"];
	$_SESSION['product_quantity'] = $_POST["product_quantity"];
	$_SESSION['product_amount'] = $_POST["product_amount"];
	$_SESSION['invoice'] = $_POST["invoice"];
	$_SESSION['payer_fname'] = $_POST["payer_fname"];
	$_SESSION['payer_lname'] = $_POST["payer_lname"];

	$sql = "INSERT INTO purchases (invoice, product_id, product_name, product_quantity, product_amount, payer_fname, payer_lname, payer_address, payer_city, payer_state, payer_zip, payer_country, payer_email, payment_status, posted_date) VALUES ('".$_POST["invoice"]."', '".$_POST["product_id"]."', '".$_POST["product_name"]."', '".$_POST["product_quantity"]."', '".$_POST["product_amount"]."', '".$_POST["payer_fname"]."', '".$_POST["payer_lname"]."', '".$_POST["payer_address"]."', '".$_POST["payer_city"]."', '".$_POST["payer_state"]."', '".$_POST["payer_zip"]."', '".$_POST["payer_country"]."', '".$_POST["payer_email"]."', 'pending', NOW())";

$conn->query($sql);

		$this_script = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

		$p->add_field('business', PAYPAL_EMAIL_ADD); // Call the facilitator eaccount

		$p->add_field('cmd', $_POST["cmd"]); // cmd should be _cart for cart checkout

		$p->add_field('upload', '1');

		$p->add_field('return', $this_script.'?action=success'); // return URL after the transaction got over

		$p->add_field('cancel_return', $this_script.'?action=cancel'); // cancel URL if the trasaction was cancelled during half of the transaction

		$p->add_field('notify_url', $this_script.'?action=ipn'); // Notify URL which received IPN (Instant Payment Notification)

		$p->add_field('currency_code', $_POST["currency_code"]);

		$p->add_field('invoice', $_POST["invoice"]);

		$p->add_field('item_name_1', $_POST["product_name"]);

		$p->add_field('item_number_1', $_POST["product_id"]);

		$p->add_field('quantity_1', $_POST["product_quantity"]);

		$p->add_field('amount_1', $_POST["product_amount"]);

		$p->add_field('first_name', $_POST["payer_fname"]);

		$p->add_field('last_name', $_POST["payer_lname"]);

		$p->add_field('address1', $_POST["payer_address"]);

		$p->add_field('city', $_POST["payer_city"]);

		$p->add_field('state', $_POST["payer_state"]);

		$p->add_field('country', $_POST["payer_country"]);

		$p->add_field('zip', $_POST["payer_zip"]);

		$p->add_field('email', $_POST["payer_email"]);

		$p->submit_paypal_post(); // POST it to paypal

		$p->dump_fields(); // Show the posted values for a reference, comment this line before app goes live

	break;

	

	case "success": // success case to show the user payment got success

			//header("Location:http://".$_SERVER['SERVER_NAME']."/payment-success"); /* Redirect browser */
			$to      = $_SESSION['payer_email'];
$subject = 'Success Payment';
$message = "<h3> Thanks ". $_SESSION['payer_fname'] .$_SESSION['payer_lname'].",</h3> \r\n";
$message .= '<h2 align="center" style="background:#f00; color:#fff; padding:10px 4px; font-family:arial;">Your payment Successfully.</h2>'. "\r\n";
$message .= '<h4 align="center" style=" background:#000; padding:10px 4px; color:#fff;  font-family:arial;"> Your amout details'. "</h4>";
$message .= '<table align="left" width="700" cellspacing="12" border="1" style="font-family:arial">  <tr> <th> Your Invoice ID </th> <td>' .$_SESSION['invoice']. "</td> </tr>";
//$message .= 'your amout details'. "\r\n";
$message .= '<tr> <th>Plan </th><td>' .$_SESSION['product_name']. "</td></tr>";
$message .= '<tr> <th>Number Of Seats  </th><td>' .$_SESSION['product_quantity']. "</td></tr>";
$message .= '<tr> <th>Total Amount </th><td>' .$_SESSION['product_quantity']*$_SESSION['product_amount']. "</td></tr> </table>";
$headers = 'From:'. EMAIL_ADD . "\r\n" .
          "MIME-Version: 1.0" . "\r\n" . 
               "Content-type: text/html; charset=UTF-8" . "\r\n";

mail($to, $subject, $message, $headers);
	
	
	echo '<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BeEvent - Conference & Event HTML Template</title>
<link type="text/css" href="css/style.css"  rel="stylesheet" />
</head>
<body>
<div class="success_template">
<div class="logo"><a href=""> <img alt="" class="center-block" src="logo.png">  </a> </div>
<h2>Your payment Successfully. </h2>
<table class="success_table"> 
<tr> <td class="col-1">  Your Invoice ID</td> <td>'.$_SESSION['invoice'].' </td> </tr>
<tr> <td class="col-1">Plan </td> <td>' .$_SESSION['product_name'].'</td> </tr>
<tr> <td class="col-1">Number Of Seats  </td><td>' .$_SESSION['product_quantity'].'</td></tr> 
<tr><td class="col-1">Total Amount </td> <td>'.$_SESSION['product_quantity']*$_SESSION['product_amount'].' </td></tr>
</table>
<a href="'.$back_url['0'].$template_name.'" class="button"> Back To Home</a>
 </div>
 </body>
</html>';
 
			exit();

	//'http://'.$_SERVER['HTTP_HOST']

		//	header();payment-success

	break;

	

	case "cancel": // case cancel to show user the transaction was cancelled

	//	header("Location:http://".$_SERVER['SERVER_NAME']."/my-account"); /* Redirect browser */
	$to      = $_SESSION['payer_email'];
$subject = 'Cancel Payment';
$message = "<h3>Thanks ". $_SESSION['payer_fname'] .$_SESSION['payer_lname'].", </h3> \r\n";
$message .= '<h2 align="center" style="background:#f00; color:#fff; padding:10px 4px; font-family:arial;">Your payment transaction failed. </h2>'. "\r\n";
 $message .= '<h4 align="center" style="background:#000; color:#fff; padding:10px 4px; font-family:arial;">Please try again.</h4>';
$message .= '<table align="left" width="700" cellspacing="12" border="1" style="font-family:arial"> 
<tr> <th> Your Invoice ID</th> <td>' .$_SESSION['invoice']. "</td> </tr>";

 $message .= '<tr> <th>Plan</th><td>' .$_SESSION['product_name']. "</td> </tr>";
 $message .= '<tr> <th>Number Of Seats </th><td>' .$_SESSION['product_quantity']. "</td> </tr>";
 $message .= '<tr> <th>Total Amount </th><td>' .$_SESSION['product_quantity']*$_SESSION['product_amount']. "</td> </tr> </table>";
//$message .= '<h3">Please try again.</h3>';

$headers = 'From:'. EMAIL_ADD . "\r\n" .
          "MIME-Version: 1.0" . "\r\n" . 
               "Content-type: text/html; charset=UTF-8" . "\r\n";

mail($to, $subject, $message, $headers);

		//header("Location:http://".$_SERVER['SERVER_NAME']."/my-account"); /* Redirect browser */
 	
	echo '<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BeEvent - Conference & Event HTML Template</title>
<link type="text/css" href="css/style.css"  rel="stylesheet" />
</head>
<body>
<div class="success_template">
<div class="logo"><a href=""> <img alt="" class="center-block" src="logo.png">  </a> </div>
<h2>Your payment transaction failed. </h2>
<table class="success_table"> 
<tr> <td class="col-1"> Your Invoice ID</td> <td>'.$_SESSION['invoice'].' </td> </tr>
<tr> <td class="col-1"> Plan </td> <td>' .$_SESSION['product_name'].'</td> </tr>
<tr> <td class="col-1"> Number Of Seats  </td><td>' .$_SESSION['product_quantity'].'</td></tr> 
<tr><td class="col-1">Total Amount </td> <td>'.$_SESSION['product_quantity']*$_SESSION['product_amount'].' </td></tr>

</table>
<a href="'.$back_url['0'].$template_name.'" class="button">  Back To Home</a>
 </div></body>
</html>';

		exit();

	break;

	

	case "ipn": // IPN case to receive payment information. this case will not displayed in browser. This is server to server communication. PayPal will send the transactions each and every details to this case in secured POST menthod by server to server. 

		$trasaction_id  = $_POST["txn_id"];

		$payment_status = strtolower($_POST["payment_status"]);

		$invoice		= $_POST["invoice"];

		$log_array		= print_r($_POST, TRUE);

		$log_query		= "SELECT * FROM paypal_log WHERE txn_id = '".$trasaction_id."'";

		$log_check 		= $conn->query($log_query);

		if($log_check->num_rows  <= 0){

			$sql="INSERT INTO paypal_log (txn_id, log, posted_date) VALUES ('".$trasaction_id."', '".$log_array."', NOW())";

			$conn->query($sql);

		}else{

			$sql2 ="UPDATE paypal_log SET log = '".$log_array."' WHERE txn_id = '".$trasaction_id."'";

			$conn->query($sql2);

			//mysql_query("UPDATE `paypal_log` SET `log` = '$log_array' WHERE `txn_id` = '$trasaction_id'");

		} // Save and update the logs array

		

		if ($log_check->num_rows > 0) {

   		 // output data of each row

				while($row = $log_check->fetch_assoc()) {

					$paypal_log_id		= $row["id"];

				}

			}

		//$paypal_log_fetch 	= mysql_fetch_array(mysql_query($log_query));

		//$paypal_log_id		= $paypal_log_fetch["id"];

		if ($p->validate_ipn()){ // validate the IPN, do the others stuffs here as per your app logic

		$sql3 ="UPDATE purchases SET trasaction_id = '".$trasaction_id."', log_id = '".$paypal_log_id."', payment_status = '".$payment_status."' WHERE invoice = '".$invoice."'";

		$conn->query($sql3);

		

		//mysql_query("UPDATE `purchases` SET `trasaction_id` = '$trasaction_id ', `log_id` = '$paypal_log_id', `payment_status` = '$payment_status' WHERE `invoice` = '$invoice'");

			$subject = 'Instant Payment Notification - Recieved Payment';

			$p->send_report($subject); // Send the notification about the transaction

		}else{

			$subject = 'Instant Payment Notification - Payment Fail';

			$p->send_report($subject); // failed notification

		}

	break;

}

?>