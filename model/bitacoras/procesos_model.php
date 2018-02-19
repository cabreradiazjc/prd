<?php

include_once '../../model/conexion_model.php';

class Procesos_model {

    private $param = array();
    private $conexion = null;
    private $result = null;

    function __construct() {
        $this->conexion = Conexion_Model::getConexion();
    }

    function gestionar($param) {
        $this->param = $param;
        switch ($this->param['param_opcion']) {
            case "listar_procesos";
                echo $this->listar_procesos($this->param['idcat']);
                break;
        }
    }

    function prepararConsultaUsuario($opcion,$id) {
        $consultaSql = "call sp_procesos(";
        $consultaSql .= "'" . $opcion . "',";
        $consultaSql .= "'" . $id . "')";
        echo $consultaSql;	
        $this->result = mysqli_query($this->conexion, $consultaSql);
    }

    function ejecutarConsultaRespuesta() {
        $respuesta = '';
        while ($fila = mysqli_fetch_array($this->result)) {
            $respuesta = $fila['respuesta'];
        }
        return $respuesta;
    }

    function listar_procesos($idcat) {
        $this->prepararConsultaUsuario('opc_procesos_listar',$idcat);
        while ($row = mysqli_fetch_row($this->result)) {
             echo '<option value="'.$row[0].'">'.$row[1].' - '.$row[2].'</option>';
        }
    }
}
?>

