<?php 
    require "../../config.php"; 
    require DBAPI; 
    if (!isset($_SESSION)) session_start();
    include(HEADER_TEMPLATE); 
?>

<style>
    .table-container {
        margin-top: 30px;
    }
    .table th, .table td {
        text-align: center;
    }
    .table th.title-row {
        text-align: center;
        border: none;
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gincana Esportiva - 2023</h2>
    <p class="text-muted text-center mb-5">Confira as modalidades da edição 2023 das Esportivas da nossa gincana.</p>

    <div class="table-container">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th colspan="2" class="title-row">Modalidades</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $modalidades = [
                    '🏐 Vôlei' => 'volei',
                    '🏀 Basquete' => 'basquete',
                    '⚽ Futsal' => 'futsal',
                    '💪 Queda de Braço' => 'queda-de-braco',
                    '🤾 Handebol' => 'handebol',
                    '🪢 Cabo de Guerra' => 'cabo-de-guerra'
                ];

                foreach ($modalidades as $nome => $slug) {
                    echo "<tr>";
                    echo "<td>{$nome}</td>";
                    echo "<td><a href='{$slug}.php' class='btn btn-outline-danger'>Visualizar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-5">
        <a href="../index.php" class="btn btn-outline-danger">← Voltar para Gincanas</a>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
