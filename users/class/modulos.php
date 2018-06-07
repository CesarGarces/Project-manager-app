<?php

class Modulo{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	
	
	public function list_modulo(){
		
		
		$query = "SELECT * FROM sys_modulos";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function single_modulo($id_modulo){
		
	
		$query = "SELECT * FROM sys_modulos  WHERE id_modulo = '".$id_modulo."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_modulo(){

		
	$query = "INSERT INTO sys_modulos VALUES(NULL,0, '".$_POST["nombre"]."', '".$_POST["usuario_crea"]."', 0, NOW(),NOW())";
		$this->objDb->insert($query);
		
	}
	
	
	
	public function modify_modulo($id_modulo){

		$query = "UPDATE sys_modulos SET nombre = '".$_POST["nombre"]."',
		usuario_modifica = '".$_POST["usuario_modifica"]."', fecha_modifica = NOW() WHERE id_modulo = $id_modulo";
		$this->objDb->update($query);

			
	}
	
	public function delete_modulo(){
		
		$query = "DELETE FROM sys_modulos WHERE id_modulo = '".$_GET["id_modulo"]."' ";
		$this->objDb->delete($query);
		
	}
	
}

?>