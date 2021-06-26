<?php
if(isset($_POST['contact'])){
	$to="contact@exampleurl.com"; // Change with your email address
$subject = "contact from event detail page";
if($_POST['name'])
 $name = $_POST['name'];
else
 $name = "Not Specified"; 
if($_POST['email'])
 $email = $_POST['email'];
else
 $email = "Not Specified"; 
if($_POST['message'])
 $message = $_POST['message'];
else
 $message = "Not Specified"; 


$msgg='<table width="100%" border="0" cellspacing="5" cellpadding="5">
			  <tr>
				<td width="50%" align="left" class="blacktext01">Full Name:</td>
				<td width="50%" align="left"><span class="blacktext01">'.$name.'</span></td>
			  </tr>
			  <tr>
				<td width="50%" align="left" class="blacktext01">Email Address: </td>
				<td width="50%" align="left"><span class="blacktext01">'.$email.'</span></td>
			  </tr>
			  <tr>
				<td width="50%" align="left" class="blacktext01">Subject: </td>
				<td width="50%" align="left"><span class="blacktext01">'.$subject.'</span></td>
			  </tr>
			  <tr>
				<td width="50%" align="left" class="blacktext01">Message: </td>
				<td width="50%" align="left"><span class="blacktext01">'.$message.'</span></td>
			  </tr>
	   </table>';

	   $message=$msgg;

        $headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "X-Mailer: php\n";
		$headers .="From:".$name."<".$email.">\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail($to, $subject, $message, $headers);	
}

if(isset($_POST['contactus'])){
	$to="contact@exampleurl.com"; // Change with your email address
$subject = "contact from contact us page";
if($_POST['name'])
 $name = $_POST['name'];
else
 $name = "Not Specified"; 
if($_POST['email'])
 $email = $_POST['email'];
else
 $email = "Not Specified"; 
if($_POST['message'])
 $message = $_POST['message'];
else
 $message = "Not Specified"; 


$msgg='<table width="100%" border="0" cellspacing="5" cellpadding="5">
			  <tr>
				<td width="50%" align="left" class="blacktext01">Full Name:</td>
				<td width="50%" align="left"><span class="blacktext01">'.$name.'</span></td>
			  </tr>
			  <tr>
				<td width="50%" align="left" class="blacktext01">Email Address: </td>
				<td width="50%" align="left"><span class="blacktext01">'.$email.'</span></td>
			  </tr>
			  <tr>
				<td width="50%" align="left" class="blacktext01">Subject: </td>
				<td width="50%" align="left"><span class="blacktext01">'.$subject.'</span></td>
			  </tr>
			  <tr>
				<td width="50%" align="left" class="blacktext01">Message: </td>
				<td width="50%" align="left"><span class="blacktext01">'.$message.'</span></td>
			  </tr>
	   </table>';

	   $message=$msgg;

        $headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "X-Mailer: php\n";
		$headers .="From:".$name."<".$email.">\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail($to, $subject, $message, $headers);	
}
if(isset($_POST['sendmessage'])){
	$to=$_POST['friend-email']; // Change with your email address
$subject = "BeEvent email to friend";
if($_POST['your-name'])
 $name = $_POST['your-name'];
else
 $name = "Not Specified"; 
if($_POST['your-email'])
 $email = $_POST['your-email'];
else
 $email = "Not Specified"; 
if($_POST['Message'])
 $message = $_POST['Message'];
else
 $message = "Not Specified"; 


$msgg='<table width="100%" border="0" cellspacing="5" cellpadding="5">
			  <tr>
				<td width="50%" align="left" class="blacktext01">Full Name:</td>
				<td width="50%" align="left"><span class="blacktext01">'.$name.'</span></td>
			  </tr>
			  <tr>
				<td width="50%" align="left" class="blacktext01">Email Address: </td>
				<td width="50%" align="left"><span class="blacktext01">'.$email.'</span></td>
			  </tr>
			  <tr>
				<td width="50%" align="left" class="blacktext01">Subject: </td>
				<td width="50%" align="left"><span class="blacktext01">'.$subject.'</span></td>
			  </tr>
			  <tr>
				<td width="50%" align="left" class="blacktext01">Message: </td>
				<td width="50%" align="left"><span class="blacktext01">'.$message.'</span></td>
			  </tr>
	   </table>';

	   $message=$msgg;

        $headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "X-MSMail-Priority: Normal\n";
		$headers .= "X-Mailer: php\n";
		$headers .="From:".$name."<".$email.">\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		mail($to, $subject, $message, $headers);	
}
?>