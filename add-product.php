<?php
include_once 'php/core/init.php';

$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
$path = 'images/products/'; // upload directory
if(Input::exists()){
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;
    // check's valid format
    if(in_array($ext, $valid_extensions)) { 
        $path = $path.strtolower($final_image); 
        if(move_uploaded_file($tmp,$path)) {

            $product = new Product();

            $product_url = $str = str_replace(" ", "-", Input::get('product_name'));
            $existing_url_fetch = $product->searchProductByProductUrl($product_url);

            if($existing_url_fetch){
                $count = $product->count();
                
                if ($count >= 1){
                    $product_url .= "-".$count;
                }
            }


            try {
                $product->create(array(
                    'product_name' => Input::get('product_name'),
                    'product_category' => Input::get('product_category'),
                    'product_description' => Input::get('product_description'),
                    'product_price' => Input::get('product_price'),
                    'product_offer_price' => Input::get('product_offer_price'),
                    'product_picture' => $path,
                    'date_added' => date('Y-m-d H:i:s'),
                    'product_url' => $product_url
                ));
                echo "successful";
            } catch(Exception $e) {
                echo "error adding";
            }
            
        } else {
            echo "pic error";
        }
    } else {
        echo "invalid";
    }
} else {
    echo "values not available";
}



?>