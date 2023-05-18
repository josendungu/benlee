<?php
/**
 * Created by Chris on 9/29/2014 3:54 PM.
 */

class DB {
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0;

    private function __construct() {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance() {
        if(!isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function fetchRecent($table, $record, $limit){
        $sql = "SELECT * FROM {$table} ORDER BY {$record} DESC LIMIT {$limit}";

        if($this->_query = $this->_pdo->prepare($sql)) {
        
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();

                $results = $this->_results;
                
                return $this;
            } else {
                $this->_error = true;
            }
        
        }

    }

    public function query($sql, $params = array()) {
        $this->_error = false;

        if($this->_query = $this->_pdo->prepare($sql)) {
            
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                
            } else {
                $this->_error = true;
            }
        }

        return $this;
    }

    public function fetchLimits($action, $table, $start, $no_records, $order){
        $sql = "{$action} FROM {$table} ORDER BY {$order} ASC LIMIT {$start}, {$no_records}";
                
            if(!$this->query($sql)->error()) {
                return $this;
            }
    }

    public function fetchByLimits($action , $table, $start, $no_records, $order, $where = array()){

        if(count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? ORDER BY {$order} DESC LIMIT {$start}, {$no_records}";
                
                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }

    }

    public function fetchSearch($sql){
        if($this->_query = $this->_pdo->prepare($sql)) {
            if($this->_query->execute()) {
                
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
                
                return true;
            } else {
                $this->_error = true;
                return false;
            }
        }
    }


    public function fetchAll($table) {
        $sql = "SELECT * FROM {$table}";
        
        if($this->_query = $this->_pdo->prepare($sql)) {
        
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();

                $results = $this->_results;
                
                return $results;
            } else {
                $this->_error = true;
            }
        
        }
       
    }

    public function emptyTable($table) {
        $sql = "DELETE * FROM {$table}";
        
        if($this->_query = $this->_pdo->prepare($sql)) {
        
            if($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();

                $results = $this->_results;
                
                return $results;
            } else {
                $this->_error = true;
            }
        
        }
    }

    public function action($action, $table, $where = array()) {
        if(count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if(in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }

        }

        return false;
    }

    public function insert($table, $fields = array()) {
        $keys = array_keys($fields);
        $values = null;
        $x = 1;

        foreach($fields as $field) {
            $values .= '?';
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }

        $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    
    public function update($table, $id, $fields, $identifier) {
        $set = '';
        $x = 1;

        foreach($fields as $name => $value) {
            $set .= "{$name} = ?";
            if($x < count ($fields)) {
                $set .= ', ';
            }
            $x++;
        }

        $sql = "UPDATE {$table} SET {$set} WHERE {$identifier} = {$id}";
        
        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function delete($table, $where) {
        return $this->action('DELETE ', $table, $where);
    }

    public function get($table, $where) {
        return $this->action('SELECT *', $table, $where);
    }

    public function results() {
        return $this->_results;
    }

    public function first() {
        $data = $this->results();
        return $data[0];
    }

    public function count() {
        return $this->_count;
    }

    public function error() {
        return $this->_error;
    }
}