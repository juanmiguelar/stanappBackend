<?php
    require_once "connector.php";

    class AnimalMaltrato{
        private $idMaltrato;
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
            $this->show();
        }
        
        function show(){
            $sql = "SELECT MAX(ID_MALTRATO) AS ID FROM ANIMAL_MALTRATO;";
            $result = $this->con->complexQuery($sql);
            $this->con->cerrarConexion();
            
            echo $json_response = json_encode($result);
        }
        
        function getID($request){
            
            $this->idMaltrato = $request->id;
            
            if (is_numeric($this->idMaltrato)) {
                // code...
                $sql = "SELECT * FROM ANIMAL_MALTRATO WHERE ID_ANIMAL_MALTRATO=" . $this->idMaltrato;
                $result = $this->con->complexQuery($sql);
                $this->con->cerrarConexion();
                
                echo $json_response = json_encode($result);
            }else{
                echo null;
            }
        }
        
        function add($request){
            
            $this->especieMaltrato = $request->especieMaltrato;
            $this->raza = $request->raza;
            
            $sql ="INSERT INTO ANIMAL_MALTRATO(ESPECIE_MALTRATO, RAZA) VALUES('". $this->especieMaltrato . "', '". $this->raza . "')"; 
            
            $result = $this->con->simpleQuery($sql);
            $this->con->cerrarConexion();
            
            if ($result) {
                $sqlmax = "SELECT MAX(ID_MALTRATO) AS ID FROM ANIMAL_MALTRATO";
                $idMaltrato = $this->con->complexQuery($sqlmax);;
                $response =  ereg_replace("'", "\"", $idMaltrato[0]['ID']);
                echo $response;
            }else{
                $response = -1;
                echo $response;
            }
        }
        
    }

?>