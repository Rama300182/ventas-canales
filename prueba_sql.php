<?php

$servidor = 'lakerbis';

$user = 'sa';
$pass = 'Axoft';

$connectionInfo = array( "Database"=>"FRANQUICIAS_LAKERS", "UID"=>"sa", "PWD"=>"Axoft");

$cid = sqlsrv_connect($servidor, $connectionInfo);

$sql = 'SELECT * FROM STA11FLD';

$query = sqlsrv_prepare($cid, $sql);

$result = sqlsrv_execute($query);

while($v=sqlsrv_fetch_array($query)){
	echo $v['IDFOLDER'].' | '.$v['DESCRIP'].'<br>';
}

sqlsrv_close($cid);


?>