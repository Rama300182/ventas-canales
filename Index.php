

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

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Including Font Awesome CSS from CDN to show icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery-1.9.1.min.js"></script>


<style>

	body{
	padding:20px 20px;
	}

	.results tr[visible='false'],
	.no-result{
	display:none;
	}

	.results tr[visible='true']{
	display:table-row;
	}

	.counter{
	padding:8px; 
	color:#ccc;
	}

</style>


<?php
	$año = date("Y");
	?>
<br/><br/>
        <div align="center">
		   	<h1>Direccionario</h1>
		   <br/>

		

</head>	
<body>


<br/>

<div class="form-group pull-right">
    <input type="text" class="search form-control" placeholder="What you looking for?">
</div>
<span class="counter pull-right"></span>
<table class="table table-hover table-bordered results">

 <thead>
  <table id="mytable">
     <tr class="header">
      <th class="bg-primary" style="color: white; width:3%;" scope="col">Nº sucursal</th>
      <th class="bg-primary" style="color: white; width:4%;" scope="col">Código cliente</th>
      <th class="bg-primary" style="color: white; width:5%;" scope="col">Sucursal</th>
      <th class="bg-primary" style="color: white; width:10%;" scope="col">Dirección</th>
	  <th class="bg-primary" style="color: white; width:6%;" scope="col">Teléfono</th>
    </tr>
  </thead>
	
	<?php
	
	$sql = "SELECT NRO_SUCURSAL, COD_CLIENT, DESC_SUCURSAL, DIRECCION, TELEFONO FROM SUCURSALES_LAKERS
	WHERE (NRO_SUCURSAL BETWEEN '800' AND '999') AND NRO_SUCURSAL NOT IN ('907','911','913')
	AND HABILITADO = 1";
	$result = sqlsrv_query($cid_locales, $sql);
	
	// print_r($result);
	
	while($row = sqlsrv_fetch_array($result)){
	?>
	
	<tr style="font-size:smaller">
		<td style="width:3%"><?=  $row['NRO_SUCURSAL']?></td>
		<td style="width:4%"><?=  $row['COD_CLIENT']?></td>
		<td style="width:5%"><?=  $row['DESC_SUCURSAL']?></td>
		<td style="width:10%"><?=  $row['DIRECCION']?></td>
		<td style="width:6%"><?=  $row['TELEFONO']?></td>
	</tr>
   <?php
   }  
   ?>
   </div>

</table>



<script>

	$(document).ready(function() {
	$(".search").keyup(function () {
		var searchTerm = $(".search").val();
		var listItem = $('.results tbody').children('tr');
		var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
		
	$.extend($.expr[':'], {'containsi': function(elem, i, match, array){
			return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
		}
	});
		
	$(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
		$(this).attr('visible','false');
	});

	$(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
		$(this).attr('visible','true');
	});

	var jobCount = $('.results tbody tr[visible="true"]').length;
		$('.counter').text(jobCount + ' item');

	if(jobCount == '0') {$('.no-result').show();}
		else {$('.no-result').hide();}
			});
	});

</script>

</body>
</html>

