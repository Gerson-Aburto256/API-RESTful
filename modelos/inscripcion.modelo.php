<?php

require_once "conexion.php";

class Modeloinscripcion{

	/*============================================
	Mostrar todos las inscripciones
	============================================*/

	static public function index($tabla, $cantidad, $desde){

		if ($cantidad != null) {
			
			$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_PERIODO, $tabla.ID_ACTIVIDAD, $tabla.ID_inscripcion, $tabla.ID_GRUPO, $tabla.ID_AREA, $tabla.NUM_CONTROL, $tabla.CALIFICACION, $tabla.ID_CARRERA FROM $tabla LIMIT $desde, $cantidad");

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_PERIODO, $tabla.ID_ACTIVIDAD, $tabla.ID_inscripcion, $tabla.ID_GRUPO, $tabla.ID_AREA, $tabla.NUM_CONTROL, $tabla.CALIFICACION, $tabla.ID_CARRERA FROM $tabla");

		}

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
	Creacion de un inscripcion
	============================================*/

	static public function create($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ID_ACTIVIDAD, ID_inscripcion, ID_GRUPO, ID_AREA, NUM_CONTROL, CALIFICACION) VALUES (:ID_ACTIVIDAD, :ID_inscripcion, :ID_GRUPO, :ID_AREA, :NUM_CONTROL, :CALIFICACION)");

		$stmt -> bindParam(":ID_ACTIVIDAD", $datos["ID_ACTIVIDAD"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_inscripcion", $datos["ID_inscripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_GRUPO", $datos["ID_GRUPO"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_AREA", $datos["ID_AREA"], PDO::PARAM_STR);
		$stmt -> bindParam(":NUM_CONTROL", $datos["NUM_CONTROL"], PDO::PARAM_STR);
		$stmt -> bindParam(":CALIFICACION", $datos["CALIFICACION"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_CARRERA", $datos["ID_CARRERA"], PDO::PARAM_STR);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();
		$stmt= null;

	}
	/*============================================
	Mostrar un solo inscripcion
	============================================*/

	static public function show($tabla, $id){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla.ID_PERIODO, $tabla.ID_ACTIVIDAD, $tabla.ID_inscripcion, $tabla.ID_GRUPO, $tabla.ID_AREA, $tabla.NUM_CONTROL, $tabla.CALIFICACION, $tabla.ID_CARRERA FROM $tabla WHERE $tabla.ID_PERIODO =:ID_PERIODO");
		
		$stmt -> bindParam(":ID_PERIODO", $id, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetchAll(PDO::FETCH_CLASS);
		$stmt -> close();
		$stmt = null;
	}

	/*============================================
	Actualizacion de un inscripcion
	============================================*/

	static public function update($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ID_ACTIVIDAD=:ID_ACTIVIDAD,ID_inscripcion=:ID_inscripcion,ID_GRUPO=:ID_GRUPO,ID_AREA=:ID_AREA,NUM_CONTROL=:NUM_CONTROL, CALIFICACION=:CALIFICACION, ID_CARRERA=:ID_CARRERA WHERE ID_PERIODO = :ID_PERIODO");

		$stmt -> bindParam(":ID_PERIODO", $datos["ID_PERIODO"], PDO::PARAM_INT);
		$stmt -> bindParam(":ID_ACTIVIDAD", $datos["ID_ACTIVIDAD"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_inscripcion", $datos["ID_inscripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_GRUPO", $datos["ID_GRUPO"], PDO::PARAM_INT);
		$stmt -> bindParam(":ID_AREA", $datos["ID_AREA"], PDO::PARAM_INT);
		$stmt -> bindParam(":NUM_CONTROL", $datos["NUM_CONTROL"], PDO::PARAM_INT);
		$stmt -> bindParam(":CALIFICACION", $datos["CALIFICACION"], PDO::PARAM_STR);
		$stmt -> bindParam(":ID_CARRERA", $datos["ID_CARRERA"], PDO::PARAM_STR);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();
		$stmt= null;

	}
	/*============================================
	Borrar inscripcion
	============================================*/

	static public function delete($tabla, $id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE ID_PERIODO = :ID_PERIODO");

		$stmt -> bindParam(":ID_PERIODO", $id, PDO::PARAM_INT);

		if ($stmt -> execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}

		$stmt-> close();
		$stmt= null;

	}
}