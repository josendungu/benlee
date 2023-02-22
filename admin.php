<?php

require_once 'php/core/init.php';

$error = null;

if(!isset($_SESSION['User'])){
    header("location:admin-login.php");
}



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
		<header class="header trans_300" style="height: 80px;">

			<!-- main Navigation -->
			<div class="main_nav_container">
				<div class="logo_container">
					<a href="#">BenLee <span>Hardware</span></a>
				</div>
			</div>	
		</header>


		<section class="admin-content">


			<div class="message">

				<?php
				if(Input::exists('get')){
					$error = Input::get('error');
				
					if($error === 'true'){
						?>
						<div class="alert alert-danger" role="alert">
							Photo was not uploaded. Please try again later
						</div>
						<?php
					} else {
						?>
						<div class="alert alert-success" role="alert">
							Photo was successfully uploaded.
						</div>
						<?php
				
					}
				}
				?>
				
			</div>

			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab" aria-controls="products" aria-selected="true">Products</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#category" type="button" role="tab" aria-controls="category" aria-selected="false">Category</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="best-selling-tab" data-bs-toggle="tab" data-bs-target="#best" type="button" role="tab" aria-controls="best-selling" aria-selected="false">Best Selling</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="top-rated-tab" data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab" aria-controls="top-rated" aria-selected="false">Top Rated</button>
				</li>

				<li class="nav-item" role="presentation">
					<button class="nav-link" id="top-rated-tab" data-bs-toggle="tab" data-bs-target="#orders" type="button" role="tab" aria-controls="top-rated" aria-selected="false">Orders</button>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">

				<!-- products -->
				<div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="product-tab">

					<div class="product-admin-elements row">
						<div class="product-admin-element col-md-10">
							<form class="form-group" action="" method="post" id="admin-products" enctype="form-data">
								<div class="row">
									<div class="col-md-5">
										<input class="form-control form-control-sm" name="search_string" type="text" placeholder="Search" aria-label=".form-control-sm example">
									</div>
									<div class="col-md-3">
										<button type="submit" class="btn btn-danger btn-sm">Search</button>
									</div>

								</div>
								
							</form>
						</div>

						<div class="product-admin-element col-md-2">
							<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Product</button>
							
						</div>
					</div>
					

					<br><br>
					<div class="table-content" id="table-body-products">
						
					</div>
						
				</div>

				<!-- category -->
				<div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
					
					<div class="product-admin-element col-md-2">
						<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCategory">App Category</button>		
					</div>
					<div class="table-content" id="table-body-category"></div>
		
				</div>

				<!-- Best Selling -->
				<div class="tab-pane fade" id="best" role="tabpanel" aria-labelledby="category-tab">
					
					<div class="product-admin-elements row">
						<div class="product-admin-element col-md-10">
							<form class="form-group" action="" method="post" id="admin-best-selling" enctype="form-data">
								<div class="row">
									<div class="col-md-5">
										<input class="form-control form-control-sm" name="search_string" type="text" placeholder="Search" aria-label=".form-control-sm example">
									</div>
									<div class="col-md-3">
										<button type="submit" class="btn btn-danger btn-sm">Search</button>
									</div>

								</div>
									
							</form>
						</div>

					</div>
						

					<br><br>
					<div class="table-content" id="table-body-bs"></div>

		
				</div>

				<!-- Top Rated -->
				<div class="tab-pane fade" id="top" role="tabpanel" aria-labelledby="category-tab">
					<div class="product-admin-elements row">
						<div class="product-admin-element col-md-10">
							<form class="form-group" action="" method="post" id="admin-top-rated" enctype="form-data">
								<div class="row">
									<div class="col-md-5">
										<input class="form-control form-control-sm" name="search_string" type="text" placeholder="Search" aria-label=".form-control-sm example">
									</div>
									<div class="col-md-3">
										<button type="submit" class="btn btn-danger btn-sm">Search</button>
									</div>

								</div>
									
							</form>
						</div>

						
					</div>
						

					<br><br>
					<div class="table-content" id="table-body-tr"></div>


		
				</div>


				<!-- Orders -->
				<div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="category-tab">
					<div class="product-admin-elements row">
						<div class="product-admin-element col-md-2">
							<button type="button" class="btn btn-success btn-sm" onclick="displayOrders(1)">View All</button>		
						</div>

						<div class="product-admin-element col-md-2">
							<button type="button" class="btn btn-success btn-sm" onclick="displayOrders(0)">View Pending</button>		
						</div>
					</div>
						

					<br><br>
					<div class="table-content" id="table-body-order"></div>


		
				</div>
				

			</div>
		</section>

		<!-- product modal -->
		<div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			aria-labelledby="productModal" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-body modal-product"></div>
					
				</div>
			</div>
		</div>

        <!-- app product modal -->
		<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

					<div class="alert alert-danger hide" id="alert-error" role="alert">
					</div>

					<div class="alert alert-success hide" id="alert-success" role="alert">
					</div>
					<form class="form-group" action="" method="post" id="form-add-product" enctype="multipart/form-data">
                       
						<div class="modal-image-select">
							<input name="image" class="input-file uniform_on form-control" id="fileInput" type="file" required><br>
						</div>

						<div class="row">
							<div class="product-name col-md-6 modal-margin-top">
								<input class="form-control" type="text" placeholder="Product Name"
									aria-label="default input example" name="product_name" required>
							</div>

							<div class="product-name col-md-6 modal-margin-top">
								<select class="form-select" required aria-label="Default select example" name="product_category">
									<option selected>Open this select menu</option>

									<?php 
										
										foreach($category_data as $result ){
											?>
											<option value=<?php echo $result->category_id ?>><?php echo $result->category_name ?></option>
											<?php
										
										}
									?>
									
								  </select>
							</div> 	
						</div>

						<div class="row modal-margin-top">
							<div class="col-md-12"> 
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="product_description"></textarea>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 modal-margin-top">
								<input class="form-control" name="product_price" type="text" placeholder="Product Price"
									aria-label="default input example" required>
							</div>

							<div class="col-md-6 modal-margin-top">
								<input class="form-control" name="product_offer_price" type="text" placeholder="Offer Price"
									aria-label="default input example">
							</div>

						</div>
					</div>
					<div class="modal-footer">
						<input class="btn btn-success" type="submit" value="Upload"/>
					</div>

					</form> 	
				</div>
			</div>
		</div>

		<!-- app category modal -->
		<div class="modal fade" id="addCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

					<div class="alert alert-danger hide" id="alert-error-category" role="alert">
					</div>

					<div class="alert alert-success hide" id="alert-success-category" role="alert">
					</div>
					<form class="form-group" action="" method="post" id="form-add-category" enctype="multipart/form-data">
                    
						<div class="row modal-margin-top">
							<div class="col-md-12"> 
								<input class="form-control" name="category" type="text" placeholder="Category Name"
									aria-label="default input example" required>
							</div>
						</div>

						
					</div>
					<div class="modal-footer">
						<input class="btn btn-success" type="submit" value="Upload"/>
					</div>

					</form> 	
				</div>
			</div>
		</div>

		<!-- edit product modal -->
		<div class="modal fade" id="editProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

						<div class="alert alert-danger hide" id="alert-error-edit" role="alert">
						</div>

						<div class="alert alert-success hide" id="alert-success-edit" role="alert">
						</div>
	
						<div class="product-edit-content"></div>
						
					</div>	
				</div>
			</div>
		</div>


		<!-- edit category modal -->
		<div class="modal fade" id="editCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">

						<div class="alert alert-danger hide" id="alert-error-category-edit" role="alert">
						</div>

						<div class="alert alert-success hide" id="alert-success-category-edit" role="alert">
						</div>
	
						<div class="category-edit-content"></div>
						
					</div>	
				</div>
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

    