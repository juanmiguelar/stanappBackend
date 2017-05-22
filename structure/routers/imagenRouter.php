<?php

    require_once "patch.php";
    require_once "../models/imagenModel.php";
    
    $postdata = file_get_contents("php://input");
     if (isset($postdata)) {
        $request = json_decode($postdata);
        $method = $request->method;
         
        $imagen = new Imagen();
         
         if(isset($method)){
            echo $imagen->$method($request);
         }else{
            echo $imagen->index(); 
         }
    }

?>