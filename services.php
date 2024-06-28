
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Our Services</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            background: #ffff;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        .section-heading {
            font-size: 40px;
            text-align: center;
            margin-top: 50px;
        }

        .services-cards {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .services-card {
            width: 350px;
            border: 1px solid #ddd;
            padding: 20px;
            margin: 20px;
            text-align: center;
            cursor: pointer;
            transition: 0.5s ease-out;
        }

        .services-card:hover {
            transform: translateY(-20px);
        }

        .services-card i{
            font-size: 38px;
            margin-bottom: 20px;
            color: #3498db;
        }

        .services-card h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .services-card p {
            font-size: 15px;
            color: #666;
            line-height: 1.5;
        }

        @media screen and (max-width: 768px) {
            .services-cards{
                flex-direction: column;
                align-items: center;
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
<div class="container">
    <h1 class="section-heading">Our Services</h1>
    <div class="services-cards">
        <div class="services-card">
            <i class="fa-solid fa-key"></i>
            <h2>Password Generation</h2>
            <p>Our generator creates random passwords based on your selected parameters, such as length, and the inclusion of uppercase letters, lowercase letters, numbers, and symbols.</p>
        </div>
        <div class="services-card">
            <i class="fa-solid fa-lock"></i>
            <h2>Password Customization</h2>
            <p>Choose the desired length of your password to meet specific security requirements or personal preferences.</p>
        </div>
        <div class="services-card">
            <i class="fa-solid fa-copy"></i>
            <h2>Password History</h2>
            <p>Save generated passwords along with user-provided descriptions, making it easy to recall the purpose of each password.</p>
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
