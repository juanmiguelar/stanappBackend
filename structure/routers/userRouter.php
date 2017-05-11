<?php

    require_once "patch.php";
    require_once "../models/userModel.php";
    
    $postdata = file_get_contents("php://input");
     if (isset($postdata)) {
        $request = json_decode($postdata);
        $method = $request->method;
         
        $user = new User();
         
         if(isset($method)){
            echo $user->$method($request);
         }else{
             
            echo $user->index(); 
         }
    }

?>