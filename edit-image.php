<?php
include_once 'php/core/init.php';

$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions
$path = 'images/products/'; // upload directory

if(Input::exists()){

    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    echo Input::get('product_id');

     // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;
    // check's valid format
    if(in_array($ext, $valid_extensions)) { 
        $path = $path.strtolower($final_image); 
        if(move_uploaded_file($tmp,$path)) {

            $product = new Product();

            try {
                $product->update(Input::get('product_id'), array(
                    'product_picture' => $path  
                ));
                header('location:admin.php?error=false');

            } catch(Exception $e) {
                header('location:admin.php?error=true');

            }
            
        } else {
            header('location:admin.php?error=true');
        }
    } else {
        header('location:admin.php?errror=true');
    }
} else {
    header('location:admin.php?error=true');
}
?>