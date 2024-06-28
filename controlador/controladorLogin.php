<?php
header("Content-Type: application/json");
include_once("../clases/usuario.php");
include_once("../email.php");

$action=$_POST['action'];

$respuesta = array(
    "codErr" => 0,
    "msgErr" => "",
    "msg" => ""
);


if ($action=="login"){
	$u=new Usuario();
	$u->setEmail($_POST['email']);
	$u->setPassword($_POST['pass']);
	
	if ($u->login()){
		session_start();
		$respuesta['codErr']=0;
		$respuesta['msgErr']="";
		$_SESSION['idUsuario']=$u->getIdUsuatio();
		$_SESSION['isAuth']=true;
		$_SESSION['pass']=$_POST['pass'];
		$_SESSION['nombre']=$u->getNombre();
		
	} else{
		$respuesta['codErr']=1;
		$respuesta['msgErr']="Usuario o Password Incorrecto o no está verificado.";
	}
}

if ($action=="registro"){
	
	//comprobar que no exista un usuario con ese email
	$u=new Usuario();
	$u->setEmail($_POST['email']);

	//comprobar passswords
	//comprobar email
	$respuesta['msg2']=$u->getErrMsg();
	$u->setPassword($_POST['pass']);
	$u->setCode(rand(100000000,900000000));
	$u->setNombre($_POST['nombre']);

	if ($u->insert()) {
		sendEmail($u->getEmail(), "Registro de Usuario", "<p>para finalizar el registro visite: http://localhost/web/verificar.php?id={$u->getIdUsuatio()}&code={$u->getCode()}</p>", "para finalizar el registro visite: http://localhost/web/passmanager/verificar.php?id={$u->getIdUsuatio()}&code={$u->getCode()}");
		$respuesta['codErr']=0;
		$respuesta['msg']="Revise su correo para verificar el registro.";
	} else {
		sendEmail($u->getEmail(), "Registro de Usuario", "<p>Alguien está intentando registrarse con su email</p>", "Alguien está intentando registrarse con tu email");
		$respuesta['codErr']=0;
		$respuesta['msg']="Revise su correo para verificar el registro.";
	}
}

if ($action=="reestablecer"){
	$u=new Usuario();
	$u->setEmail($_POST['email']);
	
	if ($u->loadByEmail()) {
		//OK
		$u->setCode(rand(100000000,900000000));
		$u->update();
		sendEmail($u->getEmail(), "Reestablecer contraseña", "<p>Para reestablecer la contraseña visite: http://localhost/web/reset.php?id={$u->getIdUsuatio()}&code={$u->getCode()}</p>", "Para reestablecer la contraseña visite: http://localhost/web/reset.php?id={$u->getIdUsuatio()}&code={$u->getCode()}");

	} 
	$respuesta['codErr']=0;
	$respuesta['msg']="Revise su correo para reestablecer la contraseña.";
	
}
if ($action=="resetea"){
	$u=new usuario($_POST['idUsuario']);
	
	if ($u->getCode()!=$_POST['code'] || $_POST['code']=="") {
		$respuesta['codErr']=1;
		$respuesta['msgErr']="Me estás timando!!!";
	} else {
		if ($_POST['pass']!=$_POST['pass2']){
			$respuesta['codErr']=2;
			$respuesta['msgErr']="Los Password no coinciden";
		} else{
			//OK
			$u->setPassword($_POST['pass']);
			$u->setCode(null);
			$u->update();
			
			$respuesta['codErr']=0;
			$respuesta['msg']="El password se ha reseteado.";
		}
	}
}

echo json_encode($respuesta);
?>