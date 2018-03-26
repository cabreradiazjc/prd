<?php

include_once '../../model/conexion_model.php';

class Incidencias_model {

    private $param = array();
    private $conexion = null;
    private $result = null;

    function __construct() {
        $this->conexion = Conexion_Model::getConexion();
    }

    function cerrarAbrir() {
        mysqli_close($this->conexion);
        $this->conexion = Conexion_Model::getConexion();
    }

    function gestionar($param) {
        $this->param = $param;
        switch ($this->param['param_opcion']) {
            case "listar_incidencias";
                echo $this->listar_incidencias();
                break;
            case "nuevo_incidencias";
                echo $this->nuevo_incidencias();
                break;
            case "listar_procesos";
                echo $this->listar_procesos();
                break;
            case "eliminar_incidencias";
                echo $this->eliminar_incidencias();
                break;
            case "editar_incidencias";
                echo $this->editar_incidencias();
                break;
            case "update_incidencias";
                echo $this->update_incidencias();
                break;
        }
    }

    function prepararConsultaUsuario($opcion) {
        $consultaSql = "call sp_incidencias(";
        $consultaSql .= "'" . $opcion . "','')";
        //echo $consultaSql;	
        $this->result = mysqli_query($this->conexion, $consultaSql);
    }

    function ejecutarConsultaRespuesta() {
        $respuesta = '';
        while ($fila = mysqli_fetch_array($this->result)) {
            $respuesta = $fila['respuesta'];
        }
        return $respuesta;
    }

    function listar_incidencias() {

        $this->prepararConsultaUsuario('opc_incidencias_listar');
        while ($row = mysqli_fetch_row($this->result)) {
            echo '<tr>					
                    <td style="width: 10%;"><b>' . $row[0] . '</b></td>
                    <td style="width: 10%;"><b>' . $row[1] . '</b> <br> <small>'.$row[2].'</small></td>
                    <td style="width: 10%;" class="text text-center">' . $row[3] . '</td>
                    <td style="width: 40%; font-size: 14px;" >' . $row[4] . '</td>
                    <td style="width: 10%;" class="text text-center">' . $row[5] . '</td>
                    <td style="width: 10%;"><b>' . $row[6] . '</b> <br> <small>'.$row[7].'</small></b></td>
                    
                    <td style="width: 10%; text-align: center; direction: rtl;"> 
                        <a class="btn btn-danger btn-sm text-white" onclick="eliminar('.$row[8].');"><i class="fa fa-trash"></i></a> 
                        <a class="btn btn-info btn-sm text-white" onclick="editar('.$row[8].');"><i class="fa fa-edit"></i></a> 
                    </td>
                 </tr>';


        }
    }

    function nuevo_incidencias() {

    

        $this->insertar_operacion();
        $consultaSql = "INSERT INTO incidencia(procesos_idprocesos,inc_fechaI,inc_detalle, inc_fechaF,criticidad_idcriticidad,analista) VALUES (";
        $consultaSql .= "'" . $this->param['param_procesos'] . "',";
        $consultaSql .= "'" . $this->param['param_fecha_incidencia'] . "',";
        $consultaSql .= "'" . $this->param['param_detalle'] . "',";
        $consultaSql .= "'" . $this->param['param_fecha_solucion'] . "',";
        $consultaSql .= "'" . $this->param['param_criticidad'] . "',";
        $consultaSql .= "'" . $this->param['param_user'] . "')";
        //echo $consultaSql;
        $this->result = mysqli_query($this->conexion, $consultaSql);
    }

        function insertar_operacion() 

    {
        $consultaSql = "INSERT INTO operaciones(nombreOperacion,fecha,usuario) VALUES (";
        $consultaSql.="'".$this->param['param_tarea']."',";
        $consultaSql.="now(),";
        $consultaSql.="'".$this->param['param_user']."')";

        //echo $estado;
        //echo $consultaSql;    // FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA    
        mysqli_query($this->conexion,$consultaSql);
    }

    
    function prepararConsultaProcesos($opcion) {
        $consultaSql = "call sp_procesos(";
        $consultaSql .= "'" . $opcion . "')";
        //echo $consultaSql;  
        $this->result = mysqli_query($this->conexion, $consultaSql);
    }


    function listar_procesos() {
        echo '<option>Select</option>';
        $this->prepararConsultaProcesos('opc_procesos_listar');
        while ($row = mysqli_fetch_row($this->result)) {
             echo '<option value="'.$row[0].'">'.$row[1].' - '.$row[2].'</option>';
        }
    }




    function preparar($opcion,$id) 
    {
        $consultaSql = "call sp_incidencias(";
        $consultaSql.="'".$opcion."',";
        $consultaSql.="".$id.")";
        //echo $consultaSql;    
        $this->result = mysqli_query($this->conexion,$consultaSql);
    }

    function eliminar_incidencias() {


        $this->preparar('opc_incidencias_eliminar',$this->param['param_id']);

    
    }

    function editar_incidencias() {

        $this->preparar('opc_incidencias_editar',$this->param['param_id']);

        while ($row = mysqli_fetch_row($this->result)) {
                        echo json_encode($row);
            }
    }


    function update_incidencias() {

        $consultaSql = "UPDATE incidencia set ";
        $consultaSql.="procesos_idprocesos = '".$this->param['param_procesos_edit']."',";
        $consultaSql.="inc_fechaI = '".$this->param['param_fecha_incidencia_edit']."',";
        $consultaSql.="inc_detalle = '".$this->param['param_detalle_edit']."',";
        $consultaSql.="inc_fechaF = '".$this->param['param_fecha_solucion_edit']."',";
        $consultaSql.="criticidad_idcriticidad = '".$this->param['param_criticidad_edit']."'";
        $consultaSql.=" where idincidencia = '".$this->param['param_id_edit']."'";

        echo $consultaSql;
        mysqli_query($this->conexion,$consultaSql);

    }


}
?>

