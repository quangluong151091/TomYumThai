<?php
		$to      = 'luongquang151091@gmail.com';
		$name	 = $_POST['name'];
		$email	 = $_POST['email'];
		$ip		 = $_SERVER["REMOTE_ADDR"];
		$subject = $_POST['subject'];
		$message = "This is email from ";
		$message .= $name;
		$message .= " <";
		$message .= $email;
		$message .= ">:\n \n";
		$message .= $_POST['message'];
		$message .= "\n \n";
		$message .= "\n";
		$message .= date("F j, Y, g:i a");


		$headers = 'From: '.$email."\r\n";

		mail($to, $subject, $message, $headers);
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Email Sent...</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="refresh" content="2;url=http://www.cc.puv.fi/~e1500949/TYT/contact.html" />
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
				<p><em>You will be back to my contact page in a moment</em></p>
			</div>
		</div>
	</div>
</section>
</body>
</html>
