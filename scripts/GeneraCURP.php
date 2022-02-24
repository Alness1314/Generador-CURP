<?php

require 'Curp.php';

if (isset($_POST['nombres']) || isset($_POST['primer_apellido']) || isset($_POST['segundo_apellido']) || isset($_POST['dia_selected']) ||
        isset($_POST['mes_selected']) || isset($_POST['año']) || isset($_POST['sexo_selected']) || isset($_POST['edo_selected'])) {
    $nombres = $_POST['nombres'];
    $apellido1 = $_POST['primer_apellido'];
    $apellido2 = $_POST['segundo_apellido'];
    $dia = $_POST['dia_selected'];
    $mes = $_POST['mes_selected'];
    $año = $_POST['año'];
    $sexo = $_POST['sexo_selected'];
    $edo = $_POST['edo_selected'];
    if ($dia != "" && $mes != "" && $año != "" && $sexo != "" && $edo != "") {
        $curp = new Curp();
        $stringCURP = $curp->generarCURP($nombres, $apellido1, $apellido2, $dia, $mes, $año, $sexo, $edo);


        //echo '<script>alertify.alert("CURP GENERADO", "' . $stringCURP . '", function(){ alertify.success("Ok"); });</script>';
        echo '<script>alert("CURP GENERADO: '. $stringCURP .'");</script>';
    } else {
        echo '<script>alert("Llenar todos los campos.");</script>';
    }
} else {
    echo '<script>alert("Llenar todos los campos.");</script>';
}


