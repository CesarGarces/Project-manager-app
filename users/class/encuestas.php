<?php

class Encuesta{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	public function traer_ultimo_id_cliente(){
		
	
		$query = "SELECT * FROM  sys_clientes WHERE id_cliente = ( SELECT MAX( id_cliente ) FROM sys_clientes )";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function buscar_cliente($idIzo){
		
		
	$query = "SELECT * FROM sys_clientes inner JOIN sys_preguntas_encuesta on sys_preguntas_encuesta.id_izo = sys_clientes.id_izo WHERE sys_clientes.id_izo = '".$idIzo."' ";
	$this->result = $this->objDb->select($query);
	return $this->result;
		
	}
	public function buscar_agencia($sucursal){
		
		
	$query = "SELECT * FROM sys_agencias  WHERE codigo = '".$sucursal."' ";
	$this->result = $this->objDb->select($query);
	return $this->result;
		
	}
	public function buscar_region_agencia($sucursal){
		
		
	$query = "SELECT * FROM sys_agencias  WHERE agencia = '".$sucursal."' ";
	$this->result = $this->objDb->select($query);
	return $this->result;
		
	}
	public function buscar_cliente_estado($idIzo){
		
		
	$query = "SELECT * FROM sys_preguntas_encuesta  WHERE id_izo = '".$idIzo."' ";
	$this->result = $this->objDb->select($query);
	return $this->result;
		
	}
	public function list_enc_tipo($idEnc){
		
		
	$query = "SELECT * FROM sys_encuesta_tipo WHERE id_encuesta = '".$idEnc."' ";
	$this->result = $this->objDb->select($query);
	return $this->result;
		
	}
	public function actualizar_cliente($idIzo,$contacto_estado){

		$query = "UPDATE sys_preguntas_encuesta SET motivocontacto = '".$contacto_estado."' WHERE id_izo = '".$idIzo."' ";
		 
		$this->objDb->update($query);

			
	}
	public function actualizar_cliente_usuario($idIzo,$contacto_estado, $idUser){

		$query = "UPDATE sys_preguntas_encuesta SET motivocontacto = '".$contacto_estado."', id_usuario_modifica = '".$idUser."', fecha_modifica = now() WHERE id_izo = '".$idIzo."' ";
		 
		$this->objDb->update($query);

			
	}
	
	public function list_enc_tipo_pregunta($idEnc,$pregunta){
		
		
	$query = "SELECT * FROM sys_encuesta_tipo WHERE id_encuesta = '".$idEnc."' AND num_pregunta = '".$pregunta."' ";
	$this->result = $this->objDb->select($query);
	return $this->result;
		
	}
	
	public function new_enc_tipo(){

		
	$query = "INSERT INTO sys_encuesta_tipo VALUES(NULL, '".$_POST["id_encuesta"]."', '".$_POST["num_pregunta"]."', '".$_POST["descripcion"]."','".$_POST["usuario_crea"]."', NOW(),NULL,NULL)";
	$this->objDb->insert($query);
					
	}
	
	
	public function modify_enc_tipo($id_enc_tipo){

		$query = "UPDATE sys_encuesta_tipo SET id_encuesta = '".$_POST["id_encuesta"]."', 
		num_pregunta = '".$_POST["num_pregunta"]."', 
		descripcion = '".$_POST["descripcion"]."', 
		usuario_modifica = '".$_POST["usuario_modifica"]."', fecha_modifica = NOW() WHERE id_sys_encuesta_tipo = $id_enc_tipo";
		 
		$this->objDb->update($query);
			
	}
	
	public function delete_enc_tipo(){
		
		$query = "DELETE FROM sys_encuesta_tipo WHERE id_sys_encuesta_tipo = '".$_GET["id_sys_encuesta_tipo"]."' ";
		$this->objDb->delete($query);
		
	}
	public function actualizar_enc($idUser,$idIzo,$contacto_estado,$enc_1,$enc_2,$enc_3,$enc_4,$enc_5,$enc_6,$enc_7,$enc_8,$Motivo_8,$MotivosCalificacion8,$enc_9,$Motivo9,$MotivosCalificacion9,$enc_10,$Motivo10,$MotivosCalificacion10,$enc_11,$enc_12,$enc_13,$Motivo13,$MotivosCalificacion13,$enc_14,$Motivo14,$MotivosCalificacion14,$enc_15,$Motivo15,$MotivosCalificacion15){
		
		$query = "UPDATE sys_preguntas_encuesta SET 
		id_estado = 3,
		visitada = 1,
		fecha_respuesta = now(),
		fecha_visita = now(),
		amabilidadconlaquefueatendido = '".$enc_1."',
		claridadconlaquecomunicoinformacionbrindadaporusted = '".$enc_2."',
		actituddemostradaparaentendersunecesidadyresolversurequerimiento = '".$enc_3."',
		iniciativaparabuscarunasolucionasurequerimiento = '".$enc_4."',
		niveldeconocimientoquedemostroalbrindarlainformacionsolicitada = '".$enc_5."',
		agilidadconlaqueatendiosurequerimiento = '".$enc_6."',
		asesorlebrindoinformacionadicionalsobrenuestrosservicios = '".$enc_7."',
		comodidaddeoficinaenlaquefueatendido = '".$enc_8."',
		motivo8 = '".$Motivo_8."',
		porquemotivobrindaestacalificacionOCHO = '".$MotivosCalificacion8."',
		tiempodeesperaenfilaantesdeseratendido = '".$enc_9."',
		motivo9 = '".$Motivo9."',
		porquemotivobrindaestacalificacionNUEVE = '".$MotivosCalificacion9."',
		surequerimientoconsultafuesolucionado = '".$enc_10."',
		motivo10 = '".$Motivo10."',
		porquemotivobrindaestacalificacionDIEZ = '".$MotivosCalificacion10."',
		antesdesuvisitaintentogestionarsurequerimientoenotrocanal = '".$enc_11."',
		cualcanal = '".$enc_12."',
		quetansatisfechoseencuetraconelserviciorecibidoenbgr = '".$enc_13."',
		motivo13 = '".$Motivo13."',
		porquemotivobrindaestacalificacionTRECE = '".$MotivosCalificacion13."',
		deacuerdoasuexperienciaenquenivelestadispuestoarecomendarbgr = '".$enc_14."',
		motivo14 = '".$Motivo14."',
		porquemotivobrindaestacalificacionCATORCE = '".$MotivosCalificacion14."',
		comocalificafacilidad = '".$enc_15."',
		motivo15 = '".$Motivo15."',
		porquemotivobrindaestacalificacionQUINCE = '".$MotivosCalificacion15."',
		motivocontacto = '".$contacto_estado."',
		id_usuario_modifica = '".$idUser."',
		fecha_modifica = now() where id_izo = '".$idIzo."' ";
		echo $query;
		$this->objDb->update($query);
		
	}
	
}

?>