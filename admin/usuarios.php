<?php
require_once "../src/Database/Conecta.php";
require_once "../src/Services/UsuarioServico.php";
require_once "../src/Helpers/Utils.php";

require_once "../src/Services/AutenticacaoServico.php";
AutenticacaoServico::exigirLogin();


//Inicialisação
$erro = null;
$usuarios = [];
$usuarioServico = new UsuarioServico();




try {
	$usuarios = $usuarioServico->buscar();

	// Utils::dump($usuarios);

} catch (Throwable $e) {

	$erro = "Erro ao buscar usuarios.  <br>" . $e->getMessage();
}




require_once "../includes/cabecalho-admin.php";

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">Usuários <span class="badge bg-dark"><?= count($usuarios) ?></span></h2>
		<!-- pra contar  -->

		<?php if ($erro): ?>
			<p class="alert alert-danger text-center"> <?= $erro ?> </p>
		<?php endif; ?>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="usuario-insere.php">
				<i class="bi bi-plus-circle"></i>
				Inserir novo usuário</a>
		</p>

		<div class="table-responsive">

			<table class="table table-hover">
				<thead class="table-light">
					<tr>
						<th>Nome</th>
						<th>E-mail</th>
						<th>Tipo</th>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>

					<?php
					foreach ($usuarios as $usuario):



					?>
						<tr>
							<td> <?= $usuario['nome'] ?> </td>
							<td> <?= $usuario['email'] ?> </td>
							<td> <?= $usuario['tipo'] ?> </td>
							<td class="text-center">
								<a class="btn btn-warning"
									href="usuario-atualiza.php?id=<?= $usuario['id'] ?>">
									<i class="bi bi-pencil"></i> Atualizar
								</a>

								<a class="btn btn-danger excluir"
									href="usuario-exclui.php?id=<?= $usuario['id'] ?>">
									<i class="bi bi-trash"></i> Excluir
									<!-- pra aparecer o id -->
								</a>
							</td>
						</tr>

					<?php

					endforeach
					?>

				</tbody>
			</table>
		</div>

	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar fornecedor</title>
	<link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
	<h1>Editar fornecedor</h1>

	<form action="" method="post">
		<!-- Sempre coloque o código/id do registro de forma oculta
        no formulário. -->
		<input type="hidden" name="id" value="<?= $fornecedor['id'] ?>">

		<div>
			<label for="nome">Nome:</label>
			<input value="<?= $fornecedor['nome'] ?>" type="text" name="nome" id="nome" required>
		</div>
		<button type="submit">Atualizar</button>
	</form>

	<a href="listar.php">← Voltar</a>

</body>

</html>