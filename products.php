<?php 
session_start();
include_once("config.php");
//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8" />
  <title>Othello - Products</title>
  <meta name="description" content="HTML5 Template" />
  <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="Othello Bakery Products" />
  <meta name="author" content=" " />

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/et-line-font.css">
  <link rel="stylesheet" href="css/main.css">
  <link type="text/css" rel="stylesheet" href="css/products.css" />
<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Crimson+Text:400italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Libre+Baskerville:italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" type='text/javascript'></script>

  <style type="text/css">
    .nav-tabs > li, .nav-pills > li {
      float:none;
      display:inline-block;
      *display:inline; /* ie7 fix */
      zoom:1; /* hasLayout ie7 trigger */
    }

    .nav-tabs, .nav-pills {
      text-align:center;
    }
    #demo {
      height: 100vh;
    } 
  </style>
</head>

<body data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

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
              <li class="active_page"><a href="homepage.html">WELCOME</a></li>
              <li><a href="about.html">ABOUT</a></li>
              <li><a href="products.php">PRODUCTS</a></li>
              <li><a href="contact.html">CONTACT</a></li>
              <?php  
              if (isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"]) > 0) {
                echo '<li><a href="view_cart.php" class="smoothScroll"><span class="glyphicon glyphicon-shopping-cart">_CART('.count($_SESSION["cart_products"]).')</span></a></li>';
              } else {
                echo '<li><a class="smoothScroll" style="pointer-event: none; cursor: refault;"><span class="glyphicon glyphicon-shopping-cart">_CART</span></a></li>';              
              }
              ?>       
          </ul>
  </div>
</div>
</div>


<!-- main section start-->
<div id="products" class="container-fluid" style="margin:-1.5%">

  <!-- zoom slider start-->
  <div id="demo" data-zs-src='["images/products/carousel/products_carousel_1.jpg", "images/products/carousel/products_carousel_2.jpg", "images/products/carousel/products_carousel_3.jpg","images/products/carousel/products_carousel_4.jpg"]'>
  </div>
  <!-- zoom slider end -->

  <!-- Item list start!-->
  <div class="container-fluid text-center">
    <ul id="itemListNav" class="nav nav-tabs">
          <?php 
          $query = "SELECT * FROM cake_categories ORDER BY category_id ASC";
          $category_table = $mysqli->query($query);
          if($category_table) {
            $category_list ="";
            while($cat_obj = $category_table->fetch_object()){

              if($cat_obj->category_id == 1){
                $category_list .= "<li class='active category'><a data-toggle='tab' href='#category".$cat_obj->category_id."'>".$cat_obj->category_name."</a></li>";
              } else {
                $category_list .= "<li class='category'><a data-toggle='tab' href='#category".$cat_obj->category_id."'>".$cat_obj->category_name."</a></li>";
              }
            }
          }
          $category_list .= "<li class='category'><a data-toggle='tab' href='#customized_order'>Make your own cake</a></li>";
          echo $category_list;
          ?>
    </ul>

    <!--Item tab content-->

    <div id="tab-content" class="tab-content">
      <?php
          $query = "SELECT * FROM cake_categories ORDER BY category_id ASC";
          $category_table = $mysqli->query($query);
        // div for each tab content 
          if($category_table) {
            $item_list = "";         
            while($cat_obj = $category_table->fetch_object()){
              // create the start of div for each category
              if($cat_obj->category_id == 1){
                $item_list .= "\r\n<div id='category1' class='row tab-pane fade in active' role='tab'>";
              } else {
                $item_list .= "\r\n<div id='category{$cat_obj->category_id}' class='row tab-pane fade' role='tab'>";
              }
              // print the content for each tab
              $query = "SELECT product_id, product_name, product_img_path FROM cake_products WHERE category_id = {$cat_obj->category_id} ORDER BY product_id ASC ";
              $results = $mysqli->query($query);
              if($results) {
                while($cake_obj = $results->fetch_object()){
                $item_list .= <<<EOT
                  
                  <div class="col-xs-4" data-toggle="modal" data-target="#{$cat_obj->category_id}_{$cake_obj->product_id}">
                    <img src="{$cake_obj->product_img_path}" alt="{$cake_obj->product_name}" width="100%"/>
                    <p>Product name: {$cake_obj->product_name}</p>
                  </div>
EOT;
                }          
              }
              $item_list .= "\r\n</div>";
            }
            $item_list .=<<<EOT
\r\n<div id='customized_order' class='row tab-pane fade' role='tab'> 
      <div class="col-md-12 col-sm-12">
        <h2 style="text-align: center;">Order your own cake </h2><br>
        <form action="cart_update.php" method="POST">
          <input type="hidden" name="customized_order" value="1" />
          <input type="hidden" name="type" value="add" />
          <input type="hidden" name="return_url" value="{$current_url}" />
          <div class="col-md-12 col-sm-12">
            <label for="product_name"><strong>Cake's name:</strong></label>
            <input type="text" class="form-control" placeholder="Name of your cake..."  id="product_name" name="product_name" required />
          </div>
          
          <div class="col-md-12 col-sm-12">
            <label for="product_quantity"><strong>Quantity:</strong></label>
            <input type="number" class="form-control" placeholder="Number of cake you want..."  id="product_quantity" name="product_quantity" required />
          </div>

          <div class="col-md-12 col-sm-12">
            <label for="product_note"><strong>Description of your cake</strong></label>
            <input type="text" class="form-control" placeholder="Please describe your cake" id="product_note" name="product_note" maxlength="400" required />
          </div>

          <div class="col-md-offset-8 col-md-4 col-sm-offset-8 col-sm-4">
            <input type="submit" class="send-button" value="Confirm">
          </div>
        </form>
      </div>
    </div> 
EOT;
            echo $item_list;
          } 
      ?>    
    </div>
  </div>
<!-- Item list end -->

<!-- Create modal for each Item list -->
<?php
          $query = "SELECT * FROM cake_categories ORDER BY category_id ASC";
          $category_table = $mysqli->query($query);
    if($category_table) {
      $item_modal = "";         
      while($cat_obj = $category_table->fetch_object()){
        $query = "SELECT product_id, product_name, product_img_path FROM cake_products WHERE category_id = {$cat_obj->category_id} ORDER BY product_id ASC ";
        $results = $mysqli->query($query);
        if($results) {
          while($cake_obj = $results->fetch_object()){
          $item_modal .= <<<EOT
<div class="modal fade" id="{$cat_obj->category_id}_{$cake_obj->product_id}" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content -->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{$cake_obj->product_name}</h4>
      </div>

      <div class="modal-body">
        <img src="{$cake_obj->product_img_path}" alt="{$cake_obj->product_name}" width="100%"/>
        <hr/>
        <form role="form" method="POST" action="cart_update.php">
          <input type="hidden" name="product_code" value="{$cat_obj->category_id}_{$cake_obj->product_id}" />
          <input type="hidden" name="customized_order" value="0" />
          <input type="hidden" name="type" value="add" />
          <input type="hidden" name="return_url" value="{$current_url}" />
          <input type="hidden" name="product_name" value="{$cake_obj->product_name}" />
          <div class="form-group">
            <label for="psw"><span class="glyphicon glyphicon-shopping-cart"></span> Quantity</label>
            <input type="number" class="form-control" id="psw" name="product_quantity" placeholder="How many?" />
            <label for="note"><span class="glyphicon glyphicon-pencil"></span> If you wish specific taste for for cake, please inform us</label>
            <input type="text" class="form-control" id="note" name="product_note" maxlength="200" placeholder="Tell me your taste" />
          </div>
          <button type="submit" class="btn btn-block">Confirm
            <span class="glyphicon glyphicon-ok"></span>
          </button>
        </form>
      </div>
    </div>      
  </div>
</div>
EOT;
          }          
        }
      }
      echo $item_modal;
    } 
?>    

</div>
<!-- Main section end -->
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
<script src="js/modernizr-2.6.2.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link href="css/zoomslider.css" rel="stylesheet">
<script src="js/jquery.zoomslider.min.js"></script>
<script src="js/jquery-lib.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/jquery.backstretch.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>

