<?php

include_once '../../model/conexion_model.php';

class Svt_model {

    private $param = array();
    private $conexion = null;
    private $result = null;

    function __construct() {
        $this->conexion = Conexion_Model::getConexion();
    }

    function gestionar($param) {
        $this->param = $param;
        switch ($this->param['param_opcion']) {
            case "listar_svt";
                echo $this->listar_svt();
                break;
            case "nuevo_svt";
                echo $this->nuevo_svt();
                break;
        }
    }

    function prepararConsultaUsuario($opcion) {
        $consultaSql = "call sp_svt(";
        $consultaSql .= "'" . $opcion . "')";
        //echo $consultaSql;	
        $this->result = mysqli_query($this->conexion, $consultaSql);
    }

    function listar_svt() {
        $this->prepararConsultaUsuario('opc_svt_listar');
        $i = 1;
        while ($row = mysqli_fetch_row($this->result)) {
            echo '<tr>					
                    <td style="font-size: 12px; height: 10px; width: 4%;">' . $i . '</td>	
                    <td style="font-size: 12px; height: 10px; width: 5%;"><b>' . $row[1] . '</b> <span class="label bg-red pull-right">' . $row[0] . '</span></td>
                    <td style="font-size: 12px; height: 10px; width: 19%;">' . $row[2] . '</td>
                    <td style="font-size: 12px; height: 10px; width: 10%;">' . $row[3] . '</td>
                    <td style="font-size: 12px; height: 10px; width: 10%;">' . $row[4] . '</td>
                    <td style="font-size: 12px; height: 10px; width: 10%;">' . $row[5] . '</td>
                    <td style="font-size: 12px; height: 10px; width: 8%;"><b>' . $row[6] . '</b></td>
                    <td style="font-size: 12px; height: 10px; width: 8%;"><b>' . $row[7] . '</b></td>
                    <td style="font-size: 12px; height: 10px; width: 8%;"><b>' . $row[8] . '</b></td>
                    <td style="font-size: 12px; height: 10px; width: 5%;"> <a class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-editarsvt"><i class="fa fa-edit fa-lg"></i></a> &nbsp;&nbsp; <a class="btn btn-warning btn-xs"><i class="fa fa-trash-o fa-lg"></i></a>  </td>
                 </tr>';

            $i++;
        }
    }

    function nuevo_svt() {
        $this->insertar_operacion();
        $consultaSql = "INSERT INTO svt(svt_nro_env,svt_ambiente,svt_origen,svt_motivo,svt_fec_rec,svt_fec_eje,svt_funcional,svt_tecnico,svt_emergencia,svt_observaciones,svt_estado) VALUES (";
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

