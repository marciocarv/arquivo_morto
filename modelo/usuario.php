<?php

class usuario{
	private $id_usuario;
	private $nome;
	private $email;
	private $assinatura;
	private $login;
	private $senha;
	
	function getId_usuario(){
		return $this->id_usuario;
	}
	function setId_usuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}


	function getNome(){
		return $this->nome;
	}
	function setNome($nome){
		$this->nome = $nome;
	}


	function getEmail(){
		return $this->email;
	}
	function setEmail($email){
		$this->email = $email;
	}


	function getAssinatura(){
		return $this->assinatura;
	}
	function setAssinatura($assinatura){
		$this->assinatura = $assinatura;
	}


	function getLogin(){
		return $this->login;
	}
	function setLogin($login){
		$this->login = $login;
	}


	function getSenha(){
		return $this->senha;
	}
	function setSenha($senha){
		$this->senha = $senha;
	}

}
?>