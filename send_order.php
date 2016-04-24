<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(empty($_POST["name"]) || empty($_POST["email"])) {
		header('Location:check_out.php');
	} else {
		$name = safe_input($_POST["name"]);	
		$email = safe_input($_POST["email"]);		
		if (!preg_match("/^[a-zA-Z äö]*$/",$name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header('Location:check_out.php');
     	} else {
			$message = safe_input($_POST["message"]);	
		 	send_order($name, $email, $message);
     	}
	}
		

}

function safe_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function send_order($name, $email, $message) {

	$recipient_1 = "innolight1001@gmail.com";
	$recipient_2 = $email;

	$subject = "Othello Order";
	$mail_header = "MIME-Version: 1.0\r\n";
	$mail_header .= "Content-type: text/html; charset=UTF-8\r\n";
	$mail_header .= "From: Othello bakery <nguyenhaidang@gmail.com> \n"; 
	$mail_header .= "Reply-To:".$email;

	// send email to Othello
	$msg = "<p><strong>Name:</strong>     ".$name."</p>";
	$msg .= "<p><strong>Email:</strong>   ".$email."</p>";
	$msg .= "<p><strong>Message:</strong> ".$message."</p>";
	$msg .= "<table style='border: 1px solid black;'><tr><th style='border: 1px solid black;'>Name</th><th style='border: 1px solid black;'>Quantity</th><th>Customer taste</th></tr>";

	foreach ($_SESSION["cart_products"] as $cart_itm) {
		$msg .= "<tr><td style='border: 1px solid black;'>"
		.$cart_itm["product_code"]."</td><td style='border: 1px solid black;'>"
		.$cart_itm["product_quantity"]."</td><td>"
		.$cart_itm["product_note"]."</td></tr>";
	}
	$msg .= "</table>";

		mail($recipient_1,$subject,$msg,$mail_header);

	// Send email to customer
	$msg = "<strong>Othello thanks ".$name." for buying our products</strong><br>Your order is summaried as follows";
	$msg .= "<table style='border: 1px solid black;'><tr><th style='border: 1px solid black;'>Name</th><th style='border: 1px solid black;'>Quantity</th><th>Customer taste</th></tr>";

	foreach ($_SESSION["cart_products"] as $cart_itm) {
		$msg .= "<tr><td style='border: 1px solid black;'>"
		.$cart_itm["product_code"]."</td><td style='border: 1px solid black;'>"
		.$cart_itm["product_quantity"]."</td><td>"
		.$cart_itm["product_note"]."</td></tr>";
	}
	$msg .= "</table>";
	$msg .= "<br> Othello will contact you for the price of your order and further discussion.";
		mail($recipient_2,$subject,$msg,$mail_header);
	session_destroy();

	$html = <<<EOT
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Email Sent...</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="2;url=http://www.cc.puv.fi/~e1500966/web-deve-projects/Othello/products.php" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/feedback.css">

	<link href='https://fonts.googleapis.com/css?family=Crimson+Text:400italic' rel='stylesheet' type='text/css'>
</head>
<body>
<section id="main">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h1>Thanks for buying our products.</h1>
				<i class="fa fa-spinner fa-pulse"></i>
				<p></p>
				<p><em>You will be directed back to our web site in a  moment</em></p>
			</div>
		</div>
	</div>
</section>
</body>
</html>	
EOT;
	echo $html;
	}
?>


