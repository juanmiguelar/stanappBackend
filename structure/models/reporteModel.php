<?php
    require_once "connector.php";

    class Reporte{
        
        private $idReporte;
        private $correo;
        private $idDireccion;
        private $id_maltrato;
        private $id_adopcion;
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
            
        }
        
        function show($request){
            $this->correo = $request->email;
            $sql = "SELECT * FROM USUARIO WHERE CORREO = '" . $this->correo . "';";
            $result = $this->con->complexQuery($sql);
            
            
            if($result[0]["TIPO"] == "supervisor"){
                $sql = "SELECT * FROM REPORTE as R join ANIMAL_MALTRATO as AD ON R.ID_MALTRATO = AD.ID_MALTRATO 
                                                    join DIRECCION as D ON R.ID_DIRECCION = D.ID_DIRECCION;";
                $result = $this->con->complexQuery($sql);
                $this->con->cerrarConexion();
                
                echo $json_response = json_encode($result);
            }else{
                // Cualquier otro usuario que no sea supervisor.
                $sql = "SELECT * FROM REPORTE as R join ANIMAL_ADOPCION as AD ON R.ID_ADOPCION = AD.ID_ADOPCION 
                                                    join DIRECCION as D ON R.ID_DIRECCION = D.ID_DIRECCION;";
                $result = $this->con->complexQuery($sql);
                $this->con->cerrarConexion();
                
                echo $json_response = json_encode($result);
            }
            
            
        }
        
        function getID($request){
            $this->idReporte = $request->id;
            
            if (is_numeric($this->idReporte)) {
                // code...
                $sql = "SELECT * FROM REPORTE as R join ANIMAL_MALTRATO as AD ON R.ID_MALTRATO = AD.ID_MALTRATO 
                                                    join DIRECCION as D ON R.ID_DIRECCION = D.ID_DIRECCION WHERE R.ID_MALTRATO=" . $this->idReporte . ";";
                $result = $this->con->complexQuery($sql);
                $this->con->cerrarConexion();
                
                echo $json_response = json_encode($result);
            }else{
                echo null;
            }
        }
        
        // Obtener todos los reportes de maltratos
        function getMaltratos(){
            $sql = "SELECT * FROM REPORTE as R join DIRECCION as D ON R.ID_DIRECCION = D.ID_DIRECCION WHERE ID_MALTRATO IS NOT NULL;";
            $result = $this->con->complexQuery($sql);
            $this->con->cerrarConexion();
            
            echo $json_response = json_encode($result);
        }
        
        // Obtener todos los reportes de adopción
        function getAdopcion(){
            $sql = "SELECT * FROM REPORTE as R join DIRECCION as D ON R.ID_DIRECCION = D.ID_DIRECCION WHERE ID_ADOPCION IS NOT NULL;";
            $result = $this->con->complexQuery($sql);
            $this->con->cerrarConexion();
            
            echo $json_response = json_encode($result);
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
            $this->con->cerrarConexion();
        }
        
        function addGeneralAdopcion($request){
            
            try {
                
                
                $this->titulo = $request->titulo;
                $this->descripcion = $request->descripcion;
                $this->id_direccion = $request->id_direccion;
                $this->id_adopcion = $request->id_adopcion;
                $this->correo = $request->correo;
                
                $sql ="INSERT INTO REPORTE(CORREO,ID_DIRECCION,ID_ADOPCION,TITULO,DESCRIPCION) "
                . "VALUES('". $this->correo . "', '". $this->id_direccion . "', '" . $this->id_adopcion . "', '" . $this->titulo . "', '" . $this->descripcion . "')"; 
                
                $result = $this->con->simpleQuery($sql);
                $this->con->cerrarConexion();
                
                echo true;    
            } catch (Exception $e) {
                echo false;
            }
            
            
        }
        
        function addGeneralMaltrato($request){
            
            //trigger exception in a "try" block
            try {
                
                $this->titulo = $request->titulo;
                $this->descripcion = $request->descripcion;
                $this->id_direccion = $request->id_direccion;
                $this->id_maltrato = $request->id_maltrato;
                $this->correo = $request->correo;
                $this->tipo = $request->tipo;
                
                $sql ="INSERT INTO REPORTE(CORREO, ID_DIRECCION, ID_MALTRATO, TITULO, DESCRIPCION, TIPO) "
                . "VALUES('". $this->correo . "', '". $this->id_direccion . "', '" 
                . $request->id_maltrato . "', '" . $this->titulo . "', '" . $this->descripcion . "', '" . $this->tipo . "' )"; 
                
                $this->con->simpleQuery($sql);
                $this->con->cerrarConexion();
                
                echo true;
            }
            //catch exception
            catch(Exception $e) {
                echo false;
            }
            
        }
        
    }

?>