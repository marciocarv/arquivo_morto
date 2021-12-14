<?php

class aluno{
	private $idaluno;
	private $caixa;
	private $ano;
	private $nome;
	private $nome_mae;
	private $data_nascimento;
	private $ordem;
	
	function getIdAluno(){
		return $this->idaluno;
	}
	function setIdAluno($idaluno){
		$this->idaluno = $idaluno;
	}
	
	function getCaixa(){
		return $this->caixa;
	}
	function setCaixa($caixa){
		$this->caixa = $caixa;
	}
	
	function getAno(){
		return $this->ano;
	}
	function setAno($ano){
		$this->ano = $ano;
	}

	function getNome(){
		return $this->nome;
	}
	function setNome($nome){
		$this->nome = $nome;
	}
	
	function getNome_mae(){
		return $this->nome_mae;
	}
	function setNome_mae($nome_mae){
		$this->nome_mae = $nome_mae;
	}


	function getData_nascimento(){
		return $this->data_nascimento;
	}
	function setData_nascimento($data_nascimento){
		$this->data_nascimento = $data_nascimento;
	}


	function getOrdem(){
		return $this->ordem;
	}
	function setOrdem($ordem){
		$this->ordem = $ordem;
	}
}
?>