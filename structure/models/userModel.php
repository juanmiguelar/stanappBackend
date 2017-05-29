<?php
    require_once "connector.php";
    require_once "security.php";

    class User{
        private $correo;
        private $contrasenna;
        private $nombre;
        private $telefono;
        private $tipo;
        private $nap;
        private $con;
        
        // Los constructores no se pueden sobrecargar
        function __construct(){
            $this->con = new Connector();
            $this->nap = new NapSecure();
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
            
            $pass_encryp =  $this->nap->encryptIt($this->contrasenna);
            
            $sql ="INSERT INTO USUARIO(CORREO, CONTRASENNA, NOMBRE) VALUES('" . $this->correo . "', '" . $pass_encryp . "', '". $this->nombre . "')"; 
            
            if($this->con->simpleQuery($sql)){
                
                 echo 1;
            }else{
                 echo 0;
            }
        }
        
        function validarUsuario($request){
            
            $this->correo = $request->email;
            $this->contrasenna = $request->password;
            //Consultar la contrasena
            $sql ="SELECT COUNT(CORREO) AS CANTIDAD, CONTRASENNA, CORREO FROM USUARIO WHERE CORREO= '" . $this->correo . "' "; 
            $usuario = $this->con->complexQuery($sql);
            
            //Desencriptar
            $pass_decryp =  $this->nap->decryptIt($usuario[0]["CONTRASENNA"]);
            
            
            
            if($this->contrasenna == $pass_decryp){
                $usuario[0]["CONTRASENNA"] = 1;
                echo $json_response = json_encode($usuario);
            }else{
                echo $json_response = json_encode($usuario);
            }
        }
    }
?>