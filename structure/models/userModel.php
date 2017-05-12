<?php
    require_once "connector.php";

    class User{
        private $correo;
        private $contrasenna;
        private $nombre;
        private $telefono;
        private $tipo;
        
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
            
            $this->correo = $request->correo;
            $this->contrasenna = $request->contrasenna;
            $this->nombre = $request->nombre;
            
            $sql ="INSERT INTO USUARIO(CORREO, CONTRASENNA, NOMBRE) VALUES('" . $this->correo . "', '" . $this->contrasenna . "', '". $this->nombre . "')"; 
            
            if($this->con->simpleQuery($sql)){
                 echo $json_response = json_encode("Se ha registrado con éxito");
            }else{
                 echo $json_response = json_encode("Error");
            }
        }
        
    }

?>