<?php

include_once 'php/core/init.php';

    $product = new Product();
    $output = '';

    if($product->findRecentProducts(16)){
        $products = $product->data();

        $output .= '
        <div class="about">
			<div class="about-element">
                <div class="about-text shadow-lg p-3 mb-5 bg-body rounded">
                    <h3 class="about-header">General Hardware Supplies</h3>
                    Benlee Agencies offers building material supplies that are reliable and affordable.
                    With our complete range of building materials, top-quality services and the best advice in the business.
                    We empower you to build up your property and build with ease.
                </div>
				
			</div>
			<div class="about-element">	
                <div class="about-text shadow-lg p-3 mb-5 bg-body rounded">
                    Location: Mwihoko - around 46 Shopping Center
                </div>			
			</div>
		</div>
        <section class="category_search">
            <h4 class="content-title">RECENTLY ADDED</h4>
            <div class="product-list">';


        foreach($products as $product){

            $output .= '
            <div class="product-item">
                <div class="product discount product_filter" id="'.$product->product_id.'">
                    <div class="product_image">
                        <img class="image" src="'.$product->product_picture.'" alt="product">
                    </div>
                    <div class="favorite favorite_left"></div>
                        <div class="product_info">
                        <h6 class="product_name"><a href="#">'.$product->product_name.'</a></h6>';

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
            </div>';	  
                    

        }

        $output .= '
            </div>
            </section>';


        

    }  else {
        $output .= "   Some error occured 2";
    }

    echo $output;


?>

