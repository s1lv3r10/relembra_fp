<?php 
    require "../config.php"; 
    require DBAPI; 
    if (!isset($_SESSION)) session_start();
    include(HEADER_TEMPLATE); 
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gincana Esportiva - 2023</h2>
    <p class="text-muted text-center mb-5">Confira os momentos marcantes da edição 2023 das Esportivas da nossa gincana.</p>


    <!-- EM1 - Informática para Internet -->
    <h4 class="mt-5 border-bottom pb-2">EM1 - Informática para Internet</h4>
    <div class="row g-4 mt-2">
        <!-- Adicione as imagens e textos do EM1 aqui -->
    </div>

    <!-- EM2 - Desenvolvimento de Sistemas -->
    <h4 class="mt-5 border-bottom pb-2">EM2 - Desenvolvimento de Sistemas</h4>
    <div class="row g-4 mt-2">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="../img/em223.jpg" class="card-img-top" alt="Foto da gincana 2023">
                <div class="card-body">
                    <p class="card-text">Time EM2 2023</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="../img/mascotes223.jpg" class="card-img-top" alt="Mascotes EM2">
                <div class="card-body">
                    <p class="card-text">Os Mascotes do EM2: Grifo Hipocampo e Komainu</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="../img/torcidaem223.jpg" class="card-img-top" alt="Torcida EM2">
                <div class="card-body">
                    <p class="card-text">Torcida EM2</p>
                </div>
            </div>
        </div>
    </div>

    <!-- EM3 - Eventos -->
    <h4 class="mt-5 border-bottom pb-2">EM3 - Eventos</h4>
    <div class="row g-4 mt-2">
        <!-- Adicione as imagens e textos do EM3 aqui -->
    </div>

    <!-- EM4 - Edificações -->
    <h4 class="mt-5 border-bottom pb-2">EM4 - Edificações</h4>
    <div class="row g-4 mt-2">
        <!-- Adicione as imagens e textos do EM4 aqui -->
    </div>

    <!-- EM5 - Administração -->
    <h4 class="mt-5 border-bottom pb-2">EM5 - Administração</h4>
    <div class="row g-4 mt-2">
        <!-- Adicione as imagens e textos do EM5 aqui -->
    </div>

    <!-- EM6 - Logística -->
    <h4 class="mt-5 border-bottom pb-2">EM6 - Logística</h4>
    <div class="row g-4 mt-2">
        <!-- Adicione as imagens e textos do EM6 aqui -->
    </div>

    <!-- EM7 - Recursos Humanos -->
    <h4 class="mt-5 border-bottom pb-2">EM7 - Recursos Humanos</h4>
    <div class="row g-4 mt-2">
        <!-- Adicione as imagens e textos do EM7 aqui -->
    </div>

    <!-- EM8 - Contabilidade -->
    <h4 class="mt-5 border-bottom pb-2">EM8 - Contabilidade</h4>
    <div class="row g-4 mt-2">
        <!-- Adicione as imagens e textos do EM8 aqui -->
    </div>

    <!-- Botão Voltar -->
    <div class="text-center mt-5">
        <a href="index.php" class="btn btn-outline-danger">← Voltar para Gincanas</a>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
