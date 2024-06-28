
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>About us</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f1f1;
        }

        .about-section {
            background: url(images/background.jpg);
            background-size: 55%;
            background-color: #fdfdfd;
            overflow: hidden;
            padding: 100px 0;
        }

        .inner-container {
            width: 55%;
            float: right;
            background-color: #fdfdfd;
            padding: 150px;
        }

        .inner-container h1 {
            margin-bottom: 30px;
            font-size: 30px;
            font-weight: 900;
        }
        
        .text {
            font-size: 13px;
            color: #545454;
            line-height: 30px;
            text-align: justify;
            margin-bottom: 40px;
        }

        .skills {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 13px;
        }

        @media screen and (max-width:1200px) {
            .inner-container {
                padding: 88px;
            }
        }

        @media screen and (max-width:1000px) {
            .about-section {
                background-size: 100%;
                padding: 100px 40px;
            }
            .inner-container {
                width: 100%;
            }
        }

        @media screen and (max-width:600px) {
            .about-section {
                padding: 0;
            }
            .inner-container {
                padding: 60px;
            }
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
                    <li><a href="./about.php" class="nav__link">About</a></li>
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
<div class="about-section">
    <div class="inner-container">
        <h1>About us</h1>
        <p class="text">
            Welcome to ShieldPass, your ultimate solution for generating secure and reliable passwords. In today's digital world, protecting your online accounts is more important than ever. We understand the challenges that come with creating and managing strong passwords, which is why we developed ShieldPass to simplify and enhance your password management experience.
        </p>
        <div class="skills">
            <span>Password History</span>
            <span>User-Friendly Interface</span>
            <span>Comprehensive Security</span>
        </div>
    </div>
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
