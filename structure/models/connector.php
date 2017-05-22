<?php 

    class Connector{
        private $con;
        private $stmt;
        private $datos = array(
          "host" => "localhost",
          "user" => "juanmiguelar09",
          "pass" => "",
          "db" => "db2"
        );
        
        public function __construct(){
            $this->con = new \mysqli($this->datos['host'], $this->datos['user'], $this->datos['pass'], $this->datos['db']);
        }
        
        public function simpleQuery($sql){
            $result = $this->con->query($sql);
            if(!$result){
                return false;
            }else{
                return true;
            }
        }
        
        public function complexQuery($sql){
            $myArray = array();
            $datos = $this->con->query($sql);
            if ($datos === FALSE) {
                echo "Error";
                die(mysqli_error());
            }
            
            while($row = $datos->fetch_array(MYSQL_ASSOC)) {
                    $myArray[] = $row;
            }
            return $myArray;
        }
        
        
        /* Prevent SQLInjection beta */
        public function prepareQuery($sql){
            /* Prepared statement, stage 1: prepare */
            if (!($this->stmt = $this->con->prepare($sql))) {
                 return false;
            }
        }
        
        function bindParam($param, $value){
            /* Prepared statement, stage 2: bind and execute */
            if (!$stmt->bind_param($param, $value)) {
                return false;
            }
        }
        
        function execute(){
            if (!$this->stmt->execute()) {
                return false;
            }
        }
    }

?>