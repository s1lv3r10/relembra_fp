<?php
require "../../config.php";
require DBAPI;
if (!isset($_SESSION)) session_start();
include(HEADER_TEMPLATE);

// Função para obter o IP do usuário
function getUserIP() {
    return $_SERVER['REMOTE_ADDR'];
}

// Carregar mídias do vôlei agrupadas por EM
$midiasPorTurma = [];
$sql = "SELECT * FROM midia WHERE evento_md = 'Vôlei' AND ano_md = 2023 ORDER BY em_md";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $midiasPorTurma[$row['em_md']][] = $row;
}
?>

<style>
    .section-title { margin-top: 50px; margin-bottom: 30px; text-align: center; font-size: 2rem; color: #b30000; }
    .media-card { margin-bottom: 30px; }
    .media-card img, .media-card video { max-width: 100%; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .btn-group { margin-top: 10px; }
</style>

<div class="container mt-5">
    <h2 class="text-center mb-4">🏐 Vôlei - Gincana Esportiva 2023</h2>
    <p class="text-muted text-center mb-5">Confira fotos e vídeos da modalidade de Vôlei por turma.</p>

    <?php foreach ($midiasPorTurma as $em => $midias): ?>
        <h3 class="section-title">Turma <?= htmlspecialchars($em) ?></h3>
        <div class="row">
            <?php foreach ($midias as $midia):
                $id_md = $midia['id_md'];
                $tipo = $midia['tipo_md'];
                $src = $midia['midia_md'];

                // Buscar curtidas
                $curtidas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM curtidas WHERE id_md = $id_md"))['total'];

                // Buscar comentários
                $comentarios_query = mysqli_query($conn, "SELECT * FROM comentarios WHERE id_md = $id_md ORDER BY data DESC");
            ?>
            <div class="col-md-6 media-card">
                <?php if ($tipo == 'img'): ?>
                    <img src="<?= $src ?>" alt="Imagem Vôlei">
                <?php elseif ($tipo == 'video'): ?>
                    <video controls><source src="<?= $src ?>" type="video/mp4"></video>
                <?php endif; ?>

                <div class="btn-group">
                    <form action="volei_like.php" method="post" style="display:inline;">
                        <input type="hidden" name="id_md" value="<?= $id_md ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger">❤️ Curtir (<?= $curtidas ?>)</button>
                    </form>
                    <button onclick="toggleComentario(<?= $id_md ?>)" class="btn btn-sm btn-outline-secondary">💬 Comentar</button>
                </div>

                <div class="comentarios mt-2" id="comentarios_<?= $id_md ?>">
                    <form action="volei_comentario.php" method="post">
                        <input type="hidden" name="id_md" value="<?= $id_md ?>">
                        <div class="input-group mt-2">
                            <input type="text" name="comentario" class="form-control form-control-sm" placeholder="Digite seu comentário..." required>
                            <button class="btn btn-danger btn-sm" type="submit">Enviar</button>
                        </div>
                    </form>
                    <div class="mt-2">
                        <?php while ($com = mysqli_fetch_assoc($comentarios_query)): ?>
                            <p class="text-muted small">💬 <?= htmlspecialchars($com['comentario']) ?> <br><small><?= $com['data'] ?></small></p>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <div class="text-center mt-5">
        <a href="../2023/esportiva2023.php" class="btn btn-outline-danger">← Voltar</a>
    </div>
</div>

<script>
function toggleComentario(id) {
    const el = document.getElementById('comentarios_' + id);
    el.style.display = el.style.display === 'none' ? 'block' : 'none';
}
</script>

<?php include(FOOTER_TEMPLATE); ?>
