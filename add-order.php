<?php

include_once 'php/core/init.php';

if(Input::exists()){
    
    $order = new Order();

    try {
        $order->create(array(
            "first_name" => Input::get('firstname'),
            "last_name" => Input::get('lastname'),
            "company_name" => Input::get('companyname'),
            "phone_number" => Input::get('phonenumber'),
            "email" => Input::get('email'),
            "address" => Input::get('address'),
            "total" => Input::get('total'),
            "products" => Input::get('products'),
            "is_complete" => 0
        ));
        echo "successful";
    } catch(Exception $e) {
        echo "error adding";
    }



    

}