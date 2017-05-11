
<?php
 //http://stackoverflow.com/questions/18382740/cors-not-working-php
 if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
 
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
 
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
 
        exit(0);
    }
//http://stackoverflow.com/questions/15485354/angular-http-post-to-php-and-undefined

$postdata = file_get_contents("php://input");
 if (isset($postdata)) {
 $request = json_decode($postdata);
 $nombre = $request->nombre;
 $apellido = $request->apellido;
 $email = $request->email;
 
    /*$array = insert($sql);
	echo $array;*/
}
function insert($query){
    
    $host = "127.0.0.1";
    $user = "juanmiguelar09";
    $pass = "";
    $db = "db";
    	 
    $mysqli = new mysqli($host, $user, $pass, $db);
    
    if ($mysqli->connect_error) {
        echo "Falló la conexión: %s\n", $mysqli->connect_error;
        exit();
    }else{
        
        $result = $mysqli->query($query) or die($mysqli->error.__LINE__);
       
       
        $arr = array();
        if($result->num_rows > 0) {
        	while($row = $result->fetch_assoc()) {
        		$arr[] = $row;	
        	}
        }
        echo $json_response = json_encode($arr);
    }
}


?>