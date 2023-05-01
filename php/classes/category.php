<?php

class Category {
    private $_db,
            $_data,
            $_count;

    public function __construct() {

        $this->_db = DB::getInstance(); 
    
    }

   
    public function find($category = null) {

        if($category) {
            $data = $this->_db->get('category', array('category_id', '=', $category));        
            
            if($data->count()) {
                $this->_data = $this->_db->results()[0];
                return true;
            }
        }
        return false;

    }


    public function findByUrl($category_url = null) {

        if($category_url) {
            $data = $this->_db->get('category', array('category_url', '=', $category_url));        
            
            if($data->count()) {
                $this->_data = $this->_db->results()[0];
                return true;
            }
        }
        return false;

    }

    public function create($fields = array()) {
        if(!$this->_db->insert('category', $fields)) {
            throw new Exception('Sorry, there was a problem adding the category;');
        }
    }

    public function update($fields = array(), $id) {

        if(!$this->_db->update('category', $id, $fields, 'category_id')) {
            throw new Exception('There was a problem updating');
        }
    }

    public function data(){
        return $this->_data;
    }

    public function count(){
        return $this->_count;
    }

    public function fetchAll() {
    
        $data = $this->_db->fetchAll("category");

        if(count($data)) {
            $this->_data = $data;
            return true;
        }
    }
}


?>