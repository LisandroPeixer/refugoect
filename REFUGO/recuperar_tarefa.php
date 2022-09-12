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
				table, th, td {
					border: 1px solid black; 
					padding: 5px;
					margin-left: auto;
					margin-right: auto;
					text-align: center;				
				}
				#maiuscula {
					text-transform: uppercase;
				}
			</style>

<!--FORMULARIO PARA ATUALIZACAO-->
	<script>

		function editar(id, 

			txt_data, 
			txt_abertura, 
			txt_intervalo, 
			txt_fechamento, 
			txt_nome, 
			txt_email

		) {//novo

		//criar um form de edição
		let form = document.createElement('form')
		form.action = 'tarefa_controller.php?acao=atualizar'
		form.method = 'post'
		form.className = 'row'

		//criar um input para entrada do texto
		let inputData = document.createElement('input')//novo
		inputData.type = 'date'
		inputData.name = 'data'
		inputData.className = 'form-control'
		inputData.value = txt_data

		let inputAbertura = document.createElement('input')//novo
		inputAbertura.type = 'date'
		inputAbertura.name = 'abertura'
		inputAbertura.className = 'form-control'
		inputAbertura.value = txt_abertura

		let inputIntervalo = document.createElement('input')//novo
		inputIntervalo.type = 'hidden'
		inputIntervalo.name = 'intervalo'
		inputIntervalo.className = 'form-control'
		inputIntervalo.value = '00:00:00'

		let inputFechamento = document.createElement('input')//novo
		inputFechamento.type = 'hidden'
		inputFechamento.name = 'fechamento'
		inputFechamento.className = 'form-control'
		inputFechamento.value = '00:00:00'

		let inputNome = document.createElement('input')//novo
		inputNome.type = 'text'
		inputNome.name = 'nome'
		inputNome.className = 'form-control'
		inputNome.value = txt_nome

		let inputEmail = document.createElement('input')//novo
		inputEmail.type = 'text'
		inputEmail.name = 'email'
		inputEmail.className = 'form-control'
		inputEmail.value = txt_email

		//criar um input hidden para guardar o id da tarefa
		let inputId = document.createElement('input')
		inputId.type = 'hidden'
		inputId.name = 'id'
		inputId.value = id

		//criar um button para envio do form
		let button = document.createElement('button')
		button.type = 'submit'
		button.className = 'btn btn-info'
		button.innerHTML = 'Atualizar'

		//incluir inputTarefa no form
		form.appendChild(inputData)//novo
		form.appendChild(inputAbertura)//novo
		form.appendChild(inputIntervalo)//novo
		form.appendChild(inputFechamento)//novo
		form.appendChild(inputNome)//novo
		form.appendChild(inputEmail)//novo

		//______________

		
		form.appendChild(inputId)//incluir inputId no form		
		form.appendChild(button)//incluir button no form		
		//console.log(form)//teste		
		let tarefa = document.getElementById('tarefa_'+id)//selecionar a div tarefa
		tarefa.innerHTML = ''//limpar o texto da tarefa para inclusão do form
		tarefa.insertBefore(form, tarefa[0])//incluir form na página
		}

		function remover(id) {
			location.href = 'todas_tarefas.php?acao=remover&id='+id;
		}

		function marcarRealizada(id) {
			location.href = 'todas_tarefas.php?acao=marcarRealizada&id='+id;
		}
	</script>

<!--MENU-->	

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
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">VENCIDOS</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">RELATORIO</a></li>												
						<li class="list-group-item active"><a href="recuperar_tarefa.php">Pesquisa</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">CADASTRO</a></li>
						<li class="list-group-item"><a href="etiqueta.php">Gerar Etiqueta</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Pesquisa</h4>
								<hr />
<!--FORMULARIO DE PESQUISA-->

	<form method="post" action="recuperar_tarefa.php">
		<div class="form-group">
			<label>Pesquisa:</label>
			<input id="maiuscula" type="text" class="form-control" name="email" placeholder="digite o objeto completo"><!--novo-->
		</div>
		<button class="btn btn-success">Pesquisar</button>
	</form>

<!--TABELA-->
	<? if( isset($_POST['email'])) { ?>
		<table>
			<tr>										
			<th>STATUS</th>
			<th>ORDEM</th>
				
			<th>ENTRADA</th>
			<th>SAIDA</th>
			<!--th>INTERVALO</th-->
			<!--th>FIM</th-->
			<th>NOME</th>
			<th>OBJETO</th>	
			<th colspan=3></th>	
												
			</tr>

			<? foreach($tarefas as $indice => $tarefa) { ?>
				
			<? 	$teste = strtoupper(trim($_POST['email']));
			 	$sro = strtoupper($tarefa->email).strtoupper($tarefa->nome);
			 	if(strpos($sro, $teste) !== false) { ?>


				<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>">
													
					<tr>	
						<td>(<?= $tarefa->status ?>) </td>	
						<td><?= $tarefa->id ?> </td>	

						<tH><?= date("d/m/Y",strtotime($tarefa->data));?> </tH>
						<tH><?= date("d/m/Y",strtotime($tarefa->abertura)); ?> </tH>
						<!--tH><?= date("H:i",strtotime($tarefa->intervalo)); ?> </tH-->
						<!--tH><?= date("H:i",strtotime($tarefa->fechamento)); ?> </tH-->
						<td><?= $tarefa->nome ?> </td>
						<td><?= $tarefa->email ?> </td>

						<td><i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $tarefa->id ?>)"></i></td>

						
							<td><i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefa->id ?>, 

							'<?= $tarefa->data ?>',
							'<?= $tarefa->abertura ?>',
							'<?= $tarefa->intervalo ?>',
							'<?= $tarefa->fechamento ?>',
							'<?= $tarefa->nome ?>',
							'<?= $tarefa->email ?>')">

						</i></td><!--mostra valores para edicao-->

							<td><i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $tarefa->id ?>)"></i></td>
						<? } ?>
					</tr>	
				</div>
			<? } ?>	
		</table>	
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