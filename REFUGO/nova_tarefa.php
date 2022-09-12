<!--CABECALHO-->
	<?php

	$acao = 'recuperar';
	require 'tarefa_controller.php';

	$d=strtotime("today");
	$hoje= date("Y-m-d", $d);

	$d3=strtotime("+3 Months");
	$tresMeses= date("Y-m-d", $d3);
	?>

	<html>
		<head>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>REFUGO</title>

			<link rel="stylesheet" href="css/estilo.css">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

			<style>
				#maiuscula {
					text-transform: uppercase;
				}
			</style>	
		
		</head>

<!--MENU-->	

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					REFUGO
				</a>
			</div>
		</nav>

		

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
				<ul class="list-group">
						<li class="list-group-item"><a href="index.php">VENCIDOS</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">RELATORIO</a></li>												
						<li class="list-group-item"><a href="recuperar_tarefa.php">Pesquisa</a></li>
						<li class="list-group-item active"><a href="nova_tarefa.php">CADASTRO</a></li>
						<li class="list-group-item"><a href="etiqueta.php">Gerar Etiqueta</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Novo objeto</h4>
								<hr />

<!--FORMULARIO-->								

	<form method="post" action="tarefa_controller.php?acao=inserir">
		<div class="form-group">
			<label>Cadastro:</label>

			<input value='<?= $hoje ?>' type="hidden" class="form-control" name="data" placeholder="data"><!--novo-->
			<input value='<?= $tresMeses ?>' type="hidden" class="form-control" name="abertura" placeholder="abertura"><!--novo-->
			<input value='00:00:00'type="hidden" class="form-control" name="intervalo" placeholder="intervalo"><!--novo-->
			<input value='00:00:00'type="hidden" class="form-control" name="fechamento" placeholder="fechamento"><!--novo-->
			<input id="maiuscula" type="text" class="form-control" name="nome" placeholder="nome"><!--novo-->
			<input id="maiuscula" type="text" class="form-control" name="email" placeholder="objeto"><!--novo-->	
			
		</div>


		<button class="btn btn-success" onclick="impressao(<?= $tarefa->id ?>)">Cadastrar</button>
	</form>


	<? if( isset($_GET['inclusao']) && $_GET['inclusao'] == 1 ) { ?>
		<div class="bg-success pt-2 text-white d-flex justify-content-center">
			<h5>Objeto inserido com sucesso!</h5>
		</div>

	<? } ?>
<!--RODAPE-->		

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>