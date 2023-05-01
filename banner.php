<!-- Banner -->

<?php 
$category_base_url = "category/";

if($main_content == false ){

	$category_base_url = "../category/";
}
?>

<div class="banner banner-normal align-items-center justify-content-center">
	<div class="row category-container d-flex align-items-center justify-content-center">
		<nav class="navbar sticky-top">
			<ul class="navbar_menu">
				<?php
				foreach($category_data as $result ){
				?>
					<li id="<?php echo $result->category_id ?>"><a href="<?php echo $category_base_url.$result->category_url ?>" ><?php echo $result->category_name ?></a></li>

				<?php
				}
				?>	
			</ul>
		</nav>
	</div>
</div>