
<?php

include_once 'php/core/init.php';

if(Input::exists()){

    $output = "";
    $total_pages = 0;
    $products = null; 
    $product = new Product();
    $search_statement = Input::get('search_string');

    
    if($product->searchProducts($search_statement)){
        $products = $product->data();
        
            $output .= '
                <section class="category_search">
                    <div class="product-list">';


            foreach($products as $product){
        
                $output .= '
                <div class="product-item">
                <a href="product/'.$product->product_url.'">
                    <div class="product discount product_filter" id="'.$product->product_id.'">
                        <div class="product_image">
                            <img class="image" src="'.$product->product_picture.'" alt="product">
                        </div>
                        <div class="favorite favorite_left"></div>
                            <div class="product_info">
                            <h6 class="product_name"><a href="product/'.$product->product_url.'">'.$product->product_name.'</a></h6>';

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
                    <div class="red_button add_link add_to_cart_button" id="'.$product->product_id.'"><a href="#" class="add_link">Add to Cart</a></div>
                </a>
                </div>';	  
                        
            }   
            
            $output .= '
            </div>
            </section>';
                        

       
    } else {
        $output .= "   Some error occured";
    }

   echo $output;
    

    
}

?>

