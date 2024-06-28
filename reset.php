<?php
include_once("./clases/usuario.php");

$u=new usuario($_GET['id']);

if ($u->getCode()!=$_GET['code'] || $_GET['code']=="") {
	header("location: ./index.php");
	die();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reset Password</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div id="content">
        <div id="contenedorForm">
            <form onSubmit="resetea(); return false;" id="formReestablecer">
                <h2 class="title"><i class="fa-solid fa-key"></i> Reset Password</h2>
                <input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">
                <input type="hidden" name="idUsuario" value="<?php echo $_GET['id']; ?>">
                <div class="form-control">
                    <label for="password"><i class="fa fa-lock"></i> Password</label>
                    <input type="password" placeholder="New Password" name="pass" required>
                </div>
                <div class="form-control">
                    <label for="password"><i class="fa fa-lock"></i> Password</label>
                    <input type="password" placeholder="Repeat Password" name="pass2" required>
                </div>
                <div class="form-control-others">
                <button class="btn">REESTABLECER</button>
                </div>
            </form>
            <div id="resp">&nbsp;</div>
            <div class="form-control-others">
                <button id="btlogin"><a class="btn" href="./index.php">Go to Login</a></button>
            </div>
        </div>
    </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function resetea() {
            // ajax
            var datos = new FormData($('#formReestablecer')[0]);
            datos.append("action", "resetea");
            $.ajax({
                url: './controlador/controladorLogin.php',
                method: 'POST',
                timeout: 10000,
                data: datos,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    if (data.codErr != 0) {
                        $("#resp").html(data.msgErr);
                    } else {
                        $("#resp").html(data.msg);
                        $("#btlogin").css("display", "block");
                        $("#resbutton").css("display", "none");
                    }
                }
            });
        }
    </script>
</body>
</html>
