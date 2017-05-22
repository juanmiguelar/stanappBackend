<?php

    require_once "patch.php";
    require_once "../models/reporteModel.php";
    
    $postdata = file_get_contents("php://input");
     if (isset($postdata)) {
        $request = json_decode($postdata);
        $method = $request->method;
         
        $reporte = new Reporte();
         
         if(isset($method)){
            echo $reporte->$method($request);
         }else{
            echo $reporte->index(); 
         }
    }

?>