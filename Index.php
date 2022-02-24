<?php
require './scripts/Persona.php';
$nombre = "";
$apellido_paterno = "";
$apellido_materno = "";
$dia = "";
$mes = "";
$year = "";
$sexo = "";
$edo = "";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <!--Optimizacion movil-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Generador CURP</title>
        <!--declaracion del manifest-->
        <link rel="manifest" href="manifest.json">
        <meta name="theme-color" content="#f1f3f4">
        <!--deteccion de icono de la app-->
        <link rel="icon" type="image/png" sizes="72x72" href="images/icons/icon-72x72.png">
        <link rel="icon" type="image/png" sizes="96x96" href="images/icons/icons/icon-96x96.png">
        <link rel="icon" type="image/png" sizes="128x128" href="images/icons/icons/icon-128x128.png">
        <link rel="icon" type="image/png" sizes="144x144" href="images/icons/icons/icon-144x144.png">
        <link rel="icon" type="image/png" sizes="152x152" href="images/icons/icons/icon-152x152.png">
        <link rel="icon" type="image/png" sizes="192x192" href="images/icons/icons/icon-192x192.png">
        <link rel="icon" type="image/png" sizes="348x348" href="images/icons/icons/icon-384x384.png">
        <link rel="icon" type="image/png" sizes="512x512" href="images/icons/icons/icon-512x512.png">
        <!--Import Google Icon-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <!--JQuery Import-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!--JavaScript materialize-->
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--hoja de estilos-->
        <link type="text/css" rel="stylesheet" href="css/StyleSheet.css">
        <!--js file-->
        <script type="text/javascript" src="js/peticiones.js"></script>
        
    </head>

    <body>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper white">
                    <span class="black-text titleNavBar">GENERADOR CURP</span>
                </div>
            </nav>
        </div>

        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div class="card cardMargin">
                        <div class="card-content">
                            <form id="formulario" name="formulario" method="post" onsubmit="return send_data('Index.php', 'formulario', 'resp');">
                                <div class="row">
                                    <div class="col s12 input-field">
                                        <select id="data_selector" name="data_selector">
                                            <option value="" disabled selected>Seleccionar Persona</option>
                                            <?php
                                            $personas = new Persona();
                                            $respuesta = $personas->listarAll();
                                            while ($row = $respuesta->fetch_object()) {
                                                echo '<option value="' . $row->id . '">' . $row->nombres . ' ' . $row->apellido1 . ' ' . $row->apellido2 . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <label>Cargar Datos</label>
                                    </div>
                                    <div class="col s12">
                                        <button class="btn waves-effect waves-light right sizeButton" type="submit" name="cargar">Buscar Persona</button>
                                    </div>
                                    <div class="col s12 divider marginDivider"></div>
                                </div>
                            </form>
                            <div id="resp">

                            </div>

                            <?php
                            if (isset($_POST['data_selector'])) {
                                $id_selected = $_POST['data_selector'];
                                $persona = new Persona();
                                $respuesta = $persona->mostrarDatos($id_selected);
                                $nombre = $respuesta['nombres'];
                                $apellido_paterno = $respuesta['apellido1'];
                                $apellido_materno = $respuesta['apellido2'];
                                $dia = $respuesta['dia'];
                                $mes = $respuesta['mes'];
                                $year = $respuesta['year_na'];
                                $sexo = $respuesta['sexo'];
                                $edo = $respuesta['estado'];
                            }
                            ?>
                            <form id="form_curp" name="form_curp" method="post" onsubmit="return send_data('scripts/GeneraCURP.php', 'form_curp', 'resp_curp');">
                                <div class="row">
                                    <div class="col s12">
                                        <h5>Datos Personales</h5>
                                    </div>
                                    <div class="col s12 m6 l6 input-field">
                                        <input id="nombres" name="nombres" value="<?php echo $nombre; ?>" type="text" class="validate">
                                        <label for="nombres">Nombre(s)</label>
                                    </div>
                                    <div class="col s12 m6 l6 input-field">
                                        <input id="primer_apellido" name="primer_apellido" value="<?php echo $apellido_paterno; ?>" type="text" class="validate">
                                        <label for="primer_apellido">Primer Apellido</label>
                                    </div>
                                    <div class="col s12 m6 l6 input-field">
                                        <input id="segundo_apellido" name="segundo_apellido" value="<?php echo $apellido_materno; ?>" type="text" class="validate">
                                        <label for="segundo_apellido">Segundo Apellido</label>
                                    </div>
                                    <div class="col s12 m6 l6 input-field">
                                        <select id="dia_selected" name="dia_selected">
                                            <option value="" disabled selected>Seleccionar el dia</option>
                                            <option value="01" <?= $dia == '01' ? ' selected="selected"' : ''; ?>>01</option>
                                            <option value="02" <?= $dia == '02' ? ' selected="selected"' : ''; ?>>02</option>
                                            <option value="03" <?= $dia == '03' ? ' selected="selected"' : ''; ?>>03</option>
                                            <option value="04" <?= $dia == '04' ? ' selected="selected"' : ''; ?>>04</option>
                                            <option value="05" <?= $dia == '05' ? ' selected="selected"' : ''; ?>>05</option>
                                            <option value="06" <?= $dia == '06' ? ' selected="selected"' : ''; ?>>06</option>
                                            <option value="07" <?= $dia == '07' ? ' selected="selected"' : ''; ?>>07</option>
                                            <option value="08" <?= $dia == '08' ? ' selected="selected"' : ''; ?>>08</option>
                                            <option value="09" <?= $dia == '09' ? ' selected="selected"' : ''; ?>>09</option>
                                            <option value="10" <?= $dia == '10' ? ' selected="selected"' : ''; ?>>10</option>
                                            <option value="11" <?= $dia == '11' ? ' selected="selected"' : ''; ?>>11</option>
                                            <option value="12" <?= $dia == '12' ? ' selected="selected"' : ''; ?>>12</option>
                                            <option value="13" <?= $dia == '13' ? ' selected="selected"' : ''; ?>>13</option>
                                            <option value="14" <?= $dia == '14' ? ' selected="selected"' : ''; ?>>14</option>
                                            <option value="15" <?= $dia == '15' ? ' selected="selected"' : ''; ?>>15</option>
                                            <option value="16" <?= $dia == '16' ? ' selected="selected"' : ''; ?>>16</option>
                                            <option value="17" <?= $dia == '17' ? ' selected="selected"' : ''; ?>>17</option>
                                            <option value="18" <?= $dia == '18' ? ' selected="selected"' : ''; ?>>18</option>
                                            <option value="19" <?= $dia == '19' ? ' selected="selected"' : ''; ?>>19</option>
                                            <option value="20" <?= $dia == '20' ? ' selected="selected"' : ''; ?>>20</option>
                                            <option value="21" <?= $dia == '21' ? ' selected="selected"' : ''; ?>>21</option>
                                            <option value="22" <?= $dia == '22' ? ' selected="selected"' : ''; ?>>22</option>
                                            <option value="23" <?= $dia == '23' ? ' selected="selected"' : ''; ?>>23</option>
                                            <option value="24" <?= $dia == '24' ? ' selected="selected"' : ''; ?>>24</option>
                                            <option value="25" <?= $dia == '25' ? ' selected="selected"' : ''; ?>>25</option>
                                            <option value="26" <?= $dia == '26' ? ' selected="selected"' : ''; ?>>26</option>
                                            <option value="27" <?= $dia == '27' ? ' selected="selected"' : ''; ?>>27</option>
                                            <option value="28" <?= $dia == '28' ? ' selected="selected"' : ''; ?>>28</option>
                                            <option value="29" <?= $dia == '29' ? ' selected="selected"' : ''; ?>>29</option>
                                            <option value="30" <?= $dia == '30' ? ' selected="selected"' : ''; ?>>30</option>
                                            <option value="31" <?= $dia == '31' ? ' selected="selected"' : ''; ?>>31</option>
                                        </select>
                                        <label>Dia de Nacimiento</label>
                                    </div>
                                    <div class="col s12 m6 l6 input-field">
                                        <select id="mes_selected" name="mes_selected">
                                            <option value="" disabled selected>Seleccionar el mes</option>
                                            <option value="01" <?= $mes == '01' ? ' selected="selected"' : ''; ?>>01</option>
                                            <option value="02" <?= $mes == '02' ? ' selected="selected"' : ''; ?>>02</option>
                                            <option value="03" <?= $mes == '03' ? ' selected="selected"' : ''; ?>>03</option>
                                            <option value="04" <?= $mes == '04' ? ' selected="selected"' : ''; ?>>04</option>
                                            <option value="05" <?= $mes == '05' ? ' selected="selected"' : ''; ?>>05</option>
                                            <option value="06" <?= $mes == '06' ? ' selected="selected"' : ''; ?>>06</option>
                                            <option value="07" <?= $mes == '07' ? ' selected="selected"' : ''; ?>>07</option>
                                            <option value="08" <?= $mes == '08' ? ' selected="selected"' : ''; ?>>08</option>
                                            <option value="09" <?= $mes == '09' ? ' selected="selected"' : ''; ?>>09</option>
                                            <option value="10" <?= $mes == '10' ? ' selected="selected"' : ''; ?>>10</option>
                                            <option value="11" <?= $mes == '11' ? ' selected="selected"' : ''; ?>>11</option>
                                            <option value="12" <?= $mes == '12' ? ' selected="selected"' : ''; ?>>12</option>
                                        </select>
                                        <label>Mes de Nacimiento</label>
                                    </div>
                                    <div class="col s12 m6 l6 input-field">
                                        <input id="año" name="año" value="<?php echo $year; ?>" type="number" min="1000" max="9999" class="validate">
                                        <label for="año">Año de Nacimiento</label>
                                    </div>
                                    <div class="col s12 m6 l6 input-field">
                                        <select id="sexo_selected" name="sexo_selected">
                                            <option value="" disabled selected>Selecciona el sexo</option>
                                            <option value="M" <?= $sexo == 'M' ? ' selected="selected"' : ''; ?>>Mujer</option>
                                            <option value="H" <?= $sexo == 'H' ? ' selected="selected"' : ''; ?>>Hombre</option>
                                        </select>
                                        <label>Sexo</label>
                                    </div>
                                    <div class="col s12 m6 l6 input-field">
                                        <select id="edo_selected" name="edo_selected">
                                            <option value="" disabled selected>Selecciona el estado</option>
                                            <option value="AS" <?= $edo == 'AS' ? ' selected="selected"' : ''; ?>>Aguascalientes</option>
                                            <option value="BC" <?= $edo == 'BC' ? ' selected="selected"' : ''; ?>>Baja California</option>
                                            <option value="BS" <?= $edo == 'BS' ? ' selected="selected"' : ''; ?>>Baja California Sur</option>
                                            <option value="CC" <?= $edo == 'CC' ? ' selected="selected"' : ''; ?>>Campeche</option>
                                            <option value="CL" <?= $edo == 'CL' ? ' selected="selected"' : ''; ?>>Coahuila</option>
                                            <option value="CM" <?= $edo == 'CM' ? ' selected="selected"' : ''; ?>>Colima</option>
                                            <option value="CS" <?= $edo == 'CS' ? ' selected="selected"' : ''; ?>>Chiapas</option>
                                            <option value="CH" <?= $edo == 'CH' ? ' selected="selected"' : ''; ?>>Chihuahua</option>
                                            <option value="DF" <?= $edo == 'DF' ? ' selected="selected"' : ''; ?>>Ciudad de México</option>
                                            <option value="DG" <?= $edo == 'DG' ? ' selected="selected"' : ''; ?>>Durango</option>
                                            <option value="GT" <?= $edo == 'GT' ? ' selected="selected"' : ''; ?>>Guanajuato</option>
                                            <option value="GR" <?= $edo == 'GR' ? ' selected="selected"' : ''; ?>>Guerrero</option>
                                            <option value="HG" <?= $edo == 'HG' ? ' selected="selected"' : ''; ?>>Hidalgo</option>
                                            <option value="JC" <?= $edo == 'JC' ? ' selected="selected"' : ''; ?>>Jalisco</option>
                                            <option value="MC" <?= $edo == 'MC' ? ' selected="selected"' : ''; ?>>Estado de México</option>
                                            <option value="MN" <?= $edo == 'MN' ? ' selected="selected"' : ''; ?>>Michoac&aacute;n</option>
                                            <option value="MS" <?= $edo == 'MS' ? ' selected="selected"' : ''; ?>>Morelos</option>
                                            <option value="NT" <?= $edo == 'NT' ? ' selected="selected"' : ''; ?>>Nayarit</option>
                                            <option value="NL" <?= $edo == 'NL' ? ' selected="selected"' : ''; ?>>Nuevo Le&oacute;n</option>
                                            <option value="OC" <?= $edo == 'OC' ? ' selected="selected"' : ''; ?>>Oaxaca</option>
                                            <option value="PL" <?= $edo == 'PL' ? ' selected="selected"' : ''; ?>>Puebla</option>
                                            <option value="QT" <?= $edo == 'QT' ? ' selected="selected"' : ''; ?>>Quer&eacute;taro</option>
                                            <option value="QR" <?= $edo == 'QR' ? ' selected="selected"' : ''; ?>>Quintana Roo</option>
                                            <option value="SP" <?= $edo == 'SP' ? ' selected="selected"' : ''; ?>>San Luis Potos&iacute;</option>
                                            <option value="SL" <?= $edo == 'SL' ? ' selected="selected"' : ''; ?>>Sinaloa</option>
                                            <option value="SR" <?= $edo == 'SR' ? ' selected="selected"' : ''; ?>>Sonora</option>
                                            <option value="TC" <?= $edo == 'TC' ? ' selected="selected"' : ''; ?>>Tabasco</option>
                                            <option value="TS" <?= $edo == 'TS' ? ' selected="selected"' : ''; ?>>Tamaulipas</option>
                                            <option value="TL" <?= $edo == 'TL' ? ' selected="selected"' : ''; ?>>Tlaxcala</option>
                                            <option value="VZ" <?= $edo == 'VZ' ? ' selected="selected"' : ''; ?>>Veracruz</option>
                                            <option value="YN" <?= $edo == 'YN' ? ' selected="selected"' : ''; ?>>Yucat&aacute;n</option>
                                            <option value="ZS" <?= $edo == 'ZS' ? ' selected="selected"' : ''; ?>>Zacatecas</option>
                                        </select>
                                        <label>Estado</label>
                                    </div>
                                    <div class="col s12">
                                        <button class="btn waves-effect waves-light right sizeButton" type="submit" name="action">Generar CURP</button>
                                    </div>
                                </div>
                            </form>
                            <div id="resp_curp"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
    <script type="text/javascript" src="js/registrar_sw.js"></script>
    <script>
        $(document).ready(function () {
            $('select').formSelect();
        });
    </script>

</html>
