<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if (!$_SESSION['isAuth']) {
	header("location:./index.php");
	die();
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>ShieldPass - HomePage</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<style>
		body {
			background-color: #282847;
			color: #282847
		}

		main{
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 100vh;
			padding: 2rem;
		}

		.generator {
			width: 100%;
			max-width: 640px;
			padding: 2rem 1rem;
			background-color: #fff;
			border-radius: 1rem;
		}

		h1 {
			font-size: 1.5rem;
			margin-bottom: 1rem;
		}

		input:not([type="checkbox"]),
		button {
			appearance: none;
			outline: none;
			border: none;
			background: none;
		}

		input[type="checkbox"] {
			cursor: pointer;
		}

		.password-wrap {
			position: relative;
			display: flex;
			width: 100%;
			margin-bottom: 1rem;
		}

		.password-wrap:after {
			content: '';
			display: block;
			position: absolute;
			top: 100%;
			height: 3px;
			left: 0;
			right: 0;
			border-radius: 3px;
			background: linear-gradient(to right, #ad25fc 25%, #518cd4 75%);
		}

		.password-wrap input {
			flex:  1 1 0%;
			padding: 0.5rem;
			color: #282847;
		}

		.password-wrap input::placeholder {
			color: #888;
			font-style: italic;
		}

		.password-wrap button {
			cursor: pointer;
			background: linear-gradient(to bottom, #ad25fc 25%, #518cd4 75% );
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		label {
			display: flex;
			white-space: nowrap;
			user-select: none;
			margin-bottom: 1rem;
		}

		label span {
			display: block;
			flex: 1 1 0%;
			white-space: nowrap;
		}

		p {
			margin-bottom: 1em;
		}
		

		label input[type="number"] {
			text-align: right;
		}

		button[type="submit"], input[type="button"]{
			cursor: pointer;
			padding: 0.5rem 1rem;
			color: #FFF;
			font-weight: bold;
			text-transform: uppercase;
			border-radius: 0.25rem;
			background: linear-gradient(to right, #ad25fc 25%, #518cd4 75% );
			background-size: 200%;
			background-position: 25%;
			transition: 0.3s ease-out;
			margin-bottom: 10px;
		}

		button[type="submit"]:hover, input[type="button"]:hover {
			background-position: 75%;
		}
	</style>
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
            <a href="./principal.php" class="logo">
                <img class="logo__img" src="images/logo.svg" alt="logo">
                <span class="logo__text">ShieldPass</span>
            </a>
            <nav class="nav">
                <ul class="nav__list">
                    <li><a href="./services.php" class="nav__link">Services</a></li>
                    <li><a href="./principal.php" class="nav__link">Generate Passwords</a></li>
                    <li><a href="./about.php" class="nav__link">About</a></li>
					<li>
						<a href="#" class="nav__link"><?php echo  $_SESSION['nombre']; ?></a>
						<ul class="dropdown">
							<li><a href="./historial.php" onclick="listCodes()" class="nav__link">Historial</a></li>
							<li><a href="./index.php?logout=1" class="nav__link"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
						</ul>
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
</header>
<main>
	<div class="generator">

		<h1>Password Generator</h1>

		<form id="formPassword" onSubmit="guardarPass(); return false;">

			<label class="password-wrap">
				<input type="text" name="pass" id="pass" readonly placeholder="Generate a Password">
			</label>

			<label>
				<span>Password Length:</span>
				<input type="number" name="longitud" id="longitud" value="10" min="8" max="20">
			</label>

			<label>
				<span>Include Uppercase:</span>
				<input type="checkbox" name="mayusculas" id="mayusculas" checked value="1">
			</label>

			<label>
				<span>Include Lowercase:</span>
				<input type="checkbox" name="minusculas" id="minusculas" checked value="1">
			</label>

			<label>
				<span>Include Numbers:</span>
				<input type="checkbox" name="numeros" id="numeros" checked value="1">
			</label>

			<label>
				<span>Include Symbols</span>
				<input type="checkbox" name="simbolos" id="simbolos" checked value="1">
			</label>
			<div> <input type="button" name="generar" value="Generate" onClick="generarPass();"></div>
			<p>Description: <input type="text" name="descripcion" id="descripcion" placeholder="Write a description"><br></p>

			<button name="enviar" id="enviar" type="Submit">Enviar</button>
		</form>
	</div>
</main>
	<script>
		$(document).ready(function() {
		const navEl = document.querySelector('.nav');
		const hamburgerEl = document.querySelector('.hamburger');
		
			// Manejo de la hamburguesa del menú
			hamburgerEl.addEventListener('click', () => {
					navEl.classList.toggle('nav--open');
					hamburgerEl.classList.toggle('hamburger--open');
				});
		});
</script>
	<script src="./js/principal.js"></script>
</body>
</html>
