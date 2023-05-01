<?php
include_once 'php/core/init.php';

if(Input::exists()){

    
    $output = "";
    $main_content_page = Input::get('main_page');
    $base_url = '';

    if($main_content_page == 'false'){
        $base_url = '../';
    }

    if(Input::get('content') == "latest"){
        $product = new Product();

        if($product->findRecentProducts(3)){
            $products = $product->data();

            foreach($products as $p){
                $product_offer = $p->product_offer_price;
                $product_price = $p->product_price;
                $output .= '
                    <li>
                    <a class="footer-product" href="'.$base_url."product/".$p->product_url.'">
						<div class="product-elements" id="'.$p->product_id.'">
							<div class="product-element">
								<img class="footer-product-image" src="'.$base_url.$p->product_picture.'" alt="product">
							</div>
							<div class="product-element">
								<div class="product-footer-name">
                                    '.$p->product_name.'
								</div>
								<div>';
                                    
                                if($product_offer !== "0" && $product_offer < $product_price){

                                    $output .= '
                                    <div class="product-footer-price">Ksh '.$product_offer.'<span>Ksh '.$product_price.'</span></div>';
                                    
                                } else {
                                    $output .= '
                                    <div class="product-footer-price">Ksh '.$product_price.'</div>';
                                }
                            
                            $output .= '
								</div>
							</div>
						</div>
                        </a>
					</li>
                ';
            }
        }

    }

    if(Input::get('content') == "best-selling"){

        $best = new Best();
        

        if($best->fetchBestSelling(3)){
            $bests = $best->data();

            foreach($bests as $b){

                $product = new Product();
                $product->find($b->product_id);
                
                $p = $product->data();
                $product_offer = $p->product_offer_price;
                $product_price = $p->product_price;
                $output .= '
                    <li>
                    <a class="footer-product" href="'.$base_url."product/".$p->product_url.'">
						<div class="product-elements" id="'.$p->product_id.'">
							<div class="product-element">
								<img class="footer-product-image" src="'.$base_url.$p->product_picture.'" alt="product">
							</div>
							<div class="product-element">
								<div class="product-footer-name">
                                    '.$p->product_name.'
								</div>
								<div>';
                                    
                                if($product_offer !== "0" && $product_offer < $product_price){

                                    $output .= '
                                    <div class="product-footer-price">Ksh '.$product_offer.'<span>Ksh '.$product_price.'</span></div>';
                                    
                                } else {
                                    $output .= '
                                    <div class="product-footer-price">Ksh '.$product_price.'</div>';
                                }
                            
                            $output .= '
								</div>
							</div>
						</div>
                        </a>
					</li>
                ';
            }
        }

    }

    if(Input::get('content') == "top-rated"){

        $top = new Top();


        if($top->fetchTopRated(3)){
            $tops = $top->data();

            foreach($tops as $t){

                $product = new Product();
                $product->find($t->product_id);
                
                $p = $product->data();


                $product_offer = $p->product_offer_price;
                $product_price = $p->product_price;
                $output .= '
                    <li>
                    <a  class="footer-product" href="'.$base_url."product/".$p->product_url.'">
						<div class="product-elements" id="'.$p->product_id.'">
							<div class="product-element">
								<img class="footer-product-image" src="'.$base_url.$p->product_picture.'" alt="product">
							</div>
							<div class="product-element">
								<div class="product-footer-name">
                                    '.$p->product_name.'
								</div>
								<div >';
                                    
                                if($product_offer !== "0" && $product_offer < $product_price){

                                    $output .= '
                                    <div class="product-footer-price">Ksh '.$product_offer.'<span>Ksh '.$product_price.'</span></div>';
                                    
                                } else {
                                    $output .= '
                                    <div class="product-footer-price">Ksh '.$product_price.'</div>';
                                }
                            
                            $output .= '
								</div>
							</div>
						</div>
                        </a>
					</li>
                ';
            }
        }
        

    }

    echo $output;

}

?>