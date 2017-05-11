<?php
    require_once "connector.php";

    class AnimalAdopcion{
        private $especieAdopcion;
        private $raza;
        private $edad;
        private $tamanno;
        
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
            
            $this->especieAdopcion = $request->especieAdopcion;
            $this->raza = $request->raza;
            $this->edad = $request->edad;
            $this->tamanno = $request->tamanno;
            
            $sql ="INSERT INTO ANIMAL_ADOPCION(ESPECIE_ADOPCION, RAZA, EDAD, TAMANNO) "
            . "VALUES('". $this->especieAdopcion . "', '". $this->raza . "', '" . $this->edad . "', '" . $this->tamanno . "')"; 
            
            return $this->con->simpleQuery($sql);
        }
        
    }

?>