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
			<div class="contact-info">
					<span > <a class="email" href="mailto:info@benlee.co.ke">info@benlee.co.ke</a></span>|
					<span > <a class="phone" href="tel:+254723370349">+254723370349</a></span>

					<div class="socials">
					<i class="fa fa-twitter" aria-hidden="true"></i>
					<a class="social-icon" target="_blank" href="https://www.facebook.com/Benlee-Agencies-108399281405059/"><i class="fa fa-facebook" aria-hidden="true"></i></a> 
					<i class="fa fa-instagram" aria-hidden="true"></i>
					</div>
					
				</div>
				
			<div class="logo_container">
				<a href="/benlee">BenLee <span>Hardware</span></a>
			</div>
					
			</div>
		</header>


        <div class="cart_container">

            <h3>Shopping Cart</h3>

            

                <div class="alert alert-danger hide" id="cart-error" role="alert">
				</div>

				<div class="alert alert-success hide" id="cart-success" role="alert">
				</div>
                
                    <div class="cart-table">

                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th>Product Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody class="cart-table-body">
                                
                            </tbody>
                        </table>

                        
                    </div>

                    <div class="billing-container">
                        <div class="billing">
                            <h4>Billing Details</h4>

                            <p>Please fill in the form below to complete your order.</p>
                        </div>


                        <form class="form-group" action="" method="post" id="form-complete-order" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="modal-margin-top" >
                                        <label for="exampleFormControlInput1" class="form-label">First Name*</label>
                                        <input class="form-control form-control-sm" required name="fname" type="text" aria-label=".form-control-sm example">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class=" modal-margin-top">
                                        <label for="exampleFormControlInput1" class="form-label">Last Name*</label>
                                        <input class="form-control form-control-sm" required name="lname" type="text" aria-label=".form-control-sm example">

                                    </div>
                                </div>

                            </div>

                            <div class="row modal-margin-top">
                                <div class="col-sm-12">
                                    <label for="exampleFormControlInput1" class="form-label">Company Name</label>
                                    <input class="form-control form-control-sm" name="cname" type="text"  aria-label=".form-control-sm example">
                           
                                </div>
                            </div>

                            <div class="row modal-margin-top">
                                <div class="col-sm-12">
                                    <label for="exampleFormControlInput1" class="form-label">Phone Number*</label>
                                    <input class="form-control form-control-sm" name="phone" type="text"  aria-label=".form-control-sm example">
                                </div>
                            </div>

                            <div class="row modal-margin-top">
                                <div class="col-sm-12">
                                    <label for="exampleFormControlInput1" class="form-label">Email Adress*</label>
                                    <input class="form-control form-control-sm" name="email" type="text"  aria-label=".form-control-sm example">
                                </div>

                            </div>

                            <div class="row modal-margin-top">
                                <div class="col-sm-12">
                                    <label for="exampleFormControlInput1" class="form-label">Shipping Adress*</label>
                                    <input class="form-control form-control-sm" name="shipping" type="text"  aria-label=".form-control-sm example">
                                </div>
                            </div>
         

						<input class="btn btn-success" type="submit" value="Complete Order" style="margin-top:10px;"/>
					

					</form> 	
                    </div>
                

        </div>
    
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