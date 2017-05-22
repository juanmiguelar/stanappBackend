<?php
    require_once "connector.php";

    class Reporte{
        
        private $idReporte;
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
            $response = $this->con->complexQuery("SELECT * FROM REPORTE;");
            echo $response;
        }
        
        function add($request){
            
            $this->idReporte = $request->idReporte;
            $this->correo = $request->correo;
            $this->idDireccion =$request->idDireccion;
            $this->especieMaltrato = $request->especieMaltrato;
            $this->especieAdopcion = $request->especieAdopcion;
            $this->titulo = $request->titulo;
            $this->descripcion = $request->descripcion;
            $this->tipo = $request->tipo;
            $this->estado = $request->estado;
            
            
            $sql ="INSERT INTO REPORTE(CORREO, ID_DIRECCION, ESPECIE_MALTRATO, ESPECIE_ADOPCION, TITULO, DESCRIPCION, TIPO, ESTADO)" 
            . " VALUES('" . $this->correo . "', '" . $this->idDireccion . "', '". $this->especieMaltrato . "', '" . $this->especieAdopcion . "', '" . $this->titulo . "', '" . $this->descripcion . "', '" . $this->estado . "')"; 
            
            return $this->con->simpleQuery($sql);
        }
        
    }

?>