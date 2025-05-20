<?php 
require "../config.php"; 
require DBAPI; 
if (!isset($_SESSION)) session_start(); 
include(HEADER_TEMPLATE); 
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gincana Esportiva - 2023</h2>
    <p class="text-muted text-center mb-4">Tabela com registros das modalidades e cursos participantes.</p>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Modalidade</th>
                    <th>Ano</th>
                    <th>Curso</th>
                    <th>Descrição</th>
                    <th>Imagem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ano = 2023;

                $cursos = [
                    'em1' => 'EM1 - Informática para Internet',
                    'em2' => 'EM2 - Desenvolvimento de Sistemas',
                    'em3' => 'EM3 - Eventos',
                    'em4' => 'EM4 - Edificações',
                    'em5' => 'EM5 - Administração',
                    'em6' => 'EM6 - Logística',
                    'em7' => 'EM7 - Recursos Humanos',
                    'em8' => 'EM8 - Contabilidade'
                ];

                $modalidades = [
                    'volei' => '🏐 Vôlei',
                    'basquete' => '🏀 Basquete',
                    'futsal' => '⚽ Futsal',
                    'quedadebraco' => '💪 Queda de Braço',
                    'handebol' => '🤾 Handebol',
                    'cabodeguerra' => '🪢 Cabo de Guerra'
                ];

                foreach ($modalidades as $slug => $nomeModalidade) {
                    foreach ($cursos as $codigo => $nomeCurso) {
                        for ($i = 1; $i <= 3; $i++) {
                            $imgPath = "../img/{$ano}/esportivas/{$codigo}/{$slug}{$i}.jpg";
                            if (file_exists($imgPath)) {
                                $descricao = "Foto {$i} do {$nomeCurso} na modalidade {$nomeModalidade}";
                                echo "
                                    <tr>
                                        <td>{$nomeModalidade}</td>
                                        <td>{$ano}</td>
                                        <td>{$nomeCurso}</td>
                                        <td>{$descricao}</td>
                                        <td><img src='{$imgPath}' alt='{$descricao}' class='img-thumbnail' style='max-width: 150px;'></td>
                                    </tr>";
                            }
                        }
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Botão Voltar -->
    <div class="text-center mt-5">
        <a href="index.php" class="btn btn-outline-danger">← Voltar para Gincanas</a>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
