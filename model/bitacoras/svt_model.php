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
             case "svt_resumen";
                echo $this->svt_resumen();
                break;
            case "eliminar_svt";
                echo $this->eliminar_svt();
                break;
        }
    }

    function prepararConsultaUsuario($opcion,$id) {
        $consultaSql = "call sp_svt(";
        $consultaSql .= "'" . $opcion . "',";
        $consultaSql .= "'" . $id . "')";
        //echo $consultaSql;	
        $this->result = mysqli_query($this->conexion, $consultaSql);
    }

    function listar_svt() {
        $this->prepararConsultaUsuario('opc_svt_listar','');
      
        while ($row = mysqli_fetch_row($this->result)) {

            switch($row[6])
            {
                case "APLICADO";
                    $estado = '<span class="label label-success">' . $row[6] . '</span>';
                    break;
                case "EN PROCESO";
                    $estado = '<span class="label label-inverse">' . $row[6] . '</span>';
                    break;
                case "RECHAZADO";
                    $estado = '<span class="label label-danger">' . $row[6] . '</span>';
                    break;
                case "DEVUELTO";
                    $estado = '<span class="label label-warning">' . $row[6] . '</span>';
                    break;

            }


            echo '<tr>					
                    
                    <td style="width: 5%;">' . $row[0] . ' </td>
                    <td style="width: 10%;">' . $row[1] . '</td>
                    <td style="width: 20%;">' . $row[2] . '</td>
                    <td style="width: 15%;">' . $row[3] . '</td>
                    <td style="width: 10%;">' . $row[4] . '</td>
                    <td style="width: 10%;"><b>' . $row[5] . '</b></td>
                    <td style="width: 10%;"><b>' . $estado . '</b></td>
                    <td style="width: 10%;"><b>' . $row[7] . '</b></td>
                    <td style="width: 10%; text-align: center; direction: rtl;"> 
                        <a class="btn btn-inverse btn-sm text-white" onclick="detalles('.$row[8].');"><i class="fa fa-bars"></i></a> 
                        <a class="btn btn-danger btn-sm text-white" onclick="eliminar('.$row[8].');"><i class="fa fa-trash"></i></a> 
                        <a class="btn btn-info btn-sm text-white" onclick="editar('.$row[8].');"><i class="fa fa-edit"></i></a> 

                    </td>

                 </tr>';

           
        }
    }


    function eliminar_svt() {


        $this->prepararConsultaUsuario('opc_svt_eliminar',$this->param['param_id']);

      
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

    function insertar_operacion() {

        $consultaSql = "INSERT INTO operaciones(nombreOperacion,fecha,usuario) VALUES (";
        $consultaSql.="'".$this->param['param_tarea']."',";
        $consultaSql.="now(),";
        $consultaSql.="'".$this->param['param_user']."')";

        //echo $estado;
        //echo $consultaSql;    // FALTA VER AKI EL REGISTRO PREGUNTAR A MILUSKA    
        mysqli_query($this->conexion,$consultaSql);
    }


    function svt_resumen() {

        $this->prepararConsultaUsuario('opc_svt_resumen','');
        
        while ($row = mysqli_fetch_row($this->result)) {

            echo ' <!-- Total de SVT -->
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-inverse card-info">
                        <div class="box bg-info text-center">
                            <h1 class="font-light text-white">' . $row[0] . '</h1>
                            <h6 class="text-white">Total </h6>
                        </div>
                    </div>
                </div>

                <!-- Total de Aplicados -->
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-primary card-inverse">
                        <div class="box text-center">
                            <h1 class="font-light text-white">' . $row[1] . '</h1>
                            <h6 class="text-white">Aplicados</h6>
                        </div>
                    </div>
                </div>

                <!-- Total de Emergencia -->
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-inverse card-success">
                        <div class="box text-center">
                            <h1 class="font-light text-white">' . $row[2] . '</h1>
                            <h6 class="text-white">Emergencia</h6>
                        </div>
                    </div>
                </div>

                <!-- Total de sustentos -->
                <div class="col-md-6 col-lg-3 col-xlg-3">
                    <div class="card card-inverse card-dark">
                        <div class="box text-center">
                            <h1 class="font-light text-white">' . $row[3] . '</h1>
                            <h6 class="text-white">Sustentos</h6>
                        </div>
                    </div>
                </div>
                ';

           
        }
    }




}
?>

