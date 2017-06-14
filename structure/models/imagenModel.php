<?php
    require_once "connector.php";

    class Imagen{
        private $idImagen;
        private $idReporte;
        private $ruta;
        
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
            $this->con->cerrarConexion();
        }
        
        function add($request){
            
            $this->idReporte = $request->idReporte;
            $this->ruta = $request->ruta;
            
            $sql ="INSERT INTO IMAGEN(ID_REPORTE, RUTA) VALUES('". $this->idReporte . "', '". $this->ruta . "')"; 
            
            return $this->con->simpleQuery($sql);
            $this->con->cerrarConexion();
        }
        
    }

?>