<!--CABECALHO-->
	<?php
		$acao = 'recuperar';
		require 'tarefa_controller.php';
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
				html, body {margin: 0px; padding: 0px;} 
				table, th, td {margin: 10px 0px 0px 30px; padding: 0px; font-size:20px; width:300px; border: 1px solid black; border-collapse: collapse; text-align:center;}
				#sequencia{font-size:60px;} 
				div {page-break-after:avoid;} 
				div:last-child {page-break-after:avoid;} 
				#maiuscula {
					text-transform: uppercase;
				}
				@media print {
					body * {
						visibility: hidden;
						height: 10px;
						margin: 30px 50px;
					}
					#printable, #printable * {
						visibility: visible;						
					}
					#printable {
						position: fixed;
						left: 0;
						top: 0;
					}
				}
			</style>
		</head>

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
<!--MENU-->	
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">VENCIDOS</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">RELATORIO</a></li>												
						<li class="list-group-item"><a href="recuperar_tarefa.php">Pesquisa</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">CADASTRO</a></li>
						<li class="list-group-item active"><a href="etiqueta.php">Gerar Etiqueta</a></li>
					</ul>
				</div><!--col-md-3 menu-->
				
<!--FORMULARIO DE PESQUISA-->

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Pesquisa</h4>

								<form method="post" action="etiqueta.php">
									<div class="form-group">
										<input id="maiuscula" type="text" class="form-control" name="email" placeholder="digite o objeto completo"><!--novo-->
									</div>
									<button class="btn btn-success">Pesquisar</button>
								</form>
					</div><!--container pagina-->
				</div><!--col-sm-9-->

<!--TABELA-->

			<? if( isset($_POST['email'])) { ?><!--se estiver setado entra-->
				<? foreach($tarefas as $indice => $tarefa) { ?><!--capture todos da tabela-->											
					<? if($tarefa->email == $_POST['email']) { ?><!--imprima somente o selecionado-->
					
						<div class="container pagina" id="tarefa_<?= $tarefa->id ?>">

							<div class="row">

								<table id="printable">    
									<tr>    
										<th>REFUGO</th>    
										<td><?= $tarefa->email ?></td>  
									</tr>  <tr><td colspan=2><?= $tarefa->nome ?></td>
									</tr><tr><th colspan=2 id=sequencia><?= $tarefa->id ?></th>  </tr>   
									<tr>    <td>ENTRADA</td>    <td><?= date("d/m/Y",strtotime($tarefa->data));?></td>  </tr> 
									<tr>    <td>SAIDA</td>    <th><?= date("d/m/Y",strtotime($tarefa->abertura)); ?></th>  
									</tr>
								</table>
								
							</div><!--row-->

						</div><!--col-sm-9-->

					<? } ?><!--imprima somente o selecionado-->
				<? } ?><!--capture todos da tabela-->	
			<? } ?><!--se estiver setado entra-->		
				<!--RODAPE-->
		</div><!--col-->
	</div><!--row-->


			</div><!--row-->
		</div><!--container app-->
	</body>
</html>