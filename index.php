<?php 

require_once 'php/core/init.php';

$category = new Category();
$category->fetchAll();
$category_data = $category->data();


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
		<header class="header trans_300">

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
				
				<div class="banner banner-popup">
					<!-- Banner -->
					<div class="align-items-center justify-content-center">
						<div class="row category-container d-flex align-items-center justify-content-center">
							<nav class="navbar banner-nav ">
								<ul class="navbar_menu">
								<?php
								foreach($category_data as $result ){
								?>
									<li id="<?php echo $result->category_id ?>"><a href="#" onclick="displayCategory(<?php echo $result->category_id ?>, 1)"><?php echo $result->category_name ?></a></li>

								<?php
								}
								?>	
								</ul>
							</nav>

							<div class="hamburger_container">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>

						</div>
					</div>
					
				</div>
				
				<div class=" header-grid-container">
					<div class="grid-element ">
						<div class="logo_container">
							<a href="#">BenLee <span>Hardware</span></a>
						</div>
					</div>

					<div class="grid-element">
						<div class="search-container">
							<form class="form-group" action="" method="post" id="search-products" enctype="form-data">

								<div class="input-group input-group-sm mb-3">
									<input type="text" class="form-control input-search" placeholder="Search" name="search_string" aria-label=".search">
									<div class="input-group-append">
										<button class="btn btn-secondary" type="submit" value="Upload" id="inputGroup-sizing-sm">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
								
							</form>
							
						</div>
					</div>

					<div class="grid-element">
						<nav class="navbar">

							<ul class="navbar_user">
									
								<li class="checkout">
									<a href="cart.php">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										<span id="checkout_item" class="checkout_items">2</span>
									</a>
								</li>

								<li style="margin-left: 10px;">
									<div class="hamburger_container">
										<i class="fa fa-bars" aria-hidden="true"></i>
									</div>
								</li>
							</ul>
						</nav>
					</div>
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

		<!-- Banner -->
		<div class="banner align-items-center justify-content-center">
				<div class="row category-container d-flex align-items-center justify-content-center">
					<nav class="navbar sticky-top">
						<ul class="navbar_menu">
						<?php
						foreach($category_data as $result ){
						?>
							<li id="<?php echo $result->category_id ?>"><a href="#" onclick="displayCategory(<?php echo $result->category_id ?>, 1)"><?php echo $result->category_name ?></a></li>

						<?php
						}
						?>	
						</ul>
					</nav>

		</div>
			
		</div>

		<div class="fs_menu_overlay"></div>
		<div class="hamburger_menu">
			<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
							
			<div class="hamburger_menu_content text-right">

			<form class="form-group" action="" method="post" id="search-products-ham" enctype="form-data">

				<div class="input-group input-group-sm mb-3" style="padding:20px;">
					<input type="text" class="form-control input-search" placeholder="Search" name="search_string" aria-label=".search">
					<div class="input-group-append">
						<button class="btn btn-secondary" type="submit" value="Upload" id="inputGroup-sizing-sm">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</div>
								
			</form>
				<ul class="menu_top_nav">
				<?php
				foreach($category_data as $result ){
					?>
						
					<li class="menu_item"><a href="#" onclick="displayCategory(<?php echo $result->category_id ?>, 1)"><?php echo $result->category_name ?></a></li>

					<?php } ?>
				</ul>
			</div>
		</div>

		<div class="content_container"></div>

		<p class="map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2714.053510041896!2d36.96674119338755!3d-1.2036433018501267!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f41c543b4a5a3%3A0xa6cbb0d7b1725c06!2sBenLee%20Hardware!5e0!3m2!1sen!2ske!4v1636114514634!5m2!1sen!2ske"  width="100%" height="270" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
			
		</p>

		<!-- Footer  timestamp=2:22:11-->
		<footer class="footer">

			<div class="footer-elements">
				<div class="footer-element">
					<div class="footer-element-title">Latest</div>
					<ul class="product-list-widget" id="latest">
						
					</ul>
				</div>
				<div class="footer-element">
					<div class="footer-element-title">Best Selling</div>
					<ul class="product-list-widget" id="best-selling">

					</ul>
				</div>
				<div class="footer-element">
					<div class="footer-element-title">Top Rated</div>
					<ul class="product-list-widget" id="top-rated">
						
					</ul>
				</div>
				<div class="footer-element">
					<div class="footer-element-title">Info</div>

					<div class="info-content">

					<p class="footer-statement" style="color: #ffffff;">
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac gravida augue. Maecenas pharetra dignissim ligula nec euismod. Duis lectus augue, tempor sit amet maximus non, vehicula et massa. Nunc sodales in est feugiat ullamcorper. Aliquam maximus nibh ultricies aliquet dapibus. Proin varius efficitur ex.
					</p>

					<p class="location" style="color: #ffffff;">Location: <span>Mwihoko</span></p>

					<p class="call" style="color: #ffffff;">Phone: <span>+254723370349</span></p>

					<p class="email" style="color: #ffffff;">Email: <span>info@benlee.com</span></p>
					</div>
					


				</div>
			</div>

			<div class="footer_container">
				<div class="row">
					<div class="col-lg-6 logo_container_footer">
						<a href="/index.php">BenLee <span>Hardware</span></a>
						<span class="cr">©2021 All Right Reserved. </span>
					</div>
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