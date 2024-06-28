<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include_once(__DIR__."./clases/config.php");

// Verificar si se recibió 'logout' como parámetro GET y si su valor es 1
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
    $_SESSION['idUsuario'] = null;
    $_SESSION['isAuth'] = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ShieldPass - Secure your passwords with ease.">
    <meta name="keywords" content="password generator, secure passwords, ShieldPass">
    <title>
        Shieldpass
    </title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/simple-generator.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header class="header">
        <div class="top-bar">
            <div class="top-bar__content">
                <section class="phone">
                    <i class="fa fa-phone icon"></i>
                    1-800-922-0444
                </section>
                <section class="email">
                    <i class="fa fa-envelope icon"></i>
                    info@cloudservices.com
                </section>
            </div>
        </div>

        <div class="bottom-bar">
            <div class="bottom-bar__content">
                <a href="./index.php" class="logo">
                    <img class="logo__img" src="images/logo.svg" alt="logo">
                    <span class="logo__text">ShieldPass</span>
                </a>
                <nav class="nav">
                    <ul class="nav__list">
                        <li><a href="./services.php" class="nav__link">Services</a></li>
                        <li><a href="./about.php" class="nav__link">About</a></li>
                        <li>
                            <button id="modalLogin" class="btn">Login</button>
                        </li>
                    </ul>
                </nav>
                <div class="hamburger">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
            </div>
        </div>
        <!-- Login, Register and reset-password forms -->
        <div class="modal-container">
            <div class="modal-content">
                <i class="fa fa-times" id="closeModal"></i>

                <!-- Formulario de Login -->
                <form class="login" onSubmit="login(); return false;" id="formLogin">
                    <h2> <i class="fa-solid fa-arrow-right-to-bracket"></i> Login</h2>
                    <div class="form-control">
                        <label for="emailLogin"> <i class="fa fa-envelope"></i> Email</label>
                        <input type="email" name="email" id="emailLogin" placeholder="Enter your email" >
                    </div>
                    <div class="form-control">
                        <label for="passwordLogin"> <i class="fa fa-lock"></i> Password</label>
                        <input type="password" name="pass" id="passwordLogin" placeholder="Enter your password" >
                    </div>
                    <div class="form-control-others">
                        <div class="forget">
                            <label for="remeber" class="remeber">
                            <input type="checkbox" id="remember" name="remember">
                            &nbsp; Remember me
                            </label>
                            <label for="reset">
                                <a href="javascript:void(0)" id="Reset">Forget Password?</a>
                            </label>
                        </div>
                    </div>
                    <div class="form-control-others">
                        <button class="btn">LOGIN</button>
                    </div>
                    <div class="form-control-others">
                        <label for="create">
                            Don't have an account?
                            <a href="javascript:void(0)" id="Create">Sign up now</a>
                        </label>
                    </div>
                    <div class="form-control-others">
                        <div id="loginResp">&nbsp;</div>
                    </div>
                </form>

                <!-- Formulario de Registro -->
                <form class="registration" onSubmit="registro(); return false;" id="formRegistro">
                    <h2> <i class="fa-solid fa-user-plus"></i> Registration</h2>
                    <div class="form-control">
                        <label for="username"> <i class="fa fa-user"></i> Username</label>
                        <input type="text" name="nombre" id="username" placeholder="Enter your username" >
                    </div>
                    <div class="form-control">
                        <label for="emailRegistro"> <i class="fa fa-envelope"></i> Email</label>
                        <input type="email" name="email" id="emailRegistro" placeholder="Enter your email" >
                    </div>
                    <div class="form-control">
                        <label for="passwordRegistro"> <i class="fa fa-lock"></i> Password</label>
                        <input type="password" name="pass" id="passwordRegistro" placeholder="Enter your password" >
                    </div>
                    <div class="form-control-others">
                        <div class="terms">
                            <label for="terms" class="terms">
                                <input type="checkbox" id="terms" >
                                &nbsp; I read and agree to Terms & Conditions
                            </label>
                        </div>
                    </div>
                    <div class="form-control-others">
                        <button class="btn">CREATE ACCOUNT</button>
                    </div>
                    <div class="form-control-others">
                        <label for="create">
                            Already have an account?
                            <a href="javascript:void(0)" id="loginHere">Login</a>
                        </label>
                    </div>
                    <div class="form-control-others">
                        <div id="registerResp">&nbsp;</div>
                    </div>
                </form>

                <!-- Formulario de Restablecimiento de Contraseña -->
                <form class="reset-password" onSubmit="reestablecer(); return false;" id="formReestablecer">
                    <h2> <i class="fa-solid fa-key"></i> Reset Password</h2>
                    <div class="form-control">
                        <label for="reset-email"> <i class="fa fa-envelope"></i> Email</label>
                        <input type="email" name="email" id="reset-email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-control-others">
                        <button class="btn">Reset Password</button>
                    </div>
                    <div class="form-control-others">
                        <div id="restablecerResp">&nbsp;</div>
                    </div>
                </form>

            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <h1>Generate a <br><span>Random Password</span></h1>
            <div class="display">
                <input type="text" id="password" placeholder="Password">
                <img src="images/copy.png" alt="copy-logo" onclick="copyPassword()">
            </div>
            <button onclick="createPassword()"><img src="images/generate.png" alt="generate-logo">Generate Password</button>
        </div>
    </main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/login.js"></script>
<script src="js/simple-generator.js"></script>
</body>
</html>