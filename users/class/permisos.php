<?php

class Permiso{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	
	
	public function list_permiso(){
		
		
		$query = "SELECT * FROM sys_permisos";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function single_permiso($id_permiso){
		
	
		$query = "SELECT * FROM sys_permisos  WHERE id_permiso = '".$id_permiso."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_permiso(){

		
	$query = "INSERT INTO sys_permisos VALUES(NULL, '".$_POST["nombre"]."', '".$_POST["usuario_crea"]."', 0, NOW(),NOW())";
		$this->objDb->insert($query);
			
		
	}
	
	
	
	public function modify_permiso($id_permiso){

		$query = "UPDATE sys_permisos SET nombre = '".$_POST["nombre"]."',
		usuario_modifica = '".$_POST["usuario_modifica"]."', fecha_modifica = NOW() WHERE id_permiso = $id_permiso";
		$this->objDb->update($query);

			
	}
	
	public function delete_permiso(){
		
		$query = "DELETE FROM sys_permisos WHERE id_permiso = '".$_GET["id_permiso"]."' ";
		$this->objDb->delete($query);
		
	}
	
}

?>