<?php 
session_start();
if(empty($_SESSION["cart_products"])){
	header('Location:products.php');		
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Othello - Contact US</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
	<meta name="description" content="">

	<link rel="stylesheet" href="css/cart.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/et-line-font.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/contact.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Crimson+Text:400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Libre+Baskerville:italic' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" type='text/javascript'></script>
</head>
<body  data-target=".navbar-collapse" data-offset="50">


<!-- navigation section -->
<div class="navbar navbar-inverse navbar-fixed-top custom-navbar">
	<div class = "container">

		<a href = "homepage.html" class = "navbar-brand"><img src="images/logo.png"></a>
		<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
			<span class= "icon-bar"></span>
			<span class= "icon-bar"></span>
			<span class= "icon-bar"></span>
			<span class= "icon-bar"></span>
		</button>
		<div class="collapse navbar-collapse navHeaderCollapse">

			<ul class = "nav navbar-nav navbar-right">
			        <li><a href="homepage.html">WELCOME</a></li>
       				<li><a href="about.html">ABOUT</a></li>
        			<li><a href="products.php">PRODUCTS</a></li>
        			<li class="active_page"><a href="contact.html">CONTACT</a></li>
        	</ul>
	</div>
</div>
</div>

<!-- main section -->
<section id="main">
	<div class="container">
		<div class="row">

			<!-- left side -->
			<div class="col-md-6 col-sm-6 left-side">
				<br><br><br>
				<h2 style="text-align: center;">SUMMARY OF YOUR ORDER</h2>
				<div class="cart-view-table-back"> <!-- this is stupid, I try to push the table down, how to achieve the table in the middle-->
					<br>
	<?php
		$table = "<h5 style='text-align: center;'>Product from Othello</h5>";
		$table .= '<table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Name</th><th>Quantity</th><th>Your customized taste</th></tr></thead>';
		$table .= '<tbody>';

		$b = 0; //var for zebra stripe table 
		$othello_product = 0;

		foreach ($_SESSION["cart_products"] as $cart_itm){	//set variables to use in content below
			$product_name = $cart_itm["product_name"];
			$product_qty = $cart_itm["product_quantity"];
			$product_note = $cart_itm["product_note"];
			$product_code = $cart_itm["product_code"];		
			$customized_order = $cart_itm["customized_order"];
			if ($customized_order == 0) {
				$othello_product++;
			   	$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
			   	$table .=<<<EOT
			   	<tr class="$bg_color">
			   		<td>{$product_name}</td>
			   		<td>{$product_qty}</td>
			   		<td>$product_note}</td>		   	
			   	</tr>
EOT;
			}
		}
		$table .="</tbody></table>";
			// check if the first table has any content
			if ($othello_product == 0) {
				$table = "";
			} else {
				$table .= "<br><br>";
			}
			$table .= "<h5 style='text-align: center;'>Your order</h5>";
			$table .= '<table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Name</th><th>Quantity</th><th>Your customized taste</th></tr></thead>';
			$table .= '<tbody>';
		foreach ($_SESSION["cart_products"] as $cart_itm){	//set variables to use in content below
			$product_name = $cart_itm["product_name"];
			$product_qty = $cart_itm["product_quantity"];
			$product_note = $cart_itm["product_note"];
			$product_code = $cart_itm["product_code"];		
			$customized_order = $cart_itm["customized_order"];
			if ($customized_order == 1) {
			   	$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
			   	$table .=<<<EOT
			   	<tr class="$bg_color">
			   		<td>{$product_name}</td>
					<td>{$product_qty}</td>
			   		<td>{$product_note}</td>		   	
			   	</tr>
EOT;
			}
		}
	$table .="</tbody></table>";
	echo $table;	
	?>
				</div>				
			</div>

			<!-- right side -->
			<div class="col-md-6 col-sm-6 right-side">
			<br><br><br>
				<h2 style="text-align: center;">Your Information </h2><br>
				<form action="send_order.php" method="POST" class="wow fadeIn" data-wow-delay="0.2s">
					<div class="col-md-6 col-sm-6">
						<label for="name"><strong>Your name:</strong></label>
						<input type="text" class="form-control" placeholder="Your Name"  id="name" name="name" required />
					</div>
					<div class="col-md-6 col-sm-6">
						<label for="email"><strong>Your email:</strong></label>
						<input type="email" class="form-control" placeholder="Your Email" id="email" name="email" required />
					</div>
					<div class="col-md-12 col-sm-12">
						<label for="text-area"><strong>Your message:</strong></label>
						<textarea class="form-control" placeholder="If you want to order something, please let Othello know..." rows="7" id="text-area" name="message"></textarea>
					</div>
					<div class="col-md-offset-8 col-md-4 col-sm-offset-8 col-sm-4">
						<input type="submit" class="send-button" value="SEND">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>


<!-- footer section -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<ul class="copyright">
					<li>Copyright &copy; 2015</li>  
					<li>Design by BDDNQ team</li> 
				</ul>
				<i>Working best on Google Chrome</i>
			</div>
		</div>
	</div>
</footer>

<script src="js/jquery-lib.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
