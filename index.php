<?php 
    require "config.php"; 
    require DBAPI; 
	if (!isset($_SESSION)) session_start();
    include(HEADER_TEMPLATE);
    $db = open_database(); 
?>

<div class="hero rounded text-center">
    <h1 class="display-5">Centro de Memória da Escola</h1>
    <p class="lead">Conheça a história, os campeões e os momentos inesquecíveis da nossa escola.</p>
</div>

<div class="container mt-5">
    <?php if ($db) : ?>
        <div class="row justify-content-center g-4">
            <?php if (isset($_SESSION['user'])) : ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-custom text-center">
                        <div class="card-body">
                            <i class="fa-solid fa-pen-to-square fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Nova Postagem</h5>
                            <a href="<?php echo BASEURL; ?>postar.php" class="btn btn-outline-primary">Postar</a>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <div class="col-md-6 col-lg-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-ranking-star fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title">Maiores Placares</h5>
                        <a href="<?php echo BASEURL; ?>placares.php" class="btn btn-outline-warning">Ver</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-trophy fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Vencedores da Gincana</h5>
                        <a href="<?php echo BASEURL; ?>vencedores.php" class="btn btn-outline-success">Ver</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card card-custom text-center">
                    <div class="card-body">
                        <i class="fa-solid fa-school fa-3x mb-3 text-info"></i>
                        <h5 class="card-title">História da Escola</h5>
                        <a href="<?php echo BASEURL; ?>historia.php" class="btn btn-outline-info">Ver</a>
                    </div>
                </div>
            </div>

            <div class="container text-center mt-5">
                <h2 class="mb-4">Categorias da Gincana</h2>
                <div class="row justify-content-center g-4">
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <i class="fa-solid fa-hands-helping fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Filantrópica</h5>
                                <a href="filantropica/index.php" class="btn btn-outline-primary">Acessar</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <i class="fa-solid fa-theater-masks fa-3x text-warning mb-3"></i>
                                <h5 class="card-title">Cultural</h5>
                                <a href="cultural/index.php" class="btn btn-outline-warning">Acessar</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <i class="fa-solid fa-futbol fa-3x text-success mb-3"></i>
                                <h5 class="card-title">Esportiva</h5>
                                <a href="esportiva/index.php" class="btn btn-outline-success">Acessar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin") : ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card card-custom text-center">
                        <div class="card-body">
                            <i class="fa-solid fa-user-shield fa-3x mb-3 text-danger"></i>
                            <h5 class="card-title">Gerenciar Usuários</h5>
                            <a href="<?php echo BASEURL; ?>usuarios.php" class="btn btn-outline-danger">Acessar</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <?php if (!empty($_SESSION['message'])) : ?>
            <div class="alert alert-<?php echo $_SESSION['type']; ?> mt-4" role="alert">
                <strong>Erro:</strong> Não foi possível conectar ao banco de dados.<br>
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php clear_messages(); ?>
        <?php endif ?>
    <?php endif; ?>
</div>

<?php include(FOOTER_TEMPLATE); ?>
