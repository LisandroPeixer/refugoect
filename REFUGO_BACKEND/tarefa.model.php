<?php

	// 1 - classe que gera o objeto 

	class Tarefa {
		private $id;
		private $id_status;
//______________

	private $data;//novo
	private $abertura;//novo
	private $intervalo;//novo
	private $fechamento;//novo
	private $nome;//novo
	private $email;//novo

//______________

		public function __get($atributo) {
			return $this->$atributo;
		}

		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
			return $this;
		}
	}

?>