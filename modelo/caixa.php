<?php

class caixa{
	private $idcaixa;
	private $descricao;
	private $ordem;
		
	function getIdCaixa(){
		return $this->idcaixa;
	}
	function setIdCaixa($idcaixa){
		$this->idcaixa = $idcaixa;
	}
	
	function getDescricao(){
		return $this->descricao;
	}
	function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	
	function getOrdem(){
		return $this->ordem;
	}
	function setOrdem($ordem){
		$this->ordem = $ordem;
	}
}
?>