<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Relembra FP</title>
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
        <meta name="description" content="TCC">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo BASEURL; ?>img/RFP.ico" type="image/x-icon">

        <!-- Bootstrap CSS -->
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
                color: #721c24;
            }

            header, #actions {
                margin-top: 10px;
            }
            .navbar {
                background-color: rgb(255, 255, 255);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .navbar .navbar-brand,
            .navbar .nav-link {
                color: #000;
            }
            .navbar-nav .nav-item .nav-link:hover {
                color: rgb(100, 100, 100);
            }
        </style>
    </head>

    <body>

        <nav class="navbar navbar-expand-xxl navbar-light fixed-top">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand me-2" href="<?php echo BASEURL; ?>">
                        <i class="fa-solid fa-house-chimney"></i>
                    </a>
                    <a class="nav-link p-0" href="#" id="toggleTheme" title="Alternar tema">
                        <i class="fa-solid fa-circle-half-stroke" id="themeIcon"></i>
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon "></span>
                </button>
           
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="navbarEsportivas">
                                <i class="fa-solid fa-volleyball"></i> Esportivas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="navbarFilantropicas">
                                <i class="fa-solid fa-children"></i> Filantrópicas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="navbarCulturais">
                                <i class="fa-solid fa-masks-theater"></i> Culturais
                            </a>
                        </li>

                        <?php if (isset($_SESSION['user'])) : ?>
                            <?php if ($_SESSION['user'] == "admin") : ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuarios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-user-lock"></i> Usuários
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios"><i class="fa-solid fa-user-lock"></i> Gerenciar Usuários</a></li>
                                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/add.php"><i class="fa-solid fa-user-tie"></i> Novo Usuário</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASEURL; ?>inc/logout.php">
                                    Bem-vindo <?php echo $_SESSION['user']; ?>! <i class="fa-solid fa-person-walking-arrow-right"></i> Desconectar
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
                                    <i class="fa-solid fa-users"></i> Login
                                </a>
                            </li>
                        <?php endif; ?>
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
        
