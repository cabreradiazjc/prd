<?php  

// Create connection to Oracle 
$conn = oci_connect($_DB_user_oc, $_DB_pass_oc, $_DB_host_oc); 

// Create connection to Oracle 
$conn = oci_connect("TJCAD006", "_jccd.160392", "172.20.0.24:1523/cngdb"); 
 
if (!$conn) {    
  $m = oci_error();    
  echo $m['message'], "n";    
  exit; 
} else {    
    //$usuario = 'TGSAA001'
    $fini = '01/01/2017';
    $ffin = '18/01/2017';
	$sql = " SELECT DISTINCT to_char(u.z0e4gefec, 'DD/MM/YYYY') as FECHA, 
            (select  COUNT(*) from dbprod.z0e4ge op1
            where op1.z0e4gefec >= u.z0e4gefec and op1.z0e4gefec <= u.z0e4gefec and op1.z0e4gehor >='00:00:00' and op1.z0e4gehor <='05:59:59' and op1.z0e4gemen = 1) as OPERACIONES_1,  
            (select count(*) from dbprod.z0e4ge op2
            where op2.z0e4gefec >= u.z0e4gefec and op2.z0e4gefec <= u.z0e4gefec and op2.z0e4gehor >='00:00:00' and op2.z0e4gehor <='23:59:59' and op2.z0e4gemen = 1) as OPERACIONES_2,
            (select count(*) from dbprod.z0e4ge re1
            where re1.z0e4gefec >= u.z0e4gefec and re1.z0e4gefec <= u.z0e4gefec and re1.z0e4gehor >='00:00:00' and re1.z0e4gehor <='05:59:59' and re1.z0e4gemen = 1 and re1.z0e4geest<>'PC' and re1.z0e4geest<>'00') as RECHASOS_1, 
            (select count(*) from dbprod.z0e4ge re2
            where re2.z0e4gefec >= u.z0e4gefec and re2.z0e4gefec <= u.z0e4gefec and re2.z0e4gehor >='00:00:00' and re2.z0e4gehor <='23:59:59' and re2.z0e4gemen = 1 and re2.z0e4geest<>'PC' and re2.z0e4geest<>'00') as RECHASOS_2
          FROM dbprod.z0e4ge u
          where u.z0e4gefec>=to_date('$fini','dd/mm/yyyy') and u.z0e4gefec<= to_date('$ffin','dd/mm/yyyy')
          order by to_char(u.z0e4gefec, 'DD/MM/YYYY')";
    echo "-----------";
    echo $sql;
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
            echo "<p/>LISTADO DE PERSONAS<br/>";
            echo "===================<p />";
            echo "<table border='1'>
					<thead>
                        <th> FECHA </th>
						<th>OPERACIONES_1</th>
						<th>OPERACIONES_2 </th>
                        <th>RECHASOS_1</th>
                        <th>RECHASOS_2</th>
					</thead>

					<tbody>";
            // Recorrer el resource y mostrar los datos (HAY QUE PONER LOS NOMBRES DE LOS CAMPOS EN MAYÚSCULAS):
             do
             {
             	echo "<tr>
                            <td>".$obj->FECHA."</td>
							<td>".$obj->OPERACIONES_1."</td>
							<td>".$obj->OPERACIONES_2."</td>
                            <td>".$obj->RECHASOS_1."</td>
							<td>".$obj->RECHASOS_2."</td>
						</tr>";

                //echo $obj->idrol." - ".$obj->rol_descripcion." - ".$obj->rol_abrevitura."<br />";
             } while( $obj = oci_fetch_object($stmt) );

             echo "</tbody>
				  </table>";
            // Mostrar el número de registros:
             echo "<p>(".oci_num_rows($stmt).") fila(s) encontrado(s)</p>";
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