<?php 
require_once 'php/core/init.php';

$main_content = false;

$category = new Category();
$category->fetchAll();
$category_data = $category->data();


$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  

$exploded_array = explode("/",$actual_link);
$array_size = sizeof($exploded_array);
$category_url = $exploded_array[$array_size-1];

$category = new Category();
$category_fetch = $category->findByUrl($category_url);

$products = null;
$output = '';

if($category_fetch){
    $current_category_data = $category->data();
	$category_id = $current_category_data->category_id;

	$product = new Product();
    $category_prod_fetch = $product->findProductsByCategory($category_id);

    if ($category_prod_fetch){
        $products = $product->data();
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>BenLee Hardware</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Colo Shop Template">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- font Awesome Cdn -->
	<script src="https://kit.fontawesome.com/e48d166edc.js" crossorigin="anonymous"></script>

	<!-- Bootstrap cdn -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>

	<!-- Owl Carousel File -->
	<link rel="stylesheet" type="text/css" href="../plugins/OwlCarousel2-2.2.1/owl.carousel.css">

	<!-- CSS File -->
	<link rel="stylesheet" type="text/css" href="../styles/style.css">

</head>

<body>

	<div class="super_container">

		<!-- Header -->
		<?php include 'header.php' ?>

		<?php include 'banner.php'?>
    
		

        <section class="category_search">
            <h4 class="content-title"><?php echo $current_category_data->category_name?></h4>
            <div class="product-list">
           
        <?php

        if ($products == null){

            $output .= "404";

        } else {

            foreach($products as $product){

                $output .= '
                <div class="product-item">
                    <a href="../product/'.$product->product_url.'">
                    <div class="product discount product_filter" id="'.$product->product_id.'">
                        <div class="product_image">
                            <img class="image" src="../'.$product->product_picture.'" alt="product">
                        </div>
                        <div class="favorite favorite_left"></div>
                            <div class="product_info">
                            <h6 class="product_name"><a href="../product/'.$product->product_url.'">'.$product->product_name.'</a></h6>';
    
                            $product_offer = $product->product_offer_price;
                            $product_price = $product->product_price;
    
                            if($product_offer !== "0" && $product_offer < $product_price){
    
                                $output .= '
                                <div class="product_price">Ksh '.$product->product_offer_price.'<span>Ksh '.$product->product_price.'</span></div>';
                                
                            } else {
                                $output .= '
                                <div class="product_price">Ksh '.$product->product_price.'</div>';
                            }
                        $output .= '</div>
                    </div>
                    <div class="red_button add_link add_to_cart_button" id="'.$product->product_id.'"><a href="#">Add to Cart</a></div>
                    </a>
                </div>';	  
    
            }
            
        }

        echo $output;
        ?>
			
            </div>
            </section>
		

        <?php include 'footer.php' ?>
	</div>

	<!-- jquery JS File -->
	<script src="../js/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap JS CDN -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
		integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
		crossorigin="anonymous"></script>

					
	<!-- Isotope JS File -->
	<script src="../plugins/Isotope/isotope.pkgd.min.js"></script>
	<!-- Owl Carousel JS File -->
	<script src="../plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<!-- Javascript File -->
	<script src="../js/custom.js"></script>

</body>

</html>



