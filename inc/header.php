<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Relembra FP</title>
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
        <meta name="description" content="TCC">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo BASEURL; ?>img/logosite.png" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">

        <style>
            body {
                padding-top: 70px;
                padding-bottom: 20px;
            }
            .btn-light {
                background-color: #f8d7da;
                border-color: rgb(125, 125, 125);
                color:rgb(255, 255, 255);
            }

            header, #actions {
                margin-top: 10px;
            }
            .navbar {
                background-color: #b80404;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .navbar .navbar-brand,
            .navbar .nav-link {
                color: #000;
            }
            .navbar-nav .nav-item .nav-link:hover {
                color: rgb(0, 0, 0);
            }
        </style>
    </head>

    <body>

    <nav class="navbar navbar-expand-lg fixed-top custom-navbar">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
    <a href="<?php echo BASEURL; ?>index.php"><img src="<?php echo BASEURL; ?>img/logosite.png" alt="Logo" width="40"></a>

    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
  <ul class="navbar-nav mx-auto">
    <li class="nav-item"><a class="nav-link" href="<?php echo BASEURL; ?>esportiva/index.php"><i class="fa-solid fa-volleyball"></i> Esportivas</a></li>
    <li class="nav-item"><a class="nav-link" href="<?php echo BASEURL; ?>filantropica/index.php"><i class="fa-solid fa-children"></i> Filantrópicas</a></li>
    <li class="nav-item"><a class="nav-link" href="<?php echo BASEURL; ?>cultural/index.php"><i class="fa-solid fa-masks-theater"></i> Culturais</a></li>
    <li class="nav-item"><a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php"><i class="fa-solid fa-users"></i> Login</a></li>
  </ul>
</div>

  </div>
</nav>


        <main class="container">
        <script>
            const toggleBtn = document.getElementById('toggleTheme');
            const themeIcon = document.getElementById('themeIcon');
            const body = document.body;

            // Checar preferência salva
            if (localStorage.getItem('theme') === 'dark') {
                body.classList.add('dark-theme');
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            }

            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                body.classList.toggle('dark-theme');

                const isDark = body.classList.contains('dark-theme');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');

                themeIcon.classList.toggle('fa-moon', !isDark);
                themeIcon.classList.toggle('fa-sun', isDark);
            });
        </script>
        
