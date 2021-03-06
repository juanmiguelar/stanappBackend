<?php
    require_once "connector.php";

    class AnimalAdopcion{
        private $idAdopcion;
        private $especieAdopcion;
        private $raza;
        private $edad;
        private $tamanno;
        private $correo;
        
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
            $sql = "SELECT * FROM ANIMAL_ADOPCION;";
            $result = $this->con->complexQuery($sql);
            $this->con->cerrarConexion();
            
            echo $json_response = json_encode($result);
        }
        
        function getID($request){
            $this->idAdopcion = $request->id;
            if (is_numeric($this->idAdopcion)) {
                // code...
                $sql = "SELECT * FROM ANIMAL_ADOPCION WHERE ID_ANIMAL_ADOPCION=" . $this->idAdopcion;
                $result = $this->con->complexQuery($sql);
                $this->con->cerrarConexion();
                
                echo $json_response = json_encode($result);
            }else{
                echo null;
            }
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
                $sqlmax = "SELECT MAX(ID_ADOPCION) AS ID FROM ANIMAL_ADOPCION";
                $idAdopcion = $this->con->complexQuery($sqlmax);;
                $response =  ereg_replace("'", "\"", $idAdopcion[0]['ID']);
                $this->con->cerrarConexion();
                echo $response;
            }else{
                $response = -1;
                $this->con->cerrarConexion();
                echo $response;
            }
            
            
        }
        
    }

?>