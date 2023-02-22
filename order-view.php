<?php
include_once 'php/core/init.php';

$error = false;
$first_name = '';
$last_name = '';
$phone_number = '';
$email = '';
$shipping_address = '';
$company_name = '';
$order_id = '';
$is_complete = '';

if(Input::exists('get')){

    $order_id = Input::get('order_id');
   
    $output = "";
    if($order_id != ''){
        $order = new Order();

        if($group = $order->find($order_id)){
            $data = $order->data();

            $products_string = $data->products;
            $first_name = $data->first_name;
            $last_name = $data->last_name;
            $company_name = $data->company_name;
            $email = $data->email;
            $phone_number = $data->phone_number;
            $shipping_address = $data->address;
            $is_complete = $data->is_complete;

            $products_array = explode(";", $products_string);

        } else {
            $error = true;
            echo 'error';
        }
           
    } else {
        $error = true;
        
    }

} else {
    $error = true;
    echo 'error 1';
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
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">

	<!-- CSS File -->
	<link rel="stylesheet" type="text/css" href="styles/style.css">

</head>

<body>

	<div class="super_container">

		<!-- Header -->
		<header class="header trans_300" style="height: 80px;">

			<!-- main Navigation -->
			<div class="main_nav_container">
				<div class="logo_container">
					<a href="/benlee">BenLee <span>Hardware</span></a>
				</div>
			</div>	
		</header>

		<!-- product modal -->
		<div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			aria-labelledby="productModal" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-body modal-product"></div>
					
				</div>
			</div>
		</div>

        <section class="order-content container">

            <div class="message">
				
			</div>

            <?php

                if(!$error){
                    ?>


                    <div class="customer-details">

                    <h4>Order Details</h4>
                    <div class="row">
                                <div class="col-sm-6">
                                    <div class="modal-margin-top" >
                                        <label for="exampleFormControlInput1" class="form-label">First Name*</label>
                                        <input disabled readonly value="<?php echo $first_name?>" class="form-control form-control-sm" required name="fname" type="text" aria-label=".form-control-sm example">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class=" modal-margin-top">
                                        <label for="exampleFormControlInput1" class="form-label">Last Name*</label>
                                        <input disabled readonly value="<?php echo $last_name?>"class="form-control form-control-sm" required name="lname" type="text" aria-label=".form-control-sm example">

                                    </div>
                                </div>

                            </div>

                            <div class="row modal-margin-top">
                                <div class="col-sm-12">
                                    <label for="exampleFormControlInput1" class="form-label">Company Name</label>
                                    <input disabled readonly value="<?php echo $company_name?>" class="form-control form-control-sm" name="cname" type="text"  aria-label=".form-control-sm example">
                           
                                </div>
                            </div>

                            <div class="row modal-margin-top">
                                <div class="col-sm-12">
                                    <label for="exampleFormControlInput1" class="form-label">Phone Number*</label>
                                    <input disabled readonly value="<?php echo $phone_number?>" class="form-control form-control-sm" name="phone" type="text"  aria-label=".form-control-sm example">
                                </div>
                            </div>

                            <div class="row modal-margin-top">
                                <div class="col-sm-12">
                                    <label for="exampleFormControlInput1" class="form-label">Email Adress*</label>
                                    <input disabled readonly value="<?php echo $email?>" class="form-control form-control-sm" name="email" type="text"  aria-label=".form-control-sm example">
                                </div>

                            </div>

                            <div class="row modal-margin-top">
                                <div class="col-sm-12">
                                    <label for="exampleFormControlInput1" class="form-label">Shipping Adress*</label>
                                    <input disabled readonly value="<?php echo $shipping_address?>" class="form-control form-control-sm" name="shipping" type="text"  aria-label=".form-control-sm example">
                                </div>
                            </div>
                    </div>
                    <div class="products-table">
                        <h5>Products</h5>
                        <table class="table .table-hover">
                            <thead>
                                <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($products_array as $p){
                                $product_array = array_pad(explode(":", $p),3,null);
                                $product_id = $product_array[0];
                                $quantity = $product_array[1];
                                $product_price = $product_array[2];
                
                                $product = new Product();
                
                                if($product->find($product_id)){
                                    $product_data = $product->data();

                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $product_data->product_name ?></th>
                                        <td><?php echo $product_price ?></td>
                                        <td><?php echo $quantity ?></td>
                                        <td>
                                            <button type="button" onclick="displayProductModal(<?php echo $product_data->product_id ?>)" class="btn btn-danger btn-sm">View Product</button>
                                        </td>
                                    </tr>


                                    <?php
                
                                    
                                }
                            }
                            ?>                
                            </tbody>
                            </table>

                            <br/> 
                            <br/> 

                            <?php

                            if($is_complete == 0){
                                ?>
                            <button type="button" onclick="markOrder(<?php echo $order_id?>)" class="btn btn-success btn-sm">Mark As Complete</button>

                                <?php

                            } else {
                                ?>
                            <button type="button" class="btn btn-success btn-sm" disabled>Complete</button>

                                <?php
                            }



                            ?>
                
                    <?php
                } else {
                    ?>

                    <div class="alert alert-danger" role="alert">
                        There has been an error loading the order details. Please try again later.
                    </div>

                    <?php
                }
            ?>
            
            </div>
        </section>

         <!-- Footer  timestamp=2:22:11-->
		<footer class="footer-admin">

            <div class="footer_container">
                <div class="row">
                    <div class="col-lg-6 logo_container_footer">
                        <a href="#">BenLee <span>Hardware</span></a>
                    </div>

                    <div class="col-lg-6 cr">©2021 All Right Reserved. </div>
                </div>
                
            </div>

        </footer>

    </div>

    <!-- jquery JS File -->
    <script src="js/jquery-3.2.1.min.js"></script>
	<!-- Bootstrap JS CDN -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
		integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
		crossorigin="anonymous"></script>

					
	<!-- Isotope JS File -->
	<script src="plugins/Isotope/isotope.pkgd.min.js"></script>
	<!-- Owl Carousel JS File -->
	<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<!-- Javascript File -->
	<script src="js/custom.js"></script>
</body>

</html>

    


