<?php
//conexion ala base de datos
require 'Conexion.php';

class Persona {

    //constructor
    public function __construct() {
        
    }

    //metodo para consultar datos de una persona
    public function listarAll() {
        $sql = "SELECT * FROM datos";
        return consulta($sql);
    }

    //metodo para consultar datos de una persona
    public function mostrarDatos($idPersona) {
        $sql = "SELECT * FROM datos WHERE id = '$idPersona'";
        return consultaFila($sql);
    }

}
