<?php

    require_once "connector.php";

    class User{
        private $id;
        private $name;
        private $lastName;
        private $email;
        
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
            
            $this->name = $request->nombre;
            $this->lastName = $request->apellido;
            $this->email = $request->email;
            
            $sql ="INSERT INTO USUARIO(NOMBRE, APELLIDO, EMAIL) VALUES('" . $this->name . "', '" . $this->lastName . "', '". $this->email ."')"; 
            
            return $this->con->simpleQuery($sql);
        }
        
        
        
        
    }

?>