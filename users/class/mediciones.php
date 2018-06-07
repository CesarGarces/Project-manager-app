<?php

class Medicion{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	
	
	public function list_medicion(){
		
		
		$query = "SELECT * FROM sys_encuestas";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function list_medicion_link(){
		
		
		$query = "SELECT * FROM sys_encuestas where id_encuesta = 1";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function list_medicion_cliente(){
		
		
		$query = "SELECT * FROM sys_clientes";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function list_medicion_cliente_cel($celular){
		
		
		$query = "SELECT * FROM sys_clientes where celular ='".$celular."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function single_medicion($id_medicion){
		
	
		$query = "SELECT * FROM sys_encuestas  WHERE id_encuesta = '".$id_medicion."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_medicion(){

		
	$query = "INSERT INTO sys_encuestas VALUES(NULL, '".$_POST["nombre"]."', '".$_POST["TipoMedicion"]."', '".$_POST["Mensaje"]."', '"."http://t3nshi.com/zalaz/izo/encuestas/".$_POST["link"].".php"."', '".$_POST["usuario_crea"]."', 0, NOW(),NULL,0,0)";
		$this->objDb->insert($query);
			
		
	}
	
	
	
	public function modify_medicion($id_medicion){

		$query = "UPDATE sys_encuestas SET nombre = '".$_POST["nombre"]."',
		tipo_encuesta =  '".$_POST["TipoMedicion"]."',
		mensaje = '".$_POST["Mensaje"]."',
		link = '".$_POST["link"]."',
		usuario_modifica = '".$_POST["usuario_modifica"]."', fecha_modifica = NOW() WHERE id_encuesta = $id_medicion";
		$this->objDb->update($query);

			
	}
	
	public function delete_medicion(){
		
		$query = "DELETE FROM sys_encuestas WHERE id_encuesta = '".$_GET["id_medicion"]."' ";
		$this->objDb->delete($query);
		
	}
	public function traer_ultimo_id_cliente(){
		
	
		$query = "SELECT * FROM  sys_clientes WHERE id_cliente = ( SELECT MAX( id_cliente ) FROM sys_clientes )";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	
}

?>