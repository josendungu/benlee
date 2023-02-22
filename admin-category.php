
<?php

include_once 'php/core/init.php';



    $output = "";
    $total_pages = 0;
    $products = null; 
    $category = new Category();

    
    if($category->fetchAll()){
        $categories = $category->data();

        $output .= '
            <table class="table .table-hover">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                ';
            foreach($categories as $cat){
        
                $output .= '
                    <tr>
						<th scope="row">'.$cat->category_id.'</th>
						<td>'.$cat->category_name.'</td>
						<td>
							<button type="button" onclick="editCategory('.$cat->category_id.')" class="btn btn-primary btn-sm">Edit</button>
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
    



?>

