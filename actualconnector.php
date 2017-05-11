
<?php



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