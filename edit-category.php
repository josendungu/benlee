<?php
include_once 'php/core/init.php';


if(Input::exists()){

    $category_id = Input::get('category_id');
    $category = new Category();

    $output = '';

    if($category->find($category_id)){
        $data = $category->data();
        $output .= '
        <form class="form-group" action="" method="post" id="form-edit-category" enctype="multipart/form-data">
			<div class="row">
                <div class="col-md-12">
                    <label for="formFile" class="form-label">Category Id</label>
                    <input class="form-control form-control-sm edit" id="category_id" type="text" placeholder="Category Name" value="'.$data->category_name.'"
                    aria-label="default input example" name="category_name">
                </div>
            </div>

            <br><br>

			<input class="btn btn-success upload-btn" id="'.$data->category_id.'" type="submit" value="Upload"/>

            </form>
        ';

        echo $output;
    } else {
        echo 'error';
    }

} else {
    echo 'error';
}

?>