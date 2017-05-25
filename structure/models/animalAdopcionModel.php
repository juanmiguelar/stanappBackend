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
            $this->raza='Gatos';
            $sqlmax = "SELECT MAX(ID_ADOPCION) AS ID FROM ANIMAL_ADOPCION WHERE RAZA='". $this->raza . "'";
            $response = $this->con->complexQuery($sqlmax);
            echo print($sqlmax);
        }
        
        function add($request){
            
            $this->especieAdopcion = $request->especieAdopcion;
            $this->raza = $request->raza;
            $this->edad = $request->edad;
            $this->tamanno = $request->tamanno;
            
            $sql ="INSERT INTO ANIMAL_ADOPCION(ESPECIE_ADOPCION, RAZA, EDAD, TAMANNO) "
            . "VALUES('". $this->especieAdopcion . "', '". $this->raza . "', '" . $this->edad . "', '" . $this->tamanno . "')"; 
            
            $result = $this->con->simpleQuery($sql);
            
            if ($result) {
                $sqlmax = "SELECT MAX(ID_ADOPCION) AS ID FROM ANIMAL_ADOPCION WHERE RAZA='". $this->raza . "'";
                $idAdopcion = $this->con->complexQuery($sqlmax);;
                $response =  ereg_replace("'", "\"", $idAdopcion[0]['ID']);
                echo $response;
            }else{
                $response = -1;
                echo $response;
            }
            
        }
        
    }

?>