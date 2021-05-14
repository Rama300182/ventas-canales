<?php

class Venta
{

    public function traerVentas($rubro, $destino, $temporada, $desde, $hasta){
        try {

            $servidor_lakerbis = 'lakerbis';
            $conexion_locales = array( "Database"=>"LOCALES_LAKERS", "UID"=>"sa", "PWD"=>"Axoft", "CharacterSet" => "UTF-8");
            $cid_central = sqlsrv_connect($servidor_lakerbis, $conexion_locales);
             
         } catch (PDOException $e){
                 echo $e->getMessage();
         }

        $sql = "
        SELECT FECHA_VENTA, DESC_SUCURSAL, ARTICULO, DESCRIPCION, CANT_VEND, RUBRO, TEMPORADA, DESTINO, PRECIO 
        FROM SOF_STCK_VTA WHERE FECHA_VENTA BETWEEN '$desde' AND '$hasta' AND RUBRO LIKE '%$rubro' AND DESTINO LIKE '%$destino' 
        AND TEMPORADA LIKE '%$temporada'
        ";
        $stmt = sqlsrv_query( $cid_central, $sql );

        $rows = array();

        while( $v = sqlsrv_fetch_array( $stmt) ) {
            $rows[] = $v;
        }

        return $rows;
    }

}    

