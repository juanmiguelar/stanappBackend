<?php

    require_once "patch.php";
    require_once "../models/animalAdopcionModel.php";
    
    $postdata = file_get_contents("php://input");
     if (isset($postdata)) {
        $request = json_decode($postdata);
        $method = $request->method;
         
        $adopcion = new AnimalAdopcion();
         
         if(isset($method)){
            echo $adopcion->$method($request);
         }else{
            echo $adopcion->index(); 
         }
    }

?>