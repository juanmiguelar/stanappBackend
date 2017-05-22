<?php

    require_once "patch.php";
    require_once "../models/animalMaltratoModel.php";
    
    $postdata = file_get_contents("php://input");
     if (isset($postdata)) {
        $request = json_decode($postdata);
        $method = $request->method;
         
        $maltrato = new AnimalMaltrato();
         
         if(isset($method)){
            echo $maltrato->$method($request);
         }else{
            echo $maltrato->index(); 
         }
    }

?>