<?php

class Product {
    private $_db,
            $_data,
            $_product,
            $_count;
            
    
    public function __construct() {

        $this->_db = DB::getInstance();

    }

    public function findRecentProducts($limit){
        $group = $this->_db->fetchRecent('products', 'date_added', $limit);

        if($this->_db->count()){
            $this->_data = $this->_db->results();
            return true;
        } else {
            return false;
        }
    }

    public function fetchBestSelling(){

        $group = $this->_db->get('products', array('best_seller', '=', 1));

        if($this->_db->count()){
            $this->_data = $this->_db->results();
            return true;
        } else {
            return false;
        }
    }

    public function fetchTopRated(){

        $group = $this->_db->get('products', array('top_rated', '=', 1));

        if($this->_db->count()){
            $this->_data = $this->_db->results();
            return true;
        } else {
            return false;
        }
    }

    public function fetchAllByLimit($start, $records){
        $group = $this->_db->fetchLimits('SELECT *', 'products', $start, $records, 'product_id');
        
        if($group->count()){
            $this->_data = $this->_db->results();
            return true;
        } else {
            return false;
        }
    }

    public function fetchByLimits($start, $records, $category_id){
        
        $group = $this->_db->fetchByLimits('SELECT *', 'products', $start, $records, 'product_id', array('product_category', '=', $category_id));
        
        if($group->count()){
            $this->_data = $this->_db->results();

            return true;
        } else {
            return false;
        }
    
    
    }

    public function findProductsByCategory($id){
        
        if($id) {
            $data = $this->_db->get('products', array('product_category', '=', $id));   
        
            if($this->_db->count()) {
                $this->_data = $this->_db->results();
                $this->_count = $this->_db->count();
                return true;
            }
        }
        return false;
    }


    public function create($fields = array()) {

        if(!$this->_db->insert('products', $fields)) {
            throw new Exception('Sorry, there was a problem adding the products;');
        }

    }


    public function searchProducts($search_string, $category_id = null){

        $sql = null;
        if(is_null($category_id)){
            $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_string%'";

        } else {
            $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_string%' AND product_category LIKE '%$category_id%'";   
        }
        $group = $this->_db->fetchSearch($sql);

        if($this->_db->count()){
            $this->_data = $this->_db->results();
            $this->_count = $this->_db->count();

            return true;
        } else {
            return false;
        }


    }


    public function delete($product_id){
        $data = $this->_db->delete('products', array('product_id', '=', $product_id));
        
        if($this->_db->count()) {   
            return true;
        }
    }

    public function find($product = null) {

        if($product) {
            $data = $this->_db->get('products', array('product_id', '=', $product));
        
            if($data->count()) {   
                $this->_data = $data->first();
                return true;
            }

        }
        return false;

    }

    public function update($product_id, $fields){

        if(!$this->_db->update('products', $product_id, $fields, 'product_id')) {
            throw new Exception('There was a problem updating');
        }
        
    }

    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function data(){
        return $this->_data;
    }

    public function fetchByCategory($category_id){

        $group = $this->_db->get('products', array('category_id', '=', $category_id));

        if($group->count()) {
            $this->$_data = $group;
            $this->$_data->count();
            return true;
        } else {
            return false;
        }

    }

    public function count(){
        return $this->_count;
    }


    public function getAll() {

        $data = $this->_db->fetchAll("products");

        if(count($data)) {
            $this->_data = $this->_db->results();
            $this->_count = $this->_db->count();
            return true;
        }

    }
}

?>