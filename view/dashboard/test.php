<?php  
date_default_timezone_set('America/Lima');
// Create connection to Oracle 
$conn = oci_connect("TJCAD006", "_jccd.160392", "172.20.0.24:1523/cngdb"); 
if (!$conn) {    
  $m = oci_error();    
  echo $m['message'], "n";    
  exit; 
} else {    
    //$usuario = 'TGSAA001'
    $fini = date('d/m/Y',mktime(0, 0, 0, date("m")  , date("d")-6, date("Y")));
    $ffin = date('d/m/Y');
	$sql = " SELECT DISTINCT to_char(u.z0e4gefec, 'DD/MM/YYYY') as FECHA, 
            (select  COUNT(*) from dbprod.z0e4ge op1
            where op1.z0e4gefec >= u.z0e4gefec and op1.z0e4gefec <= u.z0e4gefec and op1.z0e4gehor >='00:00:00' and op1.z0e4gehor <='23:59:59' and op1.z0e4gemen = 1) as OPERACIONES_1,  
            (select count(*) from dbprod.z0e4ge re2
            where re2.z0e4gefec >= u.z0e4gefec and re2.z0e4gefec <= u.z0e4gefec and re2.z0e4gehor >='00:00:00' and re2.z0e4gehor <='23:59:59' and re2.z0e4gemen = 1 and re2.z0e4geest<>'PC' and re2.z0e4geest<>'00') as RECHAZOS_1
          FROM dbprod.z0e4ge u
          where u.z0e4gefec>=to_date('$fini','dd/mm/yyyy') and u.z0e4gefec<= to_date('$ffin','dd/mm/yyyy')
          order by to_char(u.z0e4gefec, 'DD/MM/YYYY')";
    //echo "-----------";
    //echo $sql;
    //oci_bind_by_name($stmt, ':variable', $id, -1); 

   // oci_execute($stmt, OCI_DEFAULT); 
    $stmt = oci_parse($conn, $sql);        // Preparar la sentencia
    $ok   = oci_execute( $stmt );              // Ejecutar la sentencia
    if( $ok == true )
    {
        /* Mostrar los datos. Lo hacemos de este modo puesto que no es posible obtener el número de
           registros sin antes haber accedido a los datos mediante las funciones 'oci_fetch_*'):
        */
         if( $obj = oci_fetch_object($stmt) )
        {
            

             $jsonArray = array();
              while($obj = oci_fetch_object($stmt)) {
                $jsonArrayItem = array();
                $submitdate = str_replace("/","-",$obj->FECHA);
                $jsonArrayItem['FECHA'] = date('M j',strtotime($submitdate));
                $jsonArrayItem['OPERACIONES'] = $obj->OPERACIONES_1;
                 $jsonArrayItem['RECHAZOS'] = $obj->RECHAZOS_1;
                //append the above created object into the main array.
                array_push($jsonArray, $jsonArrayItem);

              }
              echo json_encode($jsonArray);
        }
        else
            echo "<p>No se encontraron personas</p>";
    }
    else
     oci_free_statement($stmt);    // Liberar los recursos asociados a una sentencia o cursor

} 
 
// Close the Oracle connection 
oci_close($conn); 
?>