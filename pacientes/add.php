<?php 
  include("functions.php");
  if (!isset($_SESSION)) session_start();
  if (isset($_SESSION['user'])){
	  }
 else {
	  $_SESSION['message'] = "Você precisa estar logado para acessar esse recurso!";
	  $_SESSION['type'] = "danger";
	  header("Location: " .  BASEURL . "index.php");
  }
  add();
  include(HEADER_TEMPLATE); ?>

            <h2 class="mt-2">Novo Paciente</h2>

            <form action="add.php" method="post" enctype="multipart/form-data">
                <!-- area de campos do form -->
                <hr />
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="nome">Nome.</label>
                        <input type="text" class="form-control" id="nome" name="paciente[nome]" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="diagnostico">Diagnóstico</label>
                        <input type="text" class="form-control" id="diagnostico" name="paciente[diagnostico]" required>
                    </div>
                </div>
                
                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="datanascimento">Data de Nascimento.</label>
                        <input type="date" class="form-control" id="datanascimento" name="paciente[datanascimento]" required>
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="dataentrada">Data de Entrada</label>
                        <input type="date" class="form-control" id="dataentrada" name="paciente[dataentrada]" required>
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-md-4">
                        <label for="foto">Foto NF</label>
                        <input type="file" class="form-control" id="foto" name="foto" required  >
                    </div>

                    <div class="form-group col-md-2">
                        <label for="imgPreview">Pré visualização</label>
                        <img class="form-control rounded" id="imgPreview" src="./fotos/semimagem.jpg" alt="" srcset="">
                    </div>

                </div>

                <div id="actions" class="row mt-2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
                        <a href="index.php" class="btn btn-light"><i class="fa-solid fa-arrow-left"></i> Cancelar</a>
                    </div>
                </div>
            </form>

<?php include(FOOTER_TEMPLATE); ?>
        <script>
            $(document).ready(() => {
                $("#foto").change(function () {
                    const file = this.files[0];
                    if (file) {
                        let reader = new FileReader();
                        reader.onload = function (event) {
                            $("#imgPreview").attr("src", event.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>