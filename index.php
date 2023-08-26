<?php 

require_once 'php/core/init.php';

$category = new Category();
$category->fetchAll();
$category_data = $category->data();

$search_string = '';
$search_data = '';
$display_search = false;

if(isset($_POST['search_string'])){

	$search_data = base64_decode($_POST["data"]);
	$search_string = $_POST["search_string"];
	$display_search = true;

}

?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PMMN7RR');</script>
	<!-- End Google Tag Manager -->
	<title> BenLee Hardware - Number 1 Hardware Store in Kenya </title>
	<meta charset="utf-8">
	<meta name="description" content="Benlee Hardware is an online store that deals with selling hardware materials in Kenya such as boards, iron sheets, chain links and Deformed bars">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
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

	<!-- Meta Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '835514437915261');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=835514437915261&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Meta Pixel Code -->

</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PMMN7RR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PMMN7RR" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

	<div class="super_container">

		<!-- Header -->
		<?php include 'header.php' ?>


		<!-- product modal -->
		<div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			aria-labelledby="productModal" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-body modal-product"></div>
					
				</div>
			</div>
		</div>

		<?php include 'banner.php'?>
			
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


		<?php 
		
		if ($display_search){
			?>
			<div class="content_container">

			<?php echo $search_data?>

			</div>
			<?php
		} else {
			?>
			<div class="content_container"></div>
			<?php

		}
		?>

		

		<p class="map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2714.053510041896!2d36.96674119338755!3d-1.2036433018501267!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f41c543b4a5a3%3A0xa6cbb0d7b1725c06!2sBenLee%20Hardware!5e0!3m2!1sen!2ske!4v1636114514634!5m2!1sen!2ske"  width="100%" height="270" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
			
		</p>

		<?php include 'footer.php' ?>
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