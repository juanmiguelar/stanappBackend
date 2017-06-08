<?php
    require_once "connector.php";

    class Direccion{
        private $idDireccion;
        private $latitud;
        private $longitud;
        
        private $con;
        
        // Los constructores no se pueden sobrecargar
        function __construct(){
            $this->con = new Connector();
        }
        
        function set($var, $value){
            $this->$var = $value;
        }
        
        function get($var){
            return $this->$var;
        }
        
        function index(){
            $this->show();
        }
        
        function show(){
            $sql = "SELECT * FROM DIRECCION;";
            $result = $this->con->complexQuery($sql);
            
            echo $json_response = json_encode($result);
        }
        
        function getID($id){
            
            if (is_numeric($id)) {
                // code...
                $sql = "SELECT * FROM DIRECCION WHERE ID_DIRECCION=" . $id;
                $result = $this->con->complexQuery($sql);
                
                echo $json_response = json_encode($result);
            }else{
                echo null;
            }
        }
        
        function add($request){
            
            $this->latitud = $request->latitud;
            $this->longitud = $request->longitud;
            
            //Se busca si la direccion ya existe
            $sqlwhere="SELECT MAX(ID_DIRECCION) AS ID FROM DIRECCION WHERE LATITUD= " . $this->latitud . " AND LONGITUD= " . $this->longitud . " "; 
            
            $result = $this->con->complexQuery($sqlwhere);
            
            $result = ereg_replace("'", "\"", $result[0]['ID']);  
           
            //Si existe se devuelve su ID
            if($result != 0){
                // Ya encontramos la dire
                echo $result;
            }//Sino se crea la direccion y se devuelve el ID de la nueva direccion 
            else{
                $sql ="INSERT INTO DIRECCION(LATITUD, LONGITUD) VALUES(". $this->latitud . ", ". $this->longitud . ");"; 
                $result = $this->con->simpleQuery($sql);
                $result = $this->con->complexQuery($sqlwhere);
                
                $result = ereg_replace("'", "\"", $result[0]['ID']);  
                echo $result;
            }
        }
        
        
    }

?>