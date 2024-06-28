<?php
include_once("./clases/usuario.php");
$id=$_GET['id'];
$code=$_GET['code'];

$u=new Usuario($id);

if ($code==$u->getCode() && $code){
	$u->setCode(null);
	$u->update();
	$msg="Usuario verificado.<br>
                <div class='form-control-others'><a class='btn' href='./index.php'>Login</a></div>";
} else {
	$msg="Fallo en la Verificación de Usuario.";
}

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Verificación de Usuario</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/main.css">
</head>

<body>
	<div class="content">
	<div id="contenedorForm">
		<h2>Verificacion de Usuario</h2>
		<div id="resp">
			<?php echo $msg; ?>
		</div>
	</div>
	
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
