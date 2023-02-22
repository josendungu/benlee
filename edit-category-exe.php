<?php
include_once 'php/core/init.php';

if(Input::exists()){

    $category = new Category();
    try {
        $category->update(array(
            'category_name' => Input::get('category_name')
        ), Input::get('category_id'));
        echo "successful";
    } catch(Exception $e) {
        echo "error adding";
    }


} else {

    echo "values not available";
    
    
}