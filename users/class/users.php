<?php

class Users{
	
	public $objDb;
	public $objSe;
	public $result;
	public $rows;
	public $useropc;
	
	public function __construct(){
		
		$this->objDb = new Database();
		$this->objSe = new Sessions();
		
	}
	
	public function login_in(){

		
		
		$login = mysql_real_escape_string($_GET["login"]);
		$password = sha1 ($_GET["password"]);
		

		$query = "SELECT * FROM sys_usuarios WHERE sys_usuarios.login = '".$login."' 
			AND sys_usuarios.password = '{$password}'";
		$this->result = $this->objDb->select($query);
		
		$this->rows = mysql_num_rows($this->result);
		if($this->rows > 0){
			
			if($row=mysql_fetch_array($this->result)){
				$this->objSe->init();
					$_SESSION['user'] = $row["login"];
					$this->perfil = $row["id_rol"];
					


				
			switch($this->perfil){
					
							

					case 3:
						header('Location: ../private/panel.php');
						break;
					case 7:
						header('Location: ../private/enc_monitoreo.php');
						break;

				     default:
				        header('Location: ../private/panel.php');
				        break;
					
				}
				
			}
			
		}else{
			
			header('Location: ../index.php?error=1');
			
		}
		
	}

	
	public function list_users(){
		
		
		$query = "SELECT * FROM sys_usuarios inner join sys_roles on sys_usuarios.id_rol = sys_roles.id_rol ORDER BY sys_usuarios.login ASC";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function single_user($userid){
		
		
		$query = "SELECT sys_usuarios.id_rol as id_rol, sys_usuarios.id_empresa as id_empresa, sys_usuarios.id_tipo_identificacion as id_tipo, sys_usuarios.primer_nombre as primer_nombre, sys_usuarios.segundo_nombre as segundo_nombre, sys_usuarios.primer_apellido as primer_apellido, sys_usuarios.segundo_apellido as segundo_apellido,sys_usuarios.celular as celular,sys_usuarios.telefono as telefono,sys_usuarios.direccion as direccion,sys_usuarios.fecha_nacimiento as fecha_nacimiento,sys_usuarios.imagen as imagen, sys_usuarios.password as password, sys_usuarios.email as email, sys_usuarios.login as login ,sys_usuarios.genero as genero, sys_usuarios.estado_civil as estado_civil, sys_usuarios.id_estado as estado, sys_usuarios.identificacion as doc_user, sys_tipos_identificaciones.sigla as sigla, sys_empresas.razon_social as razon_social, sys_roles.nombre as nom_rol FROM sys_usuarios inner join sys_roles on sys_usuarios.id_rol = sys_roles.id_rol inner join sys_tipos_identificaciones on sys_usuarios.id_tipo_identificacion = sys_tipos_identificaciones.id_tipo_identificacion inner join sys_empresas on sys_usuarios.id_empresa = sys_empresas.id_empresa WHERE sys_usuarios.id_usuario = '".$userid."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function list_role(){
		
		
		$query = "SELECT * FROM sys_roles";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}

	
	public function users_rol(){
		
		
		$query = "SELECT sys_roles.nombre as rol, sys_roles.id_rol as idRol FROM sys_roles";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function users_rol_id($idrol){
		
		
		$query = "SELECT sys_roles.nombre as rol, sys_roles.id_rol as idRol FROM sys_roles where id_rol = '".$idrol."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	public function new_rol(){

		
	$query = "INSERT INTO sys_roles VALUES(NULL, '".$_POST["Rol"]."', '".$_POST["usuario_crea"]."', 0, NOW(), NOW())";
		$this->objDb->insert($query);
			
		
	}
	
	
	
	public function img_users(){
				
		
		$query = "SELECT * FROM sys_usuarios inner join sys_roles on sys_usuarios.id_rol = sys_roles.id_rol where login = '".$_SESSION['user']."' ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
	
		
	

	
	public function new_user(){
$ruta="../users/user/img";
$archivo=$_FILES['imagen']['tmp_name'];
$nombreArchivo=$_FILES['imagen']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;

/*if ($ruta == "../user/img/"){
	$ruta = "../user/img/favicon.png";
	
}*/


   $pass = sha1 ($_POST["pass"]);


		
	$query = "INSERT INTO sys_usuarios VALUES(NULL, '".$_POST["TipoIdentificacion"]."', '".$_POST["Empresa"]."', 
		 '".$_POST["Rol"]."', '".$_POST["Estado"]."', '".$_POST["EstadoCivil"]."', '".$_POST["Genero"]."', 
		 '".$_POST["Login"]."', '{$pass}', '".$_POST["PrimerNombre"]."', '".$_POST["SegundoNombre"]."',
		 '".$_POST["PrimerApellido"]."', '".$_POST["SegundoApellido"]."','".$_POST["Email"]."',
		 '".$_POST["Celular"]."','".$_POST["Telefono"]."',
		 '".$_POST["Direccion"]."', '".$_POST["FechaNacimiento"]."', '".$_POST["identificacion"]."',
		  '".$ruta."', NULL,'".$_POST["id_usuario_crea"]."', 0, NOW(), NOW())";
//echo $query;
//exit(0);
		$this->objDb->insert($query);
			
	}
			
	public function modify_user($id_usuario){
$ruta="../users/user/img";
$archivo=$_FILES['cambiar_imagen']['tmp_name'];
$nombreArchivo=$_FILES['cambiar_imagen']['name'];
move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
$ruta=$ruta."/".$nombreArchivo;
$imagen_actual = $_POST["imagen"];
$passsub = strlen($_POST["pass"]);

if ($ruta =="../users/user/img/")	{

		if($passsub > 10){
		$pass = $_POST["pass"];
		
	}else{

		$pass = sha1 ($_POST["pass"]);

	}
		$query = "UPDATE sys_usuarios SET id_tipo_identificacion = '".$_POST["TipoIdentificacion"]."', id_empresa = '".$_POST["Empresa"]."',
			id_rol = '".$_POST["Rol"]."', id_estado = '".$_POST["Estado"]."', estado_civil = '".$_POST["EstadoCivil"]."', genero = '".$_POST["Genero"]."', 
		 login ='".$_POST["Login"]."', password = '{$pass}', primer_nombre = '".$_POST["PrimerNombre"]."', segundo_nombre = '".$_POST["SegundoNombre"]."',
		 primer_apellido = '".$_POST["PrimerApellido"]."', segundo_apellido = '".$_POST["SegundoApellido"]."', email = '".$_POST["Email"]."',
		 celular = '".$_POST["Celular"]."', telefono = '".$_POST["Telefono"]."',
		 direccion = '".$_POST["Direccion"]."', fecha_nacimiento = '".$_POST["FechaNacimiento"]."', identificacion = '".$_POST["identificacion"]."',
		 id_usuario_modifica = '".$_POST["id_usuario_modifica"]."', fecha_modifica = NOW() WHERE id_usuario = $id_usuario";
		 //echo $query;
		 //exit(0);
		$this->objDb->update($query);
			

	}else{
		if($passsub > 10){
		$pass = $_POST["pass"];
		
	}else{

		$pass = sha1 ($_POST["pass"]);

	}

		$query = "UPDATE sys_usuarios SET id_tipo_identificacion = '".$_POST["TipoIdentificacion"]."', id_empresa = '".$_POST["Empresa"]."',
			id_rol = '".$_POST["Rol"]."', id_estado = '".$_POST["Estado"]."', estado_civil = '".$_POST["EstadoCivil"]."', genero = '".$_POST["Genero"]."', 
		 login ='".$_POST["Login"]."', password = '{$pass}', primer_nombre = '".$_POST["PrimerNombre"]."', segundo_nombre = '".$_POST["SegundoNombre"]."',
		 primer_apellido = '".$_POST["PrimerApellido"]."', segundo_apellido = '".$_POST["SegundoApellido"]."', email = '".$_POST["Email"]."',
		 celular = '".$_POST["Celular"]."', telefono = '".$_POST["Telefono"]."',
		 imagen = '".$ruta."',direccion = '".$_POST["Direccion"]."', fecha_nacimiento = '".$_POST["FechaNacimiento"]."', identificacion = '".$_POST["identificacion"]."',
		 id_usuario_modifica = '".$_POST["id_usuario_modifica"]."', fecha_modifica = NOW() WHERE id_usuario = $id_usuario";
		 //echo $query;
		 //exit(0);
		$this->objDb->update($query);
		
		

	}
}
	public function modify_pass($id_usuario,$pass){
		

		$query = "UPDATE sys_usuarios SET  password = '{$pass}' where id_usuario = $id_usuario ";
		 
		$this->objDb->update($query);

			
	}
	public function modify_rol($id_rol){

		$query = "UPDATE sys_roles SET nombre = '".$_POST["Rol"]."', 
		 id_usuario_modifica = '".$_POST["usuario_modifica"]."', fecha_modifica = NOW() WHERE id_rol = $id_rol";
		 
		$this->objDb->update($query);

			
	}

	
	public function delete_user(){
		
		$query = "DELETE FROM sys_usuarios WHERE id_usuario = '".$_GET["id_usuario"]."' ";
		$this->objDb->delete($query);
		
	}
	public function delete_rol(){
		
		$query = "DELETE FROM sys_roles WHERE id_rol = '".$_GET["id_rol"]."' ";
		$this->objDb->delete($query);
		
	}
	
	public function look_user_profiles(){
		$query = "SELECT * FROM user_pro, mod_profile, roles, modules WHERE user_pro.idUsers = '".$_GET["idUser"]."' 
			AND user_pro.idProfile = mod_profile.idProfile AND mod_profile.idmodule = roles.idmodule 
			AND  roles.idmodule = modules.idmodule ";
		$this->result = $this->objDb->select($query);
		return $this->result;
		
	}
		
	
}

?>