
<?php

try {

   $servidor_lakerbis = 'lakerbis';
$conexion_locales = array( "Database"=>"LOCALES_LAKERS", "UID"=>"sa", "PWD"=>"Axoft", "CharacterSet" => "UTF-8");
$cid_locales = sqlsrv_connect($servidor_lakerbis, $conexion_locales);
    
} catch (PDOException $e){
        echo $e->getMessage();
}

?>


