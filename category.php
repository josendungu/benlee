
<?php

include_once 'php/core/init.php';

if(Input::exists()){

    $output = "";
    $total_pages = 0;
    $products = null; 
    $records_per_page = 16;
    $category_id = Input::get('id');
    $page = Input::get('page');
    if($page == ''){
        $page = 1;
    }
    $category = new Category();
    if($category->find($category_id)){
        $cat_data = $category->data();
    }
    $product = new Product();
    $start_from = ($page - 1) * $records_per_page;
    if($product->fetchByLimits($start_from, $records_per_page, $category_id)){
        $products = $product->data();
        $product_total = new Product();
        if($product_total->findProductsByCategory($category_id)){
            $total_records = $product_total->count();
            $total_pages = ceil($total_records/$records_per_page);

            $output .= '
                <section class="category_search">
                    <h4 class="content-title">'.$cat_data->category_name.'</h4>
                    <div class="product-list">';

            foreach($products as $product ){
        
                $output .= '
                <div class="product-item men">
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
                            $output .= '
                        </div>
                    </div>
                    <div class="red_button add_link add_to_cart_button" id="'.$product->product_id.'"><a href="#" class="add_link">Add to Cart</a></div>
                </div>';	  
                        
            }   
            
            $output .= '
            </div>
                <nav class="pagination-nav d-flex align-items-center justify-content-center" aria-label="Page navigation example">
                    <ul class="pagination">';

            $i = 1;    
            while($i <= $total_pages){
   
                $output .= '
                    <li class="page-item"><a class="page-link" href="#" onclick="displayCategory('. $category_id .','. $i .')">'. $i .'</a></li>';
                                
                $i++;
            }

            $output .= '
            </ul>
            </nav>
            </section>';
                        

        } else {
            $output .= '
            <div class="alert alert-danger" role="alert">
            Some error occured while fetching the product. Please Try again later.
            </div>';
        }   
    } else {
        $output .= '<div class="alert alert-danger" role="alert">
        Some error occured while fetching the product. Please Try again later.
        </div>';
    }

   echo $output;
    

    
}

?>

