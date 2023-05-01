<?php 
require_once 'php/core/init.php';

$main_content = false;

$category = new Category();
$category->fetchAll();
$category_data = $category->data();


$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  

$exploded_array = explode("/",$actual_link);
$array_size = sizeof($exploded_array);
$product_url = $exploded_array[$array_size-1];

$product = new Product();
$product_fetch = $product->searchProductByProductUrl($product_url);

$data = null;
$category_det_data = null;

if($product_fetch){
    $count = $product->count();
    $data = $product->data()[0];

	$category_id = $data->product_category;

	$category = new Category();
	
	$category_fetch = $category->find($category_id);
	$category_det_data = $category->data();
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

		<div class="product_container">
            <div class="container">

				<?php 
				if($data == null){
					?>
						404
					<?php
				} else {
					?>

					<div class="row">
                    <div class="col-md-6">
                    	<img class="modal-image" src="../<?php echo $data->product_picture?>" alt="product_1">
                    </div>
                    <div class="col-md-6 modal-details">
                    	<div class="modal-product-name"><?php echo $data->product_name ?></div>
                    	<div class="modal-product-category"> Category: <?php echo $category_det_data->category_name ?></div>
						<?php
						if($data->product_offer_price !== "0" && $data->product_offer_price < $data->product_price) { ?>
							
							<div class="modal-product-price">Ksh <?php echo $data->product_offer_price ?><span>Ksh <?php echo $data->product_price?></span></div>
						<?php         
						} else {
							?>
							<div class="modal-product-price">Ksh <?php echo $data->product_price ?></div>
							<?php
						}
						?>   
						<div class=" product-desc"><?php echo $data->product_description ?></div>  
						<div class="red_button product_button" ><a href="javascript:void(0);" onclick="addToCart(<?php echo $data->product_id?>)">Add to Cart</a></div>

                    </div>
                </div>

					<?php
				}
				?>
                           
            </div>
			
		</div>

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



