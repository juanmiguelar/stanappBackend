
<?php

class NapSecure{
    
    private $doorKey = 'yHn4GFvxara3mCtixb5NCKsjuofryA7wtavAQUMcykqhWlRspsgNrUrch7gj';

    function encryptIt( $q ) {
        $qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }
    
    function decryptIt( $q ) {
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }
}

// $nap = new NapSecure();
// $string = 'Migue :3';

// $en = $nap->encryptIt($string);
// $de = $nap->decryptIt($en);

// echo $en . '<br/>' . $de;


?>