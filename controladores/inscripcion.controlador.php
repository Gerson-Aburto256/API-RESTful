<?php

class Controladorinscripcion{

	/*============================================
	Mostrar todas las inscripciones
	============================================*/

	public function index($page){


		if ($page != null) {
			
			/*============================================
			Mostrar inscripcion con paginación
			============================================*/

			$cantidad = 10;
			$desde = ($page-1)*$cantidad;

			$inscripcion = ModeloInscripcion::index("inscripcion", $cantidad, $desde);

		}else{

			/*============================================
			Mostrar todas las inscripciones
			============================================*/

			$inscripcion = ModeloInscripcion::index("inscripcion", null, null);

		}

		
		if (!empty($inscripcion)) {
			

			$json = array(
				"status"=>200,
				"total_registros"=>count($inscripcion),
				"detalle"=> $inscripcion
			);

			echo json_encode($json, true);
			return;
		}else{

			$json = array(
				"status"=>200,
				"total_inscripciones"=>0,
				"detalle"=> "No hay ningúna inscripcion registrada"
			);

			echo json_encode($json, true);
			return;

		}

	}
	/*============================================
	Crear una inscripcion
	============================================*/

	public function create($datos){
		
		/*============================================
		Validar datos
		============================================*/

		foreach ($datos as $key => $valueDatos) {
	
			if (isset($ValueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error en el campo ID_GRUPO".$key
				);

				echo json_encode($json, true);
				return;
			}
		}

		/*============================================
		Validar que el numero de control no esté repetido
		============================================*/

		$inscripcion = ModeloInscripcion::index("inscripcion", null, null);
		foreach ($inscripcion as $key => $value) {
			
			if ($value->NUM_CONTROL == $datos["NUM_CONTROL"]) {

				$json = array(
					"status"=>404,
					"detalle"=>"El Numero de control ya existe en la base de datos"
				);

				echo json_encode($json, true);
				return;
			}
			
		}

		/*============================================
		Llevar datos al modelo
		============================================*/

		$datos = array( "ID_PERIODO"=>$datos["ID_PERIODO"],
						"ID_ACTIVIDAD"=>$datos["ID_ACTIVIDAD"],
						"ID_INSCRIPCION"=>$datos["ID_INSCRIPCION"],
						"ID_GRUPO"=>$datos["ID_GRUPO"],
						"ID_AREA"=>$datos["ID_AREA"],
						"NUM_CONTROL"=>$datos["NUM_CONTROL"]);
						"CALIFICACION"=>$datos["CALIFICACION"],
						"ID_CARRERA"=>$datos["ID_CARRERA"]);


		$create = Modeloinscripcion::create("inscripcion", $datos);
		/*============================================
		Respuesta del modelo
		============================================*/

		if ($create == "ok") {

			$json = array(
				"status"=>200,
				"detalle"=>"Su registro ha sido guardado"
			);

			echo json_encode($json, true);
			return;
		}
	}
	/*============================================
	Mostrando un solo inscripcion
	============================================*/

	public function show($id){
			
		/*============================================
		Mostrar todas las inscripciones
		============================================*/

		$inscripcion = Modeloinscripcion::show("inscripcion", $id);

		if (!empty($inscripcion)) {
			

			$json = array(
				"status"=>200,
				"detalle"=> $inscripcion
			);

			echo json_encode($json, true);
			return;
		}else{

			$json = array(
				"status"=>200,
				"total_registros"=>0,
				"detalle"=> "No hay ningún inscripcion registrada"
			);

			echo json_encode($json, true);
			return;

		}

	}
	/*============================================
	Editar un inscripcion
	============================================*/

	public function update($id, $datos){

		/*============================================
		Validar datos
		============================================*/

		foreach ($datos as $key => $valueDatos) {
	
			if (isset($ValueDatos) && !preg_match('/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $ValueDatos)) {

				$json = array(
					"status"=>404,
					"detalle"=>"Error en el campo ID_GRUPO".$key
				);

				echo json_encode($json, true);
				return;
			}

			/*============================================
			Llevar datos al modelo
			============================================*/

			$datos = array( 
							"ID_PERIODO"=>$id,
							"ID_ACTIVIDAD"=>$datos["ID_ACTIVIDAD"],
							"ID_INSCRIPCION"=>$datos["ID_INSCRIPCION"],
							"ID_GRUPO"=>$datos["ID_GRUPO"],
							"ID_AREA"=>$datos["ID_AREA"],
							"NUM_CONTROL"=>$datos["NUM_CONTROL"]);
							"CALIFICACION"=>$datos["CALIFICACION"],
							"ID_CARRERA"=>$datos["ID_CARRERA"])

			$update = Modeloinscripcion::update("inscripcion", $datos);
			/*============================================
			Respuesta del modelo
			============================================*/

			if ($update == "ok") {

				$json = array(
					"status"=>200,
					"detalle"=>"Su registro ha sido actualizado"
				);

				echo json_encode($json, true);
				return;
			}
		}
	}
	/*============================================
	Borrar inscripcion
	============================================*/

	public function delete($id){

		/*============================================
		Llevar datos al modelo
		============================================*/

		$delete = Modeloinscripcion::delete("inscripcion", $id);
		/*============================================
		Respuesta del modelo
		============================================*/

		if ($delete == "ok") {

			$json = array(
				"status"=>200,
				"detalle"=>"Se ha borrado con éxito"
			);

			echo json_encode($json, true);
			return;
		}
	}
}