<?php
	include("functions.php");
	if (!isset($_SESSION)) session_start();
	if (isset($_SESSION['user'])){
		if ($_SESSION['user'] != "admin") {
			$_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
			$_SESSION['type'] = "danger";
			header("Location: " .  BASEURL . "index.php");
		}
	} else {
		$_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
		$_SESSION['type'] = "danger";
		header("Location: " .  BASEURL . "index.php");
	}
	if(isset($_GET['pdf'])){
		if ($_GET['pdf']=="ok"){
			pdf();
		} else {
			pdf($_GET['pdf']);
		}
	}
	index();
	include(HEADER_TEMPLATE); 
?>

	<header style="margin-top:10px;">
		<div class="row">
			<div class="col-sm-6">
				<h2>Usuários</h2>
			</div>
			<div class="col-sm-6 text-end h2">
				<a class="btn btn-secondary" href="add.php"><i class="fa fa-plus"></i> Novo Usuário</a>
				<?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
					<a class="btn btn-danger" href="index.php?pdf=<?php echo $_POST['users']; ?>"dowload><i class="fa-solid fa-file-pdf"></i>Listagem</a>
				<?php else : ?>
				<a class="btn btn-danger" href="index.php?pdf=ok" dowload><i class="fa-solid fa-file-pdf"></i>Listagem</a>
				<?php endif; ?>
				<a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
			</div>
		</div>
	</header>


		<form name="filtro" action="index.php" method="post">
            <div class="row">
                <div class="form-group col-md-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" maxlength="80" name="users" required>
                        <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Consultar</button>
                    </div>
                </div>
            </div>
        </form>

		
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
						<th>Usuário</th>
						<th>Foto</th>
						<th>Opções</th>
					</tr>
				</thead>
				<tbody>
		<?php if ($usuarios) : ?>
			<?php foreach ($usuarios as $usuario) : ?>
					<tr>
						<td allign='center'><?php echo $usuario['id']; ?></td>
						<td><?php echo $usuario['nome']; ?></td>
						<td><?php echo $usuario['user']; ?></td>
						<td><?php 
								if(!empty($usuario['foto'])){
									echo "<img src=\"fotos/" . $usuario['foto'] . "\" class=shadow p-1 mb-1 bg-body rouded\" width=\"100px\">";
								} else {
									echo "<img src=\"fotos/semimagem.jpg\" class=shadow p-1 mb-1 bg-body rouded\" width=\"100px\">";
								}
							?>
						</td>
						<td>
							<a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-light"><i class="fa fa-eye"></i> Visualizar</a>
							<a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-pencil"></i> Editar</a>
							<a href="#" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#delete-user-modal" data-usuario="<?php echo $usuario['id']; ?>">
								<i class="fa fa-trash"></i> Excluir
							</a>
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