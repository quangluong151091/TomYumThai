
<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if(empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["message"])) {
		header('Location:contact.html');
	} else {
		$name = safe_input($_POST["name"]);	
		$email = safe_input($_POST["email"]);
		if (!preg_match("/^[a-zA-Z äö]*$/",$name) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header('Location:contact.html');
     	} else {
			$message = safe_input($_POST["message"]);	
			$subject = safe_input($_POST['subject']);
		 	send_feedback($name, $subject, $email, $message);
     	}
	}
		

}

function safe_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function send_feedback($name, $subject, $email, $message) {
		$to      = 'luongquang151091@gmail.com';
		$ip		 = $_SERVER["REMOTE_ADDR"];
		$content = "This is email from ";
		$content .= $name;
		$content .= " <";
		$content .= $email;
		$content .= ">:\n \n";
		$content .= $message;
		$content .= "\n \n";
		$content .= date("F j, Y, g:i a");


		$headers = 'From: '.$email."\r\n";

		mail($to, $subject, $message, $headers);


	$html = <<<EOT
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Email Sent...</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="2;url=contact.html" />
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
				<h1>Thanks for your message.</h1>
				<i class="fa fa-spinner fa-pulse"></i>
				<p></p>
				<p><em>You will be directed back to our page in a moment</em></p>
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


