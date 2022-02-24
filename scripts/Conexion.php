<?php
require_once 'Globales.php';;

//iniciamos la conexion ala base de datos
$conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//validacion si ocurre un error
if (mysqli_connect_errno()) {
    printf("Fallo la conexion ala base de datos: ", mysqli_connect_error());
    exit();
}


if (!function_exists('consulta')) {

    function consulta($sql) {
        global $conexion;
        $query = $conexion->query($sql);
        return $query;
    }

    function consultaFila($sql) {
        global $conexion;
        $query = $conexion->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }

    function limpiarCadena($str) {
        global $conexion;
        $str = mysqli_real_escape_string($conexion, trim($str));
        return htmlspecialchars($str);
    }

}