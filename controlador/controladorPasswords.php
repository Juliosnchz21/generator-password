<?php
header("Content-Type: application/json");
include_once("../clases/code.php");

$action=$_POST['action'];

$respuesta['codErr']=0;
$respuesta['msgErr']="";

if ($action =="generar"){
	$c=new Code();
	$may=$_POST['mayusculas']? true:false;
	$min=$_POST['minusculas']? true:false;
	$num=$_POST['numeros']? true:false;
	$sim=$_POST['simbolos']? true:false;
	
	$p=$c->generarRandomCode($_POST['longitud'], $may, $min, $num, $sim);
	
	$respuesta['codErr']=0;
	$respuesta['msgErr']="";
	$respuesta['msg']=$p;
}

if ($action=="insertar"){
	$c=new Code();
	$c->setDescripcion($_POST['descripcion']);
	$c->setCode($_POST['pass']);
	$c->setIdUsuario($_SESSION['idUsuario']);
	if($c->insert()){
		$respuesta['codErr']=0;
		$respuesta['msgErr']="";
		//$respuesta['msg']=$c->getCode();
		$respuesta['msg']="Password creado.";
	} else {
		$respuesta['codErr']=$c->getErrCode();
		$respuesta['msgErr']=$c->getErrMsg();
	}
	
	
}
if ($action=="delete"){
	$c=new Code($_POST['id']);
	if ($c->delete()) {
		$respuesta['codErr']=0;
		$respuesta['msgErr']="";
		$respuesta['msg']="Password Eliminado.";
	}
}

if ($action="listar"){
	$c=new Code();
	$c->setIdUsuario($_SESSION['idUsuario']);
	$r=$c->listCodes();
	
	for ($x=0; $x<count($r); $x++){
		$respuesta['codes'][$x]['idCode']=$r[$x]['idCode'];
		$respuesta['codes'][$x]['code']=$r[$x]['code'];
		$respuesta['codes'][$x]['descripcion']=$r[$x]['descripcion'];
	}
	$respuesta['codErr']=0;
	$respuesta['msgErr']="";
	
}

echo json_encode($respuesta);
?>