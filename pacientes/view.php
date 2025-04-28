<?php
	include("functions.php");
	if (!isset($_SESSION)) session_start();
	view($_GET['id']);
	include(HEADER_TEMPLATE); 
?>
		<?php if (!empty($_SESSION['message'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
				<?php echo $_SESSION['message']; ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php else: ?>
			<header>
				<h2>Paciente <?php echo $paciente['id']; ?></h2>
			</header>
			<hr>
			
			<dl class="dl-horizontal">
				<dt>Nome:</dt>
				<dd><?php echo $paciente['nome']; ?></dd>
				
				<dt>Diagnóstico: </dt>
				<dd><?php echo $paciente['diagnostico']; ?></dd>

				<dt>Data de Nascimento: </dt>
				<dd><?php echo formatadata($paciente['datanascimento'], "d-m-Y"); ?></dd>

				<dt>Data de Entrada: </dt>
				<dd><?php echo formatadata($paciente['dataentrada'], "d-m-Y"); ?></dd>
				
				<dt>Foto:</dt>
				<dd><?php
					if(!empty($paciente['foto'])) {
						echo "<img src=\"fotos/" . $paciente['foto'] . "\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
					} else{
						echo "<img src=\"fotos/semimagem.jpg\" class=\"shadow p-1 mb-1 bg-body rounded\" width=\"300px\">";
					}
					?>
				</dd>
			</dl>
		<?php endif; ?>
		
			<div id="actions" class="row">
				<div class="col-md-12">
					<?php if (isset($_SESSION['user'])) : ?>
						<a href="edit.php?id=<?php echo $paciente['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
						<?php else : ?>
					<a href="" class="btn btn btn-secondary disabled"><i class="fa fa-pencil"></i> Editar</a>
						<?php endif; ?>
					<a href="index.php" class="btn btn-light"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
				</div>
			</div>
		<?php clear_messages();?>
		
<?php include(FOOTER_TEMPLATE); ?>