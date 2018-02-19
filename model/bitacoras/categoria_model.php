<?php

include_once '../../model/conexion_model.php';

class Categoria_model {

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
            case "listar_categoria";
                echo $this->listar_categoria();
                break;
        }
    }

    function prepararConsultaUsuario($opcion) {
        $consultaSql = "call sp_categorias(";
        $consultaSql .= "'" . $opcion . "')";
        //echo $consultaSql;	
        $this->result = mysqli_query($this->conexion, $consultaSql);
    }

    function listar_categoria() {
        $this->prepararConsultaUsuario('opc_categoria_listar');
        while ($row = mysqli_fetch_row($this->result)) {
            echo '<option value="'.$row[0].'">'.$row[1].'</option>';
        }
    }
}
?>

