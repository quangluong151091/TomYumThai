<?php 
session_start();
include_once("config.php");
if(empty($_SESSION["cart_products"])){
		header('Location:products.php');		
	}
?>

 <!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>View shopping cart</title>
	<link href="css/cart.css" rel="stylesheet" type="text/css">
</head>
<body>
	<h1 align="center">Your Cart</h1>
	<div class="cart-view-table-back">
		<form method="post" action="cart_update.php">
	<?php
		$table = "<h2>Product from Othello</h2>";
		$table .= '<table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Name</th><th>Quantity</th><th>Your customized taste</th><th>Remove</th></tr></thead>';
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
			   		<td><input type="text" size="2" maxlength="2" name="product_qty[{$product_code}]" value="{$product_qty}" /></td>
			   		<td><input type="text" maxlength="200" name="product_note['{product_code}]" value="{$product_note}" /></td>		   	
			   		<td><input type="checkbox" name="remove_code[]" value="{$product_code}" /></td>
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
			$table .= '<h2>Your order</h2>';
			$table .= '<table width="100%"  cellpadding="6" cellspacing="0"><thead><tr><th>Name</th><th>Quantity</th><th>Your customized taste</th><th>Remove</th></tr></thead>';
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
					<td><input type="text" size="2" maxlength="2" name="product_qty[{$product_code}]" value="{$product_qty}" /></td>
			   		<td><input type="text" maxlength="200" name="product_note['{product_code}]" value="{$product_note}" /></td>		   	
			   		<td><input type="checkbox" name="remove_code[]" value="{$product_code}" /></td>
			   	</tr>
EOT;
			}
		}
	$table .='<tr><td colspan="5"><a href="products.php" class="button">Add More Items</a><button type="submit">Update</button><a href="check_out.php" class="button">Check out</a></td></tr>';
	$table .="</tbody></table>";
	echo $table;	
	?>
			<input type="hidden" name="return_url" value="<?php 
			$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); 
			echo $current_url; ?>" />
			<br>
		</form>
	</div>

</body>
</html>

