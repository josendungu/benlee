<?php

include_once 'php/core/init.php';

if(Input::exists()){

    $fetch = Input::get('fetch');
    $order = new Order();
    $output = '';

    if($fetch == 0){
        $output .= '<h4>Pending Orders</h4><br><br>';
    } else {
        $output .= '<h4>All Orders</h4><br><br>';
    }

    $output .= '
    <table class="table .table-hover">
    <thead>
        <tr>
        <th scope="col">Order Id</th>
        <th scope="col">Customer Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone Number</th>
        <th scope="col">Total</th>
        <th scope="col"></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        ';

    if($fetch == 0){

        
        if($order->getPending()){
            $orders = $order->data();
            

            foreach($orders as $o){
                
                $output .= '
                    <tr>
                        <th scope="row">'.$o->order_id.'</th>
                        <td>'.$o->first_name.'</td>
                        <td>'.$o->email.'</td>
                        <td>'.$o->phone_number.'</td>
                        <td>'.$o->total.'</td>
                        <td>
                            <button type="button" onclick="openOrder('.$o->order_id.')" class="btn btn-primary btn-sm">View</button>
                        </td>
                        <td>
                            <button type="button" onclick="markOrder('.$o->order_id.')" class="btn btn-danger btn-sm">Mark As Complete</button>
                        </td>
                    </tr>';            
                    
            }

            
        }

    } else {

        if($order->getAll()){
            $orders = $order->data();
            
            foreach($orders as $o){
                
                $output .= '
                    <tr>
                        <th scope="row">'.$o->order_id.'</th>
                        <td>'.$o->first_name.'</td>
                        <td>'.$o->email.'</td>
                        <td>'.$o->phone_number.'</td>
                        <td>'.$o->total.'</td>
                        <td>
                            <button type="button" onclick="openOrder('.$o->order_id.')" class="btn btn-primary btn-sm">View</button>
                        </td>';

                        if($o->is_complete == 1){
                            $output .= '
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" disabled>Completed</button>
                            </td>
                            ';
                        } else {
                            $output .= '
                            <td>
                                <button type="button" onclick="markOrder('.$o->order_id.')" class="btn btn-danger btn-sm">Mark As Complete</button>
                            </td>
                            ';
                        }

                        $output .= '</tr>';            
                    
            }

            
        }

    }

    $output .= '
    </tbody>
    </table>';

    echo $output;
}






?>