<?php
include_once 'php/core/init.php';


if(Input::exists()){


    $category_name = Input::get('category');

    $category = new Category();

    try {
        $category->create(array(
            "category_name" => $category_name
        ));
        echo "successful";
    } catch(Exception $e) {
        echo "error adding";
    }
} else {
    echo 'error';
}

?>