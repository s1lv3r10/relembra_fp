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
  edit();
  include(HEADER_TEMPLATE);
?>

		<header>
			<h2>Atualizar Dados do Paciente</h2>
		</header>

		<form action="edit.php?id=<?php echo $paciente['id']; ?>" method="post" enctype="multipart/form-data">
		  <hr>
			<div class="row">
				<div class="form-group col-md-8">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" name="paciente[nome]" value="<?php echo $paciente['nome']; ?>">
				</div>
			</div>
			
			<div class="row">
				<div class="form-group col-md-4">
					<label for="diagnostico">Diagnóstico</label>
					<input type="text" class="form-control" name="paciente[diagnostico]" value="<?php echo $paciente['diagnostico']; ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-4">
					<label for="datanascimento">Data de Nascimento</label>
					<input type="date" class="form-control" name="paciente[datanascimento]" value="<?php echo formatadata($paciente['datanascimento'], "Y-m-d"); ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-4">
					<label for="dataentrada">Data de Entrada</label>
					<input type="date" class="form-control" name="paciente[dataentrada]" value="<?php echo formatadata($paciente['dataentrada'], "Y-m-d"); ?>">
				</div>
			</div>

			<div class="row">
                    <?php
						
                        $foto = "";
                        if (empty($paciente['foto'])) {
                            $foto = "sem_imagem.jpg";
                        } else {
							
							
                            $foto = $paciente['foto'];
                        }
                    ?>
                    <div class="form-group col-md-4">
                        <label for="foto">Foto NF</label>
                        <input type="file" class="form-control" id="foto" name="foto" value="fotos/<?php echo $foto; ?>">
                    </div>
                        
                    <div class="form-group col-md-2">
                        <label for="pre">Pré-Visualização</label>
                        <img class="form-control shadow p-2 mb-2 bg-body rounded" id="imgPreview" src="fotos/<?php echo $foto ;?>" alt="Foto da NF" srcset="">
                    </div>
                </div>

			<div id="actions" class="row">
				<div class="col-md-12">
					<button type="submit" class="btn btn-secondary"><i class="fa-solid fa-sd-card"></i> Salvar</button>
					<a href="index.php" class="btn btn-light"><i class="fa-solid fa-arrow-left"></i> Cancelar</a>
				</div>
			</div>
		</form>
<?php include(FOOTER_TEMPLATE); ?>

		<script>
			function limparCaminho() {
				// Limpar o valor do input
				document.getElementById('foto').value = '';
	 
				// Exibir a foto original na pré-visualização
				document.getElementById('imgPreview').src = 'fotos/<?php echo $foto?>';
			}
			
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