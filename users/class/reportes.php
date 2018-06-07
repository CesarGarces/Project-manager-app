<?php

class Reporte{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	
	
	public function list_reporte($ini, $fin){
		
		
		$query = "SELECT * FROM sys_sms_enviados inner join sys_clientes on sys_sms_enviados.id_cliente = sys_clientes.id_cliente where sys_sms_enviados.fecha_envio BETWEEN '".$ini."' AND '".$fin."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function list_reporte_actual($fechaini, $fechafin){
		
		
		$query = "SELECT * FROM sys_sms_enviados inner join sys_clientes on sys_sms_enviados.id_cliente = sys_clientes.id_cliente where sys_sms_enviados.fecha_envio BETWEEN '".$fechaini."' AND '".$fechafin."'";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function single_reporte($id_cliente){
		
	
		$query = "SELECT * FROM sys_sms_enviados inner join sys_clientes on sys_sms_enviados.id_cliente = sys_clientes.id_cliente  WHERE id_cliente = '".$id_cliente."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function reporte_link(){
		
	
		//$query = "SELECT * FROM sys_preguntas_encuesta inner JOIN sys_clientes on sys_preguntas_encuesta.id_cliente = sys_clientes.id_cliente inner join sys_generar_sms on sys_clientes.celular = sys_generar_sms.celular";
		$query = "SELECT * FROM sys_preguntas_encuesta inner JOIN sys_clientes on sys_preguntas_encuesta.id_cliente = sys_clientes.id_cliente";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function reporte_historico_link(){
		
	
		//$query = "SELECT * FROM sys_preguntas_encuesta inner JOIN sys_clientes on sys_preguntas_encuesta.id_cliente = sys_clientes.id_cliente inner join sys_generar_sms on sys_clientes.celular = sys_generar_sms.celular";
		$query = "SELECT fecha_respuesta, (SELECT COUNT(1)  FROM sys_sms_enviados e WHERE mensaje LIKE '%http%' AND date_format(e.fecha_envio, '%Y-%m-%d') = fecha_respuesta) enviados, COUNT(id_encuesta) respondidas, SUM(CASE WHEN soluciononecesidadventanilla = 1 THEN 1 ELSE 0 END) Pregunta2, (SUM(CASE WHEN soluciononecesidadventanilla = 1 THEN 1 ELSE 0 END)/COUNT(id_encuesta)) solucion, SUM(CASE WHEN experienciaultimavisitaventanillaagencia > 3 THEN 1 ELSE 0 END) Pregunta1, (SUM(CASE WHEN experienciaultimavisitaventanillaagencia > 3 THEN 1 ELSE 0 END)/COUNT(id_encuesta)) INS, (SUM(CASE WHEN quetansatisfechocontiempoesperacola = 1 THEN 1 ELSE 0 END)/COUNT(id_encuesta)) p3_alto, (SUM(CASE WHEN quetansatisfechocontiempoesperacola = 2 THEN 1 ELSE 0 END)/COUNT(id_encuesta)) p3_normal, (SUM(CASE WHEN quetansatisfechocontiempoesperacola = 3 THEN 1 ELSE 0 END)/COUNT(id_encuesta)) p3_bajo FROM sys_preguntas_encuesta WHERE fecha_respuesta IS NOT NULL GROUP BY fecha_respuesta ORDER BY fecha_respuesta DESC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
	
}

?>