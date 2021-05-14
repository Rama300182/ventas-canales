
<?php

try {

   $servidor_lakerbis = 'lakerbis';
   $conexion_locales = array( "Database"=>"LOCALES_LAKERS", "UID"=>"sa", "PWD"=>"Axoft", "CharacterSet" => "UTF-8");
   $cid_locales = sqlsrv_connect($servidor_lakerbis, $conexion_locales);
    
} catch (PDOException $e){
        echo $e->getMessage();
}

?>


<html>

<head>
<?php
	$año = date("Y");

echo "<br/>
        <br/>
		  <div align = center> <font size = 16 face = arial> <strong> Direccionario XL $año </strong><br/> <br/>";
?>
</head>	
<body>
<table>
	<tr>
		<td>Nº sucursal</td>
		<td>Código cliente</td>
		<td>Sucursal</td>
		<td>Dirección</td>
		<td>Teléfono</td>
	</tr>
	<?php
	
	$sql = "SELECT NRO_SUCURSAL, COD_CLIENT, DESC_SUCURSAL, DIRECCION, TELEFONO FROM SUCURSALES_LAKERS";
	$result = sqlsrv_query($cid_locales, $sql);
	
	// print_r($result);
	
	while($row = sqlsrv_fetch_array($result)){
	?>
	
	<tr>
		<td><?=  $row['NRO_SUCURSAL']?></td>
		<td><?=  $row['COD_CLIENT']?></td>
		<td><?=  $row['DESC_SUCURSAL']?></td>
		<td><?=  $row['DIRECCION']?></td>
		<td><?=  $row['TELEFONO']?></td>
	</tr>
   <?php
   }  
   ?>



</table>
</body>
</html>

