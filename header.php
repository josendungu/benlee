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

				<?php 
				$main_url = "";
				if ($main_content == false) {
					$main_url = "../";
				}
				?>
				
				<div class=" header-grid-container">
					<div class="grid-element ">
						<div class="logo_container">
							<h1><a href="<?php echo $main_url?>" style="color:black">BenLee <span>Hardware</span></a></h1>
						</div>
					</div>

					<div class="grid-element">

						<?php
						
						if (true){
							?>

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
							<?php
						}
						?>
						
					</div>

					<div class="grid-element">
						<nav class="navbar">

							<ul class="navbar_user">
									
								<li class="checkout">
									<?php 
									if ($main_content == true){
										?>
											<a href="cart.php">
												<i class="fa fa-shopping-cart" aria-hidden="true"></i>
												<span id="checkout_item" class="checkout_items">2</span>
											</a>
										<?php
									} else {
										?>
											<a href="../cart.php">
												<i class="fa fa-shopping-cart" aria-hidden="true"></i>
												<span id="checkout_item" class="checkout_items">2</span>
											</a>
										<?php
									}
									?>
									
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