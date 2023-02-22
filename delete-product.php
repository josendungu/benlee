<?php

include_once 'php/core/init.php';

if(Input::exists()){

    $product = new Product();
    $product_id = Input::get('product_id');

    if($product->delete($product_id)){
        echo 'success';
    } else {
        echo 'error';
    }
    


} else {
    echo 'error';
}


?>