<?php 

include_once 'php/core/init.php';

$product = new Product();

$product_fetch = $product->getAll();

if($product_fetch){

    $data = $product->data();

    foreach($data as $product_item){

        $product_name = str_replace(" ", "-", $product_item->product_name);

        $product_url = $product_name;

        $product_name = $product_item->product_name;
        $product_url_fetch = $product->searchProductByProductUrl($product_url);

        if($product_url_fetch && $product->count() >= 1){
            $product_url .= "-".$product->count();
        }

        $changes = array('product_url' => $product_url);

        $product->update($product_item->product_id, $changes);

        echo "Updated ".$product_name."\n";


    }

}



?>