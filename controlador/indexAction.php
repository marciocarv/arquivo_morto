<?php

class indexAction{
	function show(){
		$controller = new controle();
		
		$template = file_get_contents("visao/template.php");
		$paginaTemp = file_get_contents("visao/index.php");
		
		$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);
		$paginaT = str_replace("#TITULOHEADER#", 'Sistema de Arquivo Morto Mestre Pacífico', $paginaT);
		
		$caixaC = new caixaController();
		$lista = $caixaC->listar();
		
		$paginaT = str_replace("#CAIXAS#", $caixaC->listarCaixasInicio($lista), $paginaT);
		
		$paginaT = str_replace("#CSS#", "", $paginaT);
		$paginaT = str_replace("#SCRIPT#", "", $paginaT);
		
		$controller->redirecionar($paginaT);
	}
}
?>