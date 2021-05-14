
<?php

require 'class/rubro.php';
require 'class/venta.php';
require 'class/destino.php';
require 'class/temporadas.php';

$rubro = new Rubro();
$todosLosRubros = $rubro->traerRubros();

$destino = new Destino();
$todosLosDestinos = $destino->traerDestinos();

$temporada = new Temporada();
$todasLasTemporadas = $temporada->traerTemporadas();

$venta = new Venta();
$desde = isset($_GET['desde']) ? $_GET['desde'] : date("Y-m-d");
$hasta = isset($_GET['hasta']) ? $_GET['hasta'] : date("Y-m-d");

?>    

<html>

<head>

<div class="container">
    <div <div class="p-3 mb-2 bg-white text-secondary border-bottom">Ventas locales propios</div>
    </div>
</div>

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
</head>
<body>
<div class="container">

</head>

<body>

<?php

$hoy = date("Y-m-d");
//echo var_dump($hoy) . "<br>";
//print ($hoy);
//die();

?>


<form>

<div class="form-row">
   <div class="col-sm-2 mt-auto">
		<label class="col-sm col-form-label">Desde:</label>
			<input type="date" class="form-control form-control-sm" name="desde" value="<?=$desde?>">
		</div>
	  
		<div class="col-sm-2 mt-auto">
		<label class="col-sm col-form-label">Hasta:</label>
			<input type="date" class="form-control form-control-sm" name="hasta" value="<?=$hasta?>">
		</div>

    <div class="col-sm-2 mt-2">
      <label for="inputCity">Rubro</label>
      <select id="inputState" class="form-control form-control-sm" name="rubro">
        <option selected></option>
        <?php
      foreach($todosLosRubros as $rubro => $key){
    ?>
      <option value="<?= $key['DESCRIP'] ?>"><?= $key['DESCRIP'] ?></option>
    <?php
      }
    ?>
    </div>  

      </select>
    </div>
    <div class="col-sm-2l mt-2">
      <label for="inputState">Destino</label>
      <select id="inputState" class="form-control form-control-sm" name="destino">
        <option selected></option>
        <?php
      foreach($todosLosDestinos as $destino => $key){
    ?>
      <option value="<?= $key['DESTINO'] ?>"><?= $key['DESTINO'] ?></option>
    <?php
      }
    ?>
    </div> 
        
      </select>
    </div>
    <div class="col-sm-2l mt-2">
      <label for="inputZip">Temporada</label>
      <select id="inputState" class="form-control form-control-sm" name="temporada">
        <option selected></option>
        <?php
      foreach($todasLasTemporadas as $temporada => $key){
    ?>
      <option value="<?= $key['TEMPORADA'] ?>"><?= $key['TEMPORADA'] ?></option>
    <?php
      }
    ?>

      </select>
      </div>

    <div class="col-sm-1 mt-auto">
    <button type="submit" class="btn btn-primary" onclick="perderfoco()" id="search"><span class="fa fa-search"></span> Buscar </button>
    </div>
  </div>

 
</form>


	


    <?php

 
    if (isset($_GET['rubro'])){

      
    if ($_GET['rubro']!= ''){
      $rubro = $_GET['rubro'];}
    else {
      $rubro = '%';
    }

    if ($_GET['destino']!= ''){
        $destino = $_GET['destino'];}
    else {
    $destino = '%';
    }

    if ($_GET['temporada']!= ''){
        $temporada = $_GET['temporada'];}
    else {
        $temporada = '%';
    }
    

    $todasLasVentas = $venta->traerVentas($rubro, $destino, $temporada, $desde, $hasta);



?>

<br><br>
<table class="table table-striped table-condensed" id="mytable" data-page-length="100">
     
     <thead>
    <tr>
      <th style="width:15%;" >Sucursal</th>
      <th style="width:5%;" >Artículo</th>
      <th style="width:30%;" >Descripcion</th>
	    <th style="width:6%;" >Cantidad</th>
      <th style="width:15%;" >Rubro</th>
      <th style="width:6%;" >Temporada</th>
      <th style="width:20%;" >Destino</th>
      <th style="width:6%;" >Precio</th>
    </tr>
    </thead>

    <tbody>

    
    <?php

    $sum = 0;

    foreach($todasLasVentas as $venta => $key){
    ?>

    <?php 

    $sum += $key['CANT_VEND']; 

    ?>
    
    <tr >
      <td style="width:15%" onClick="sweet(this)"><?=  $key['DESC_SUCURSAL']?></td>
      <td style="width:5%" onClick="sweet(this)"><?=  $key['ARTICULO']?></td>
      <td style="width:30%" onClick="sweet(this)"><?=  $key['DESCRIPCION']?></td>
      <td style="width:6%" onClick="sweet(this)"><?=  $key['CANT_VEND']?></td>
      <td style="width:20%" onClick="sweet(this)"><?=  $key['RUBRO']?></td>
      <td style="width:6%" onClick="sweet(this)"><?=  $key['TEMPORADA']?></td>
      <td style="width:15%" onClick="sweet(this)"><?=  $key['DESTINO']?></td>
      <td style="width:6%" onClick="sweet(this)"><?=  "$".number_format($key['PRECIO'], 0, ".",",")?></td>
    </tr>

    <?php
     }  
    ?>
   </tbody>

   <tr>
		<td align="center"><h2>TOTAL</h2></td>
		<td>
			<h2>  <a id="cantidad"> <?= number_format($sum , 0, '', '.') ?> </a> </h2>
		</td>
	</tr>


    </table>

    <?php
    }
    ?>
 

<script src="js/sweetAlert.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" ></script>
<script src= >"https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"</script>
<script src= >"https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"</script>
<script src= >"https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"</script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>


<script>

//$(document).ready(function() {
//    $('#mytable').DataTable();
//} );

function sweet(value){

  swal(value.innerHTML);
}

$(document).ready(function() {
    $('#mytable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            
      {
        extend: 'copy',
        footer: true,
        title: 'Venta locales',
        filename: 'Ventas',
        text: '<button class="btn btn-secondary ">Copiar <i class="fa fa-copy"></i></button>'
      }
            ,
           
      {
        //Botón para Excel
        extend: 'csv',
        footer: true,
        title: 'Venta locales',
        filename: 'Ventas',
        text: '<button class="btn btn-success ">CSV <i class="fa fa-file-excel-o"></i></button>'
      }
            ,
       
      {
        //Botón para Excel
        extend: 'excel',
        footer: true,
        title: 'Venta locales',
        filename: 'Ventas',
        text: '<button class="btn btn-success ">Excel <i class="fa fa-file-excel-o"></i></button>'
      }
            
            , 
            
      {
        extend: 'pdf',
        footer: true,
        title: 'Venta locales',
        filename: 'Ventas',
        text: '<button class="btn btn-danger ">PDF <i class="fa fa-file-pdf-o"></i></button>'
      }
            
            , 
            
      {
        extend: 'print',
        footer: true,
        title: 'Venta locales',
        filename: 'Ventas',
        text: '<button class="btn btn-info ">Imprimir <i class="fa fa-print"></i></button>'
      }


        ]
    } );
} );

$(document.ready(function(){
$("#search").blur();
}));


</script>

</body>

</html>