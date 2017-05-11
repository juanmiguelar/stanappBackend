<?php
    require_once "connector.php";

    class AnimalMaltrato{
        private $especieMaltrato;
        private $raza;
        
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
            
            $this->especieMaltrato = $request->especieMaltrato;
            $this->raza = $request->raza;
            
            $sql ="INSERT INTO ANIMAL_MALTRATO(ESPECIE_MALTRATO, RAZA) VALUES('". $this->especieMaltrato . "', '". $this->raza . "')"; 
            
            return $this->con->simpleQuery($sql);
        }
        
    }

?>