<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BeEvent - Conference & Event HTML Template</title>
</head>

<body>
<div class="wrapper">
<?php 
$RegularPass="185";
$BusinessPass="220";
$PremiumPass="285";

$fname=$_REQUEST['payer_fname'];
$email=$_REQUEST['payer_email'];
$planName = $_REQUEST['product_name'];
$SeatsQuantity = $_REQUEST['product_quantity'];
if($planName=='RegularPass'):
	$price = $RegularPass;
elseif($planName=='BusinessPass'):
	$price = $BusinessPass;
elseif($planName=='PremiumPass'):
	$price = $PremiumPass;
endif;
?>
<form action="paypal.php?sandbox=1" method="post" style="display:none;">
    <input type="hidden" name="action" value="process" />
    <input type="hidden" name="cmd" value="_cart" />
    <input type="hidden" name="currency_code" value="USD" />
    <input type="hidden" name="invoice" value="<?php echo date("His").rand(1234, 9632); ?>" />

    <input type="text" name="product_id" value="<?php echo rand(1111, 99999); ?>" />
    <input type="text" name="product_name" value="<?php echo $planName; ?>" />
    <input type="text" name="product_quantity" value="<?php echo $SeatsQuantity; ?>" />
    <input type="text" name="product_amount" value="<?php echo $price;?>" />
    <input type="text" name="payer_fname" value="<?php echo $fname; ?>" />
    <input type="text" name="payer_email" value="<?php echo $email;?>" />
    <input type="text" name="payer_lname" value="" />
    <input type="text" name="payer_address" value="" />
    <input type="text" name="payer_city" value="" />
    <input type="text" name="payer_state" value="" />
    <input type="text" name="payer_zip" value="" />
    <input type="text" name="payer_country" value="" />
    <input type="submit" name="submit" class="payple_btn" value="Submit" />
</form>
    
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
/*------------Payple Redirect btn------------*/
$(document).ready(function() {
$( function() {
    $('.payple_btn').click(function() {
        //alert('HI Devraj Solanki');
    });    
    setTimeout(function() {
        $('.payple_btn').trigger('click');
    }, 100);
	});	
});
</script>
</div>
</body>
</html>