<?php 


class User {
    private $_db,
            $_data,
            $_product,
            $_count;
            
    
    public function __construct() {

        $this->_db = DB::getInstance();

    }

    public function validateAdmin($username, $password){

        $group = $this->_db->get('admin', array('username', '=', $username));

        if($this->_db->count()){
            $password_database = $this->_db->results()[0]->password;
            

            if($password_database === $password){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

            
            
    }

}
?>