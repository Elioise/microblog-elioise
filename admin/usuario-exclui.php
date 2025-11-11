<?php
	require_once "../src/Database/Conecta.php";
	require_once "../src/Services/UsuarioServico.php";
	require_once "../src/Helpers/Utils.php";

	require_once "../src/Services/AutenticacaoServico.php";
	AutenticacaoServico::exigirLogin();



	//Captura o valor do id via Url e sanitiza pra garantir que é o valor inteiro
	$id = Utils::sanitizar($_GET['id'], 'inteiro');

	//Ao tentar abrir usuario-exclui.php semo parâmetro id, redirecionamos
	if(!$id) Utils::redirecionarPara('usuarios.php');

	//inicialização de variavel de erro e do objeto de serviço
$erro = null;
$usuarioServico = new UsuarioServico();
 

try {
	$usuarioServico->excluir($id);
} catch (Throwable $e) {
	//Deu ruim/erro? Dispare um erro e monte uma mensagem com os detalhes
	$erro = "Erro ao excluir usuario. <br>" . $e->getMessage();
}

require_once "../includes/cabecalho-admin.php";
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">

		<h2 class="text-center">
			Excluir usuário
		</h2>
		<?php if ($erro): ?>
            <p class="alert alert-danger text-center"><?= $erro ?></p>
						
		<?php else: ?>
			<p class="alert alert-succes text-center"> Usuario excluido com sucesso</p>
		<?php endif; ?>

		<!-- Link/Botão voltar -->
		 <p class="text-center">
			<a href="usuarios.php" class="btn btn-secondary">Voltar</a>
		 </p>


 

			

	</article>
</div>


<?php
require_once "../includes/rodape-admin.php";
?>