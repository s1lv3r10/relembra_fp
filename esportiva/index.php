<?php 
    require "../config.php"; 
    require DBAPI; 
    include(HEADER_TEMPLATE);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Histórico de Gincanas</h2>
    <p class="text-muted text-center mb-5">Escolha um ano para ver os destaques e resultados da gincana.</p>

    <div class="row justify-content-center g-4">
        <!-- Ano 2025 -->
        <div class="col-md-3">
            <a href="2025.php" class="btn btn-outline-primary btn-lg w-100 py-3 rounded-4">Gincana 2025</a>
        </div>

        <!-- Ano 2024 -->
        <div class="col-md-3">
            <a href="2024.php" class="btn btn-outline-secondary btn-lg w-100 py-3 rounded-4">Gincana 2024</a>
        </div>

        <!-- Ano 2023 -->
        <div class="col-md-3">
            <a href="2023.php" class="btn btn-outline-dark btn-lg w-100 py-3 rounded-4">Gincana 2023</a>
        </div>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>

