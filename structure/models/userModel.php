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
            $this->con->cerrarConexion();
            echo print_r($response);
        }
        
        function add($request){
            
            $this->correo = $request->correo;
            $this->contrasenna = $request->contrasenna;
            $this->nombre = $request->nombre;
            
            $pass_encryp =  $this->nap->encryptIt($this->contrasenna);
            
            $sql ="INSERT INTO USUARIO(CORREO, CONTRASENNA, NOMBRE) VALUES('" . $this->correo . "', '" . $pass_encryp . "', '". $this->nombre . "')"; 
            
            if($this->con->simpleQuery($sql)){
                $this->con->cerrarConexion();
                 echo 1;
            }else{
                $this->con->cerrarConexion();
                 echo 0;
            }
        }
        
        function validarUsuario($request){
            
            $this->correo = $request->email;
            $this->contrasenna = $request->password;
            //Consultar la contrasena
            $sql ="SELECT CONTRASENNA, CORREO FROM USUARIO WHERE CORREO= '" . $this->correo . "' AND CONTRASENNA= '" . $this->nap->encryptIt($this->contrasenna) . "';"; 
            $usuario = $this->con->complexQuery($sql);
            $this->con->cerrarConexion();
            
            $cantidad = count($usuario);
            
            if ($cantidad == 1) {
                echo 1;
            }else{
                echo 0;
            }
            
        }
    }
?>