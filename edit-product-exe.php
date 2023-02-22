<?php
include_once 'php/core/init.php';

if(Input::exists()){

        $product = new Product();

        try {
            $product->update(Input::get('product_id'), array(
                'product_name' => Input::get('product_name'),
                'product_category' => Input::get('product_category'),
                'product_description' => Input::get('product_description'),
                'product_price' => Input::get('product_price'),
                'product_offer_price' => Input::get('product_offer')
            ));
            echo "successful";
        } catch(Exception $e) {
            echo "error adding";
        }


   
} else {
    echo "values not available";
}



?>