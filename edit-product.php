<?php
include_once 'php/core/init.php';

if(Input::exists()){

    
    $category_all = new Category();
    $category_all->fetchAll();
    $category_data_all = $category_all->data();


    $product_id = Input::get('product_id');
   
    $output = "";
    if($product_id != ''){
        $product = new Product();

        if($group = $product->find($product_id)){
            $data = $product->data();

            $category_id = $data->product_category;

            $category = new Category();

            if($category_group = $category->find($category_id)){
                $category_data = $category->data();

                   $output .= '
                        <div class="row">
							<div class="col-md-6">

								<img src="'.$data->product_picture.'" class="modal-image" alt="product" >

							</div>
							<div class="col-md-6 photo-upload">
                            <form class="form-group" action="edit-image.php?product_id='.$data->product_id.'" method="post" id="form-edit-image" enctype="multipart/form-data">
								<div class="modal-image-select row">
                                    <label for="formFile" class="form-label">Product Image</label>
									<input name="image" class="input-file uniform_on form-control" id="fileInput" type="file" required><br>
								</div></br>
                                <input class="btn btn-success upload-img" id="'.$data->product_id.'" name="photo" type="submit" value="Upload"/>
                                
                            </form>
							</div>

						</div>
						
                        <form class="form-group" action="" method="post" id="form-edit-product" enctype="multipart/form-data">
						<div class="row">
                            <div class="col-md-12">
                                <label for="formFile" class="form-label">Product Id</label>
                                <input class="form-control form-control-sm edit" id="product_id" type="text" placeholder="Product Id" value="'.$data->product_id.'"
                                aria-label="default input example" name="product_name" disabled>
                            </div>
                        </div>
                        
                        <div class="row">
							<div class="product-name col-md-6 modal-margin-top">
                            <label for="formFile" class="form-label">Product Name</label>
								<input class="form-control form-control-sm edit" id="product_name" type="text" placeholder="Product Name" value="'.$data->product_name.'"
									aria-label="default input example" name="product_name" required>
							</div>

							<div class="product-name col-md-6 modal-margin-top">
                            <label for="formFile" class="form-label">Product Category</label>
								<select class="form-select form-select-sm" required aria-label="Default select example" name="product_category">
									<option>Select Category</option>';

							
										
										foreach($category_data_all as $result ){

                                            if($result->category_id == $data->product_category){
                                                $output .= '<option selected value="'.$result->category_id.'">'.$result->category_name.'</option>';
                                            } else {
                                                $output .= '<option value="'.$result->category_id.'">'.$result->category_name.'</option>';

                                            }	
										
										}
									
									
								  $output .= '</select>
							</div> 	
						</div>

						<div class="row modal-margin-top">
							<div class="col-md-12"> 
                            <label for="formFile" class="form-label">Product Description</label>
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="2"  name="product_description">'.$data->product_description.'</textarea>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 modal-margin-top">
                            <label for="formFile" class="form-label">Product Price</label>
								<input class="form-control form-control-sm" name="product_price" type="text" placeholder="Product Price"
									aria-label="default input example" value="'.$data->product_price.'" required>
							</div>

							<div class="col-md-6 modal-margin-top">
                            <label for="formFile" class="form-label">Product Offer Price</label>
								<input class="form-control form-control-sm" name="product_offer_price" value="'.$data->product_offer_price.'" type="text" placeholder="Offer Price"
									aria-label="default input example">
							</div>

						</div><br><br>

					    <input class="btn btn-success upload-btn" id="'.$data->product_id.'" type="submit" value="Upload"/>

                        </form>


                   
                   ';

                    echo $output;
                
              
            } else {
                echo 'error';
            }  

        } else {
            echo 'error';
        }

    } else {
        echo 'error 1';
    }
}

?>


