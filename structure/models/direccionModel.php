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
            $response = $this->con->complexQuery("SELECT NOW();");
            echo print_r($response);
        }
        
        function add($request){
            
            $this->latitud = $request->latitud;
            $this->longitud = $request->longitud;
            
            $sql ="INSERT INTO DIRECCION(LATITUD, LONGITUD) VALUES('". $this->latitud . "', '". $this->longitud . "')"; 
            
            echo $this->con->simpleQuery($sql);
        }
        
    }

?>