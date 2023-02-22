
<?php

include_once 'php/core/init.php';
if(Input::exists()){

    $output = "";
    $total_pages = 0;
    $products = null; 
    $records_per_page = 20;
    $page = Input::get('page');
    if($page == ''){
        $page = 1;
    }
    
    $product = new Product();
    $start_from = ($page - 1) * $records_per_page;
    if($product->fetchAllByLimit($start_from, $records_per_page)){
        $products = $product->data();
        $product_total = new Product();
        if($product_total->getAll()){
            $total_records = $product_total->count();
            $total_pages = ceil($total_records/$records_per_page);

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

            foreach($products as $product ){
        
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
            </table>
                <nav class="pagination-nav d-flex align-items-center justify-content-center" aria-label="Page navigation example">
                    <ul class="pagination">';

            $i = 1;    
            while($i <= $total_pages){
   
                $output .= '
                    <li class="page-item"><a class="page-link" href="#" onclick="displayProducts('. $i .')">'. $i .'</a></li>';                
                $i++;
            }

            $output .= '
            </ul>
            </nav>
            </section>';
                        

         
    } else {
        $output .= "Some error occured 2";
    }

   echo $output;
    
    }
    
}

?>



