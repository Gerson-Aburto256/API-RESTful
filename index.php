<?php

require_once "controladores/rutas.controlador.php";
require_once "controladores/inscripcion.controlador.php";

require_once "modelos/inscripcion.modelo.php";

$rutas = new controladorRutas();
$rutas -> index();