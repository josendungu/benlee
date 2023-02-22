<?php

include_once 'php/core/init.php';

if(Input::exists()){

    $order_id = Input::get('order_id');
    $order = new Order();

    try {
        $order->markOrder($order_id);
        echo 'success';
    } catch(Exception $e){
        echo 'error-executing';
    }
}

?>