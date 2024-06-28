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
<title>Página Principal</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            background: #ffff;
        }

        .history-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        h1{
            color: #009879;
        }
        .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .content-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type(even) {
            border-bottom: 2px solid #009879;
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
                julio@gmail.com
            </section>
        </div>
    </div>
    <div class="bottom-bar">
        <div class="bottom-bar__content">
            <a href="./" class="logo">
                <img class="logo__img" src="images/logo.svg" alt="logo">
                <span class="logo__text">ShieldPass</span>
            </a>
            <nav class="nav">
                <ul class="nav__list">
                    <li><a href="./services.php" class="nav__link">Services</a></li>
                    <li><a href="./principal.php" class="nav__link">Generate Passwords</a></li>
                    <li><a href="./about.php" class="nav__link">About</a></li>
					<li>
						<a href="./principal.php" class="nav__link"><?php echo  $_SESSION['nombre']; ?></a>
						<ul class="dropdown">
							<li><a href="./historial.php" onclick="listCodes()" class="nav__link">History</a></li>
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
<div class="history-content">
    <h1>Passwords History</h1>
	<table class="content-table">
		<thead>
			<tr>
				<th>Password</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody id="resultlist">
		
		</tbody>
	</table>
</div>  
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
