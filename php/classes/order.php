<?php 

class Order {
    private $_db,
            $_data,
            $_product,
            $_count;
            
    
    public function __construct() {

        $this->_db = DB::getInstance();

    }

    public function data(){
        return $this->_data;
    }

    public function count(){
        return $this->_count;
    }

    public function find($order = null) {

        if($order) {
            $data = $this->_db->get('orders', array('order_id', '=', $order));
        
            if($this->_db->count()) {  
                $this->_data = $data->first();
                return true;
            }

        }
        return false;

    }

    public function markOrder($order_id){

        $fields = array(
            "is_complete" => 1
        );
        if(!$this->_db->update('orders', $order_id, $fields, 'order_id')) {
            throw new Exception('There was a problem updating');
        }
    }

    public function getPending(){
        $data = $this->_db->get("orders", array("is_complete", "=" , 0));

        if($this->_db->count()){
            $this->_data = $this->_db->results();
            $this->_count = $this->_db->count();
            return true;
        }
    }


    public function getAll() {

        $data = $this->_db->fetchAll("orders");

        if(count($data)) {
            $this->_data = $this->_db->results();
            $this->_count = $this->_db->count();
            return true;
        } 

    }

    public function create($fields = array()) {

        if(!$this->_db->insert('orders', $fields)) {
            throw new Exception('Sorry, there was a problem adding the products;');
        }

    }



}

?>