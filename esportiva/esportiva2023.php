<?php 
    require "../config.php"; 
    require DBAPI; 
    if (!isset($_SESSION)) session_start();
    include(HEADER_TEMPLATE); 
?>

<style>
    .curso-box {
        border: 2px solid #dee2e6;
        border-radius: 8px;
        padding: 30px 20px;
        margin-bottom: 50px;
        background-color: #f8f9fa;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gincana Esportiva - 2023</h2>
    <p class="text-muted text-center mb-5">Confira os momentos marcantes da edição 2023 das Esportivas da nossa gincana.</p>

<?php
// Cursos
$cursos = [
    'EM1 - Informática para Internet',
    'EM2 - Desenvolvimento de Sistemas',
    'EM3 - Eventos',
    'EM4 - Edificações',
    'EM5 - Administração',
    'EM6 - Logística',
    'EM7 - Recursos Humanos',
    'EM8 - Contabilidade'
];

// Modalidades
$modalidades = [
    '🏐 Vôlei',
    '🏀 Basquete',
    '⚽ Futsal',
    '💪 Queda de Braço',
    '🤾 Handebol',
    '🪢 Cabo de Guerra'
];

foreach ($cursos as $curso) {
    echo "<div class='curso-box'>";
    echo "<h4 class='mb-4 border-bottom pb-2'>{$curso}</h4>";

    $cursoFolder = strtolower(str_replace(' ', '', explode(' - ', $curso)[0])); // "em1", "em2"...

    foreach ($modalidades as $modalidade) {
        echo "<h5 class='mt-4 text-primary'>{$modalidade}</h5>";
        echo "<div class='row g-4 mt-1'>";

        $modalidadeSlug = strtolower(str_replace([' ', '(', ')', '🏐', '🏀', '⚽', '💪', '🤾', '🪢'], '', $modalidade)); // volei, futsal, etc.

        for ($i = 1; $i <= 3; $i++) {
            $imgPath = "../img/2023/esportivas/{$cursoFolder}/{$modalidadeSlug}{$i}.jpg";
            $imgSrc = file_exists($imgPath) ? $imgPath : "../img/padrao.jpg";

            echo "
            <div class='col-md-4'>
                <div class='card shadow-sm'>
                    <img src='{$imgSrc}' class='card-img-top' alt='Imagem do {$curso} - {$modalidade}'>
                    <div class='card-body'>
                        <p class='card-text'>{$curso} - {$modalidade} - Foto {$i}</p>
                    </div>
                </div>
            </div>";
        }

        echo "</div>"; // fecha row
    }

    echo "</div>"; // fecha curso-box
}
?>

<!-- Botão Voltar -->
<div class="text-center mt-5">
    <a href="index.php" class="btn btn-outline-danger">← Voltar para Gincanas</a>
</div>

</div>

<?php include(FOOTER_TEMPLATE); ?>
