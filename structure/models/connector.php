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
        
        public function abrirConexion(){
            $this->con = new \mysqli($this->datos['host'], $this->datos['user'], $this->datos['pass'], $this->datos['db']);
        }
        
        public function cerrarConexion(){
            $this->con->Close();
        }
        
        public function simpleQuery($sql){
            $this->abrirConexion();
            $result = $this->con->query($sql);
            return $result;
        }
        
        public function complexQuery($sql){
            $myArray = array();
            $this->abrirConexion();
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
        
        public function simpleMultiQuery($sql){
           $datos = $this->con->multi_query($sql);
           
            if ($datos == FALSE) {
                echo "Error";
                die(mysqli_error());
            }
            
            
            return $datos;
            
            // /* execute multi query */
            // if ($mysqli->multi_query($sql)) {
            //     do {
            //         /* store first result set */
            //         if ($result = $mysqli->store_result()) {
            //             while ($row = $result->fetch_row()) {
            //                 return $row[0];
            //                 $result->free();
            //                 /* close connection */
            //                 $mysqli->close();
            //             }
            //         }
            //     } while ($mysqli->next_result());
            // }
            
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