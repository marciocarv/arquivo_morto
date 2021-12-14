<?php

class listaImpressaoAction{
	function show(){
		if(filter_input(INPUT_GET, 'idcaixa')){
			$controller = new controle();
			
			$paginaT = file_get_contents("visao/listaImpressao.php");
			
			$paginaT = str_replace("#TITULOHEADER#", 'IMPRESSAO CAIXA', $paginaT);
			
			$alunoC = new alunoController();
			$caixaC = new caixaController();
			
			$caixa = $caixaC->listaPorId(filter_input(INPUT_GET, 'idcaixa'));
			
			$listaAluno = $alunoC->listarImpressao(filter_input(INPUT_GET, 'idcaixa'));
			
			$paginaT = str_replace("#ANO#", $alunoC->retornaAno($listaAluno), $paginaT);
			
			$paginaT = str_replace("#TABELA#", $alunoC->popularTableImpressao($listaAluno), $paginaT);
			
			$paginaT = str_replace("#TITULO#", "CAIXA - {$caixa->getDescricao()}", $paginaT);
			
			$paginaT = str_replace("#CSS#", "", $paginaT);
			$paginaT = str_replace("#SCRIPT#", "", $paginaT);
			
			$controller->redirecionar($paginaT);
		}
	}
}
?>