<?php
include_once 'php/core/init.php';

if(Input::exists()){

    //actions 1 - remove: 0 - add

    $product_id = Input::get('product_id');
    $action = Input::get('action');
    $best = new Best();

    if($action == 1){
        //remove
        if($best->remove($product_id)){
            echo 'success';
        } else {
            echo 'error';
        }


    } else if($action == 0){
        //add

        try{
            $best->add($product_id);
            echo "success";
        } catch(Exception $e) {
            echo "error adding";
        }
        
    }


}

?>