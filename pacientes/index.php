<?php
	include("functions.php");
	if (!isset($_SESSION)) session_start();
	index();
	include(HEADER_TEMPLATE); 
?>

	<header style="margin-top:10px;">
		<div class="row">
			<div class="col-sm-6">
				<h2>Pacientes</h2>
			</div>
			<div class="col-sm-6 text-end h2">
				<?php if (isset($_SESSION['user'])) : ?>
				<a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-hospital-user"></i> Novo Paciente</a>
				<?php else : ?>
						<a class="btn btn-light disabled" href="#"><i class="fa-solid fa-hospital-user"></i> Novo Paciente</a>
				<?php endif ?>
				<a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
			</div>
		</div>
	</header>
	
		
		<?php if (!empty($_SESSION['message'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
				<?php echo $_SESSION['message']; ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		<?php clear_messages(); ?>
		<?php endif; ?>
			<table class="table table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Diagnóstico</th>
						<th>DataNascimento</th>
						<th>DataEntrada</th>
						<th>Foto NF</th>
						<th>Opções</th>
					</tr>
				</thead>
				<tbody>
		<?php if ($pacientes) : ?>
			<?php foreach ($pacientes as $paciente) : ?>
					<tr>
						<td allign='center'><?php echo $paciente['id']; ?></td>
						<td><?php echo $paciente['nome']; ?></td>
						<td><?php echo $paciente['diagnostico']; ?></td>
						<td><?php echo formatadata($paciente['datanascimento'], "d/m/Y"); ?></td>
						<td><?php echo formatadata($paciente['dataentrada'], "d/m/Y"); ?></td>
						<td><?php 
								if(!empty($paciente['foto'])){
									echo "<img src=\"fotos/" . $paciente['foto'] . "\" class=shadow p-1 mb-1 bg-body rouded\" width=\"100px\">";
								} else {
									echo "<img src=\"fotos/semimagem.jpg\" class=shadow p-1 mb-1 bg-body rouded\" width=\"100px\">";
								}
							?>
						</td>
						<td>
							<a href="view.php?id=<?php echo $paciente['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
							<?php if (isset($_SESSION['user'])) : ?>
							<a href="edit.php?id=<?php echo $paciente['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>
							<a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-user-modal" data-usuario="<?php echo $paciente['id']; ?>">
								<i class="fa fa-trash"></i> Excluir
							</a>
							<?php else : ?>
								<a href="" class="btn btn-sm btn-secondary disabled"><i class="fa fa-pencil"></i> Editar</a>
								<a href="#" class="btn btn-sm btn-dark disabled" data-bs-toggle="modal" data-bs-target="#delete-user-modal" data-customer="<?php echo $customer['id']; ?>">
									<i class="fa fa-trash"></i> Excluir
								</a>
							<?php endif ?>
						</td>
					</tr>
			<?php endforeach; ?>
		<?php else : ?>
					<tr>
						<td colspan="6">Nenhum registro encontrado.</td>
					</tr>
		<?php endif; ?>
				</tbody>
			</table>
<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>