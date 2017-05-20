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
               
                 echo $json_response = json_encode("true");
            }else{
                 echo $json_response = json_encode("false");
            }
        }
        
        function validarUsuario($request){
            
            $this->correo = $request->email;
            $this->contrasenna = $request->password;
            //Consultar la contrasena
            $sql ="SELECT CONTRASENNA FROM USUARIO WHERE CORREO= '" . $this->correo . "' "; 
            $pass = $this->con->complexQuery($sql);
            
            //Quitar "" y desencriptar
            $pass= str_replace('""','', $pass[0]["CONTRASENNA"]);
            $pass_decryp =  $this->nap->decryptIt($pass);
            
            //--Agregar esta linea para que funcione con esa contrasena por defecto
            //$pass_decryp="7YA4vF+4Ux0Sk7sIuGa5J7vPg0DQon";
           
            echo $json_response = json_encode($pass_decryp);
        
                
            // $sql ="SELECT COUNT(CONTRASENNA) as RESULTADO, CORREO FROM USUARIO WHERE CORREO='" . $this->correo . "' AND CONTRASENNA='" . $pass_decryp . "'"; 
            
            // $usuario = $this->con->complexQuery($sql);
            
            // // echo $json_response = json_encode($usuario[0]);
            
            // echo $json_response = json_encode($usuario[0]);
        
        }
       
    }
?>