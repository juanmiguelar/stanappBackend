<?php

    require_once "patch.php";
    require_once "../models/direccionModel.php";
    
    $postdata = file_get_contents("php://input");
     if (isset($postdata)) {
        $request = json_decode($postdata);
        $method = $request->method;
         
        $direccion = new Direccion();
         
         if(isset($method)){
            echo $direccion->$method($request);
         }else{
            echo $direccion->index(); 
         }
    }

?>