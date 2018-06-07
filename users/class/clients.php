<?php

class clients{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	public function list_clients(){
		
		
		$query = "SELECT * FROM clientes inner join segmentos on clientes.id_segmento = segmentos.id_segmento";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}

	public function new_clients(){
	$ruta="../users/user/img";
	$archivo=$_FILES['imagen']['tmp_name'];
	$nombreArchivo=$_FILES['imagen']['name'];
	move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
	$ruta=$ruta."/".$nombreArchivo;

	/*if ($ruta == "../user/img/"){
		$ruta = "../user/img/favicon.png";
	}*/


	$pass = sha1 ($_REQUEST["pass"]);

		
	$query = "INSERT INTO clientes VALUES(NULL, '".$_REQUEST["id_segmento"]."', '".$_REQUEST["nombre"]."', NULL)";
//echo $query;
//exit(0);
		$this->objDb->insert($query);
			
	}

	public function list_segmento(){
		
		
		$query = "SELECT * FROM segmentos";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_segmento(){
	$ruta="../users/user/img";
	$archivo=$_FILES['imagen']['tmp_name'];
	$nombreArchivo=$_FILES['imagen']['name'];
	move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
	$ruta=$ruta."/".$nombreArchivo;

	/*if ($ruta == "../user/img/"){
		$ruta = "../user/img/favicon.png";
	}*/


	$pass = sha1 ($_REQUEST["pass"]);

		
	$query = "INSERT INTO segmentos VALUES(NULL, '".$_REQUEST["segmento"]."', NULL)";
//echo $query;
//exit(0);
		$this->objDb->insert($query);
			
	}
	
	public function list_canal(){
		
		
		$query = "SELECT * FROM canales";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_canal(){
	$ruta="../users/user/img";
	$archivo=$_FILES['imagen']['tmp_name'];
	$nombreArchivo=$_FILES['imagen']['name'];
	move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
	$ruta=$ruta."/".$nombreArchivo;

	/*if ($ruta == "../user/img/"){
		$ruta = "../user/img/favicon.png";
	}*/


	$pass = sha1 ($_REQUEST["pass"]);

		
	$query = "INSERT INTO canales VALUES(NULL, '".$_REQUEST["canal"]."', NULL)";
//echo $query;
//exit(0);
		$this->objDb->insert($query);
			
	}
		

	public function list_estudio(){
		
		
		$query = "select id_estudio, fecha_estudio, nombre, nombre_estudio, canal,
				segmento from ((estudio es INNER JOIN clientes  cl on es.id_cliente=cl.id_cliente)
				inner join canales ca on es.id_canal=ca.id_canal)
				INNER JOIN segmentos se ON cl.id_segmento = se.id_segmento
				order by  id_estudio desc";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function new_estudio(){

	$pass = sha1 ($_REQUEST["pass"]);

		
	$query = "INSERT INTO estudio VALUES(NULL, '".$_REQUEST["fecha_estudio"]."',  '".$_REQUEST["nombre_estudio"]."',   '".$_REQUEST["id_cliente"]."', '".$_REQUEST["id_canal"]."')";
//echo $query;
//exit(0);
		$this->objDb->insert($query);
			
	}

	public function list_indicador(){
		
		
		$query = "SELECT * FROM tipo_indicadores";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}

	public function new_indicador(){

	$pass = sha1 ($_REQUEST["pass"]);

		
	$query = "INSERT INTO tipo_indicadores VALUES(NULL, '".$_REQUEST["t_indicador"]."',  '".$_REQUEST["escala"]."', '".$_REQUEST["calculo"]."')";
//echo $query;
//exit(0);
		$this->objDb->insert($query);
			
	}
	
	
	public function list_tipo_medicion(){
		
		
		$query = "SELECT * FROM tipo_mediciones";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	public function upload(){

	$pass = sha1 ($_REQUEST["pass"]);
	$row = explode("\r\n",$_REQUEST["idacceso-indicador"]);
	$i=0;
	foreach($row as $element)
		{
			
			$column = explode("\t",$row[$i]);
			$idaccesodet = $column[0];
			$indicadordet = $column[1];
			
			$query = "INSERT INTO estudio_detalles VALUES(NULL, '".$_REQUEST["id_estudio"]."',  '".$_REQUEST["id_tipo_indicador"]."', '".$indicadordet."', '".$idaccesodet."', '".$_REQUEST["id_tipo_medicion"]."')";

			$this->objDb->insert($query);
			$i++;
		}
	}


}