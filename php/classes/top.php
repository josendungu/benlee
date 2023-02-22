<?php
class Top {
    private $_db,
            $_data,
            $_count;

    public function __construct() {

        $this->_db = DB::getInstance(); 
    
    }

    public function find($product_id = null) {

        if($product_id) {
            $data = $this->_db->get('top_rated', array('product_id', '=', $product_id));        
            
            if($this->_db->count()) {
                $this->_data = $this->_db->results()[0];
                return true;
            }
        }
        return false;

    }

    public function add($product_id){

        $fields = array('product_id' => $product_id);
        
        if(!$this->_db->insert('top_rated', $fields)) {
            throw new Exception('Sorry, there was a problem adding the products;');
        }
    }

    public function fetchTopRated($limit){
        $group = $this->_db->fetchRecent('top_rated', 'rated_id', $limit);

        if($this->_db->count()){
            $this->_data = $this->_db->results();
            return true;
        } else {
            return false;
        }
    }

    public function clearAll(){
        $group = $this->_db->emptyTable('top_rated');

        if($this->_db->count()){
            return true;
        } else {
            return false;
        }
    }


    public function remove($product_id){

        $fields = array('product_id', '=', $product_id);

        $group = $this->_db->delete('top_rated', $fields);

        return !$this->_db->error();

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