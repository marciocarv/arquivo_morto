<?php

	/**
	* funчуo que carrega todas as classes necessсrias, nуo necessitando
	* dar include nas classes.
	*/
	function __autoload($classe) {
		//colaca nesse array todas as pastas que contem classes que serуo usadas.
		$pasta = array("controlador", "banco", "dao", "libs", "modelo"); 

		for($i=0; $i<=count($pasta)-1; $i++){
			if(file_exists($pasta[$i]."/".$classe.".php")){
				require_once($pasta[$i]."/".$classe.'.php');
			}
		}

	}

//error_reporting(0);

	$controle = new controle(); 
		
	$controle->mostrar("?acao=indexAction");
	
?>