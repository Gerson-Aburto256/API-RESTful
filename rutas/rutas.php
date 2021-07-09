<?php

$arrayRutas = explode("/", $_SERVER['REQUEST_URI']);

if (isset($_GET["page"]) && is_numeric($_GET["page"])) {
	
	$inscripcion = new Controladorinscripcion();
	$inscripcion -> index($_GET["page"]);

}else{

	if (count(array_filter($arrayRutas)) == 0) {

		/*============================================
		Cuando no se hace ninguna petición a la API
		============================================*/

		$json = array(
			"detalle" => "no encontrado 1" 
		);

		echo json_encode($json, true);
		return;
	}else{
		/*============================================
		Cuando pasamos solo un índice en el array $arrayRutas
		============================================*/

		if (count(array_filter($arrayRutas)) == 1) {

			/*============================================
			Cuando se hace peticiones desde inscripcion
			============================================*/

			if (array_filter($arrayRutas)[1] == "inscripcion") {
				
				/*============================================
				Peticiones GET
				============================================*/

				if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
					
					$inscripcion = new Controladorinscripcion();
					$inscripcion -> index(null);
				}
				/*============================================
				Peticiones POST
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {

					/*============================================
					Capturar datos
					============================================*/

					$datos = array( "ID_PERIODO"=>$_POST["ID_PERIODO"],
									"ID_ACTIVIDAD"=>$_POST["ID_ACTIVIDAD"],
									"ID_INSRUCTOR"=>$_POST["ID_INSRUCTOR"],
									"ID_GRUPO"=>$_POST["ID_GRUPO"],
									"ID_AREA"=>$_POST["ID_AREA"],
									"NUM_CONTROL"=>$_POST["NUM_CONTROL"]);
									"CALIFICACION"=>$_POST["CALIFICACION"],
									"ID_CARRERA"=>$_POST["ID_CARRERA"]);

					$crearinscripcion = new Controladorinscripcion();
					$crearinscripcion -> create($datos);

					echo '<pre>'; print_r($_SERVER["REQUEST_METHOD"]); echo '</pre>';
					
					return;

				}else{
					$json = array(
						"detalle" => "no encontrado 2" 
					);

					echo json_encode($json, true);
					return;
				}
			}else{
				$json = array(
					"detalle" => "no encontrado 3" 
				);

				echo json_encode($json, true);
				return;
			}	
		}else{

			/*============================================
			Cuando se hace peticiones desde un solo inscripcion
			============================================*/

			if (array_filter($arrayRutas)[1] == "inscripcion" && is_numeric(array_filter($arrayRutas)[2])) {

				/*============================================
				Peticiones GET
				============================================*/

				if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
					
					$inscripcion = new Controladorinscripcion();
					$inscripcion -> show(array_filter($arrayRutas)[2]);
				}
				/*============================================
				Peticiones PUT
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "PUT") {

					/*============================================
					Capturar datos
					============================================*/

					$datos = array();
					
					parse_str(file_get_contents('php://input'), $datos);

					$editarinscripcion = new Controladorinscripcion();
					$editarinscripcion -> update(array_filter($arrayRutas)[2], $datos);
				}
				/*============================================
				Peticiones DELETE
				============================================*/

				else if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "DELETE") {
					
					$borrarinscripcion = new Controladorinscripcion();
					$borrarinscripcion -> delete(array_filter($arrayRutas)[2]);
				}else{
					$json = array(
						"detalle" => "no encontrado 4" 
					);

					echo json_encode($json, true);
					return;
				}
			}else{
				$json = array(
					"detalle" => "no encontrado 5" 
				);

				echo json_encode($json, true);
				return;
			}
		}
	}
}