<?php

include_once '../../model/conexion_model.php';

class Networker_model {

    private $param = array();
    private $conexion = null;
    private $result = null;

    function __construct() {
        $this->conexion = Conexion_Model::getConexion();
    }

    function gestionar($param) {
        $this->param = $param;
        switch ($this->param['param_opcion']) {
            case "listar_networker";
                echo $this->listar_networker();
                break;
        }
    }

    function prepararConsultaUsuario($opcion) {
        $consultaSql = "call sp_networker(";
        $consultaSql .= "'" . $opcion . "')";
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

    function listar_networker() {
        $this->prepararConsultaUsuario('opc_networker_listar');
        $i = 1;
        while ($row = mysqli_fetch_row($this->result)) {
            echo '<tr>					
                    <td style="font-size: 12px; height: 10px; width: 4%;">' . $i . '</td>	
                    <td style="font-size: 12px; height: 10px; width: 15%;"><b>' . $row[0] . '</b></td>
                    <td style="font-size: 12px; height: 10px; width: 15%;">' . $row[1] . '</td>
                    <td style="font-size: 12px; height: 10px; width: 15%;">' . $row[2] . '</td>
                    <td style="font-size: 12px; height: 10px; width: 15%;"><b>' . $row[3] . '</b></td>
                    <td style="font-size: 12px; height: 10px; width: 20%;"> <a class="btn btn-info btn-xs"><i class="fa fa-edit fa-lg"></i></a> &nbsp;&nbsp; <a class="btn btn-warning btn-xs"><i class="fa fa-trash-o fa-lg"></i></a>  </td>
                 </tr>';

            $i++;
        }
    }
}
?>

