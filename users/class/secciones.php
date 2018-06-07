<?php

class Seccion{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	
	
	public function list_seccion(){
		
		
		$query = "SELECT sys_secciones.codigo_seccion as codigo_seccion, sys_secciones.id_seccion as id_seccion, sys_modulos.nombre as modulo_nombre, sys_secciones.nombre as seccion_nombre FROM sys_secciones inner join sys_modulos on sys_secciones.id_modulo = sys_modulos.id_modulo";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function single_seccion($id_seccion){
		
	
		$query = "SELECT sys_secciones.codigo_seccion as codigo_seccion, sys_secciones.id_seccion as id_seccion, sys_modulos.id_modulo as id_modulo, sys_secciones.nombre as nom_seccion, sys_modulos.nombre as modulo FROM sys_secciones inner join sys_modulos on sys_secciones.id_modulo = sys_modulos.id_modulo  WHERE id_seccion = '".$id_seccion."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_seccion(){

		
	$query = "INSERT INTO sys_secciones VALUES('', '".$_POST["id_modulo"]."', '".$_POST["nombre"]."', '".$_POST["codigo_seccion"]."', '".$_POST["usuario_crea"]."', '', NOW(),'')";
		$this->objDb->insert($query);
			
		
	}
	
	
	
	public function modify_seccion($id_seccion){

		$query = "UPDATE sys_secciones SET 
		codigo_seccion = '".$_POST["codigo_seccion"]."',
		nombre = '".$_POST["nombre"]."',
		id_modulo = '".$_POST["id_modulo"]."',
		usuario_modifica = '".$_POST["usuario_modifica"]."', fecha_modifica = NOW() WHERE id_seccion = $id_seccion";
		$this->objDb->update($query);

			
	}
	
	public function delete_seccion(){
		
		$query = "DELETE FROM sys_secciones WHERE id_seccion = '".$_GET["id_seccion"]."' ";
		$this->objDb->delete($query);
		
	}
	
}

?>