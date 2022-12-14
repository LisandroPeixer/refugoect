<?php
	/* 
	3 recebe requisicoes das views 
	(index.php, todas_tarefas.php, nova_tarefa.php, recuperar_tarefa.php)
	pela variavel $acao
	*/

	require "tarefa.model.php";
	require "tarefa.service.php";
	require "conexao.php";


	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;
	if($acao == 'inserir' ) {
		$tarefa = new Tarefa();

//______________


		$tarefa->__set('data', $_POST['data']);//novo
		$tarefa->__set('abertura', $_POST['abertura']);//novo
		$tarefa->__set('intervalo', $_POST['intervalo']);//novo
		$tarefa->__set('fechamento', $_POST['fechamento']);//novo		
		$tarefa->__set('nome', $_POST['nome']);//novo
		$tarefa->__set('email', $_POST['email']);//novo

//______________


		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->inserir();
		header('Location: nova_tarefa.php?inclusao=1');
	
	} else if($acao == 'recuperar') {		
		$tarefa = new Tarefa();
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperar();

	} else if($acao == 'atualizar') {
		$tarefa = new Tarefa();
		$tarefa->__set('id', $_POST['id']);

//______________


		$tarefa->__set('data', $_POST['data']);//novo
		$tarefa->__set('abertura', $_POST['abertura']);//novo
		$tarefa->__set('intervalo', $_POST['intervalo']);//novo
		$tarefa->__set('fechamento', $_POST['fechamento']);//novo		
		$tarefa->__set('nome', $_POST['nome']);//novo
		$tarefa->__set('email', $_POST['email']);//novo	

//______________

		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		if($tarefaService->atualizar()) {			
			if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
				header('location: index.php');	
			} else {
				header('location: todas_tarefas.php');
			}
		}

	} else if($acao == 'remover') {
		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id']);
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->remover();

		if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('location: index.php');	
		} else {
			header('location: todas_tarefas.php');
		}
	
	} else if($acao == 'marcarRealizada') {
		$tarefa = new Tarefa();
		$tarefa->__set('id', $_GET['id'])->__set('id_status', 2);
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefaService->marcarRealizada();

		if( isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('location: index.php');	
		} else {
			header('location: todas_tarefas.php');
		}
	
	} else if($acao == 'recuperarTarefasPendentes') {
		$tarefa = new Tarefa();
		$tarefa->__set('id_status', 1);		
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperarTarefasPendentes();

	} 

?>