<?php

class Linea{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	
	
	public function list_linea(){
		
		
		$query = "SELECT * FROM sys_lineas";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function single_linea($id_linea){
		
	
		$query = "SELECT * FROM sys_lineas  WHERE id_linea = '".$id_linea."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_linea(){

		
	$query = "INSERT INTO sys_lineas VALUES(NULL, '".$_POST["nombre"]."', '".$_POST["usuario_crea"]."', 0, NOW(),NULL)";
		$this->objDb->insert($query);
			
		
	}
	
	
	
	public function modify_linea($id_linea){

		$query = "UPDATE sys_lineas SET nombre = '".$_POST["nombre"]."', 
		 id_usuario_modifica = '".$_POST["usuario_modifica"]."', fecha_modifica = NOW() WHERE id_linea = $id_linea";
		 
		$this->objDb->update($query);

			
	}
	
	public function delete_linea(){
		
		$query = "DELETE FROM sys_lineas WHERE id_linea = '".$_GET["id_linea"]."' ";
		$this->objDb->delete($query);
		
	}
	
}

?>