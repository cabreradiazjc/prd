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
            case "nuevo_svt";
                echo $this->nuevo_svt();
                break;
        }
    }

    function prepararConsultaUsuario($opcion) {
        $consultaSql = "call sp_incidencias(";
        $consultaSql .= "'" . $opcion . "')";
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
        $consultaSql = "INSERT INTO incidencias(svt_nro_env,svt_ambiente,svt_origen,svt_motivo,svt_fec_rec,svt_fec_eje,svt_funcional,svt_tecnico,svt_emergencia,svt_observaciones,svt_estado) VALUES (";
        $consultaSql .= "'" . $this->param['param_nroenvio'] . "',";
        $consultaSql .= "'" . $this->param['param_ambiente'] . "',";
        $consultaSql .= "'" . $this->param['param_origen'] . "',";
        $consultaSql .= "'" . $this->param['param_motivo'] . "',";
        $consultaSql .= "'" . $this->param['param_recepcion_fecha'] . "',";
        $consultaSql .= "'" . $this->param['param_ejecucion_fecha'] . "',";
        $consultaSql .= "'" . $this->param['param_responsable_funcional'] . "',";
        $consultaSql .= "'" . $this->param['param_responsable_tecnico'] . "',";
        $consultaSql .= "'" . $this->param['param_emergencia'] . "',";
        $consultaSql .= "'" . $this->param['param_alertas'] . "',";
        $consultaSql .= "'1')";

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

}
?>

