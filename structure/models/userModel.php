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
            $this->telefono = $request->telefono;
            $this->tipo = $request->tipo;
            
            $sql ="INSERT INTO USUARIO(CORREO, CONTRASENNA, NOMBRE, TELEFONO, TIPO) VALUES('" . $this->correo . "', '" . $this->contrasenna . "', '". $this->nombre . "', '" . $this->telefono . "', '" . $this->tipo . "')"; 
            
            return $this->con->simpleQuery($sql);
        }
        
    }

?>