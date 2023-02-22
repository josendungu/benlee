<?php
class Best {
    private $_db,
            $_data,
            $_count;

    public function __construct() {

        $this->_db = DB::getInstance(); 
    
    }

    public function find($product_id = null) {

        if($product_id) {
            $data = $this->_db->get('best_selling', array('product_id', '=', $product_id));        
            
            if($this->_db->count()) {
                $this->_data = $this->_db->results()[0];
                return true;
            }
        }
        return false;

    }

    public function add($product_id){

        $fields = array('product_id' => $product_id);

        if(!$this->_db->insert('best_selling', $fields)) {
            throw new Exception('Sorry, there was a problem adding the products;');
        }
    }

    public function fetchBestSelling($limit){
        $group = $this->_db->fetchRecent('best_selling', 'best_id', $limit);

        if($this->_db->count()){
            $this->_data = $this->_db->results();
            return true;
        } else {
            return false;
        }
    }

    public function remove($product_id){

        $fields = array('product_id', '=', $product_id);

        $group = $this->_db->delete('best_selling', $fields);

        return !$this->_db->error();

    }

    public function clearAll(){
        $group = $this->_db->emptyTable('best_selling');

        if($this->_db->count()){
            return true;
        } else {
            return false;
        }
    }

    public function count(){
        return $this->_count;
    }

    public function exists() {
        return !empty($this->_data);
    }

    public function data(){
        return $this->_data;
    }
}

?>