<?php
include_once 'php/core/init.php';

if(Input::exists()){

    //actions 1 - remove: 0 - add

    $product_id = Input::get('product_id');
    $action = Input::get('action');
    $top = new Top();

    if($action == 1){
        //remove
        if($top->remove($product_id)){
            echo 'success';
        } else {
            echo 'error';
        }


    } else if($action == 0){
        //add

        try{
            $top->add($product_id);
            echo "success";
        } catch(Exception $e) {
            echo "error adding";
        }
        
    }


}

?>