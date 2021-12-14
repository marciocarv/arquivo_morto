<?php

class ano{
	private $idano;
	private $descricao;
		
	function getIdAno(){
		return $this->idano;
	}
	function setIdAno($idano){
		$this->idano = $idano;
	}
	
	function getDescricao(){
		return $this->descricao;
	}
	function setDescricao($descricao){
		$this->descricao = $descricao;
	}
}
?>