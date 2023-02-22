
<?php

include_once 'php/core/init.php';

if(Input::exists()){

    $output = "";
    $total_pages = 0;
    $products = null; 
    $product = new Product();
    $search_statement = Input::get('search_string');

    
    if($product->searchProducts($search_statement)){
        $products = $product->data();

        $output .= '
            <table class="table .table-hover">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Offer Price</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                ';
            foreach($products as $product){
        
                $output .= '
                    <tr>
						<th scope="row">'.$product->product_id.'</th>
						<td>'.$product->product_name.'</td>
						<td>'.$product->product_price.'</td>
						<td>'.$product->product_offer_price.'</td>
						<td>
							<button type="button" onclick="editProduct('.$product->product_id.')" class="btn btn-primary btn-sm">Edit</button>
						</td>
						<td>
							<button type="button" onclick="deleteProduct('.$product->product_id.')" class="btn btn-danger btn-sm">Delete</button>
						</td>
					</tr>
                ';            
            }   

            $output .= '
            </tbody>
            </table>';
       
    } else {
        $output .= "Some error occured";
    }

   echo $output;
    

    
}

?>

