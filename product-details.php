<?php
include_once 'php/core/init.php';

if(Input::exists()){

    $product_id = Input::get('product_id');
    $return_data = Input::get('return_data');
    if ($return_data == ''){
        $return_data = false;
    } 
    $output = "";
    if($product_id != ''){
        $product = new Product();

        if($group = $product->find($product_id)){
            $data = $product->data();

            $category_id = $data->product_category;

            $category = new Category();

            if($category_group = $category->find($category_id)){
                $category_data = $category->data();

                if(!$return_data){
                    $output .= '
                    <div class="modal-header">
                    <h5 class="modal-title">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container">
                    <div class="row">

                    <div class="col-md-6">
                    <img class="modal-image " src="'.$data->product_picture.'" alt="product_1">
                    </div>

                    <div class="col-md-6 modal-details">

                    <div class="modal-product-name">'.$data->product_name.'</div>

                    <div class="modal-product-category"> Category: '.$category_data->category_name.'</div>';


                    if($data->product_offer_price !== "0" && $data->product_offer_price < $data->product_price){
                        $output .= '
                        <div class="modal-product-price">Ksh '.$data->product_offer_price.'<span>Ksh '.$data->product_price.'</span></div>';
                                
                    } else {
                        $output .= '
                        <div class="modal-product-price">Ksh '.$data->product_price.' </div>';
                    }
                                

                    $output .= '</div>
                    </div>
                    <p class="modal-product-desc">'.$data->product_description.'</p>
                    </div>

                    <div class="red_button modal-add-to-cart" ><a href="#" onclick="addToCart('.$data->product_id.')">Add to Cart</a></div>';

                    echo $output;
                } else {


                    $results = array(
                        'product_name' => $data->product_name,
                        'product_id' => $data->product_id,
                        'product_category' => $category_data->category_name,
                        'product_price' => $data->product_price,
                        'product_offer' => $data->product_offer_price,
                        'product_description' =>$data->product_description, 
                        'product_picture' => $data->product_picture,
                        'in_cart' => 0
                    );
                    
                    echo json_encode($results);

                }
              
            } else {
                echo 'error';
            }  

        } else {
            echo 'error';
        }

    } else {
        echo 'error 1';
    }
}

?>


