<?php
    require_once "connector.php";

    class Reporte{
        
        private $id;
        private $correo;
        private $idDireccion;
        private $especieMaltrato;
        private $especieAdopcion;
        private $titulo;
        private $descripcion;
        private $tipo;
        private $estado;
        
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
            
            $this->id = $request->id;
            $this->correo = $request->correo;
            $this->idDireccion =$request->idDireccion;
            $this->especieMaltrato = $request->especieMaltrato;
            $this->especieAdopcion =$request->especieAdopcion;
            $this->titulo = $request->titulo;
            $this->descripcion = $request->descripcion;
            $this->tipo = $request->tipo;
            $this->estado = $request->estado;
            
            
            $sql ="INSERT INTO USUARIO(CORREO, CONTRASENNA, NOMBRE, TELEFONO, TIPO) VALUES('" . $this->correo . "', '" . $this->contrasenna . "', '". $this->nombre . "', '" . $this->telefono . "', '" . $this->tipo . "')"; 
            
            return $this->con->simpleQuery($sql);
        }
        
    }

?>