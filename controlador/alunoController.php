<?php

class alunoController extends Controle{

	function inserir($aluno){
		$daoAluno = new daoAluno();
		if($daoAluno->confereAluno($aluno)==false){
			if($daoAluno->inserir($aluno)==true){
				return "sucesso";
			}else{
				return "erro";
			}
		}else{
			return "cadastrado";
		}
	}

	
	function alterar($aluno){
		$daoAluno = new daoAluno();
		
		return $daoAluno->alterar($aluno);		
	}

	function excluir($aluno){
		$daoAluno = new daoAluno();

		if($daoAluno->excluir($aluno)==true){
			return "excluido";
		}else{
			return "erro";
		}
	}
	
	function subir($aluno){
		$daoAluno = new daoAluno();
	
		if($daoAluno->subir($aluno)==true){
			return "sucesso";
		}else{
			return "erro";
		}
	}
	
	function descer($aluno){
		$daoAluno = new daoAluno();
	
		if($daoAluno->descer($aluno)==true){
			return "sucesso";
		}else{
			return "erro";
		}
	}

	function listar($idcaixa){
		$daoAluno = new daoAluno();
		
		$lista = $daoAluno->listarPorCaixa($idcaixa);

		return $lista;
	}
	
	function listarImpressao($idcaixa){
		$daoAluno = new daoAluno();
	
		$lista = $daoAluno->listarPorCaixaCres($idcaixa);
	
		return $lista;
	}

	function listaPorId($id){
		$daoAluno = new daoAluno();

		$aluno = $daoAluno->listaPorId($id);

		return $aluno;
	}
	
	function pesquisar($obj, $campo){
		
		$daoAluno = new daoAluno();
		
		if($campo == "ano"){
			$lista = $daoAluno->pesquisarPorAno($obj);
		}else
			if($campo == "nascimento"){
				$lista = $daoAluno->pesquisarPorNascimento($obj);
		}else if ($campo == "nome"){
				$lista = $daoAluno->pesquisarPorNome($obj);
		}
		
		return $lista;
	}

	function combo($id=null){
		$daoAluno = new daoAluno();

		$lista = $daoAluno->listar();

		$combo = "<select name=\"aluno\" id=\"aluno\" data-form=\"select2\" style=\"width:350px\" data-placeholder=\"Escolha uma op&ccedil;&atilde;o\" >\n";

		$combo .= "<option value=\"\"></option>\n";

		for($i=0;$i<=sizeof($lista)-1;$i++){
			$p = $lista[$i];
			if($p->getIdAluno()==$id){
				$combo .= "<option value=\"".$p->getIdAluno()."\" selected=\"selected\">".$p->getNome()."</option>\n";
			}else{
				$combo .= "<option value=\"".$p->getIdAluno()."\">".$p->getNome()."</option>\n";
			}
		}
		$combo .= "</select>\n";

		return $combo;
	}
	
	function popularTable($lista){
	$util = new util();
		$corpo = "";
		foreach($lista as $obj){
							
			$corpo .= "<tr>";
			$corpo .= "<td>".$obj->getOrdem()."</td>";
			$corpo .= "<td>".$obj->getNome()."</td>";
			$corpo .= "<td>".$obj->getCaixa()->getDescricao()."</td>";
			$corpo .= "<td>".$obj->getAno()->getDescricao()."</td>";
			$corpo .= "<td>".$obj->getNome_mae()."</td>";
			$corpo .= "<td>".$util->converteData($obj->getData_nascimento())."</td>";
			$corpo .= "<td><a href=?acao=alunoAction&pg=Transferir&id=".$obj->getIdAluno()."&idcaixa=".$obj->getCaixa()->getIdCaixa()." class=\"btn btn-default\" title=\"Transferir\"><i class=\"glyphicon glyphicon-transfer\"></i></a></td>";
			$corpo .= "<td><a href=?acao=alunoAction&pg=Alterar&id=".$obj->getIdAluno()."&idcaixa=".$obj->getCaixa()->getIdCaixa()." class=\"btn btn-default\" title=\"Editar\"><i class=\"fa fa-edit\"></i></a></td>";
			$corpo .= "<td><a href=?acao=alunoAction&pg=Excluir&id=".$obj->getIdAluno()."&idcaixa=".$obj->getCaixa()->getIdCaixa()." onclick=\"if(!confirm('Deseja realmente excluir ??')) return false;\" class=\"btn btn-default\" title=\"Excluir\"><i class=\"fa fa-trash-o\"></i></a></td>";
			$corpo .= "<td><a href=?acao=alunoAction&pg=Subir&id=".$obj->getIdAluno()."&idcaixa=".$obj->getCaixa()->getIdCaixa()." class=\"btn btn-default\" title=\"Subir\"><i class=\"fa fa-upload\"></i></a></td>";
			$corpo .= "<td><a href=?acao=alunoAction&pg=Descer&id=".$obj->getIdAluno()."&idcaixa=".$obj->getCaixa()->getIdCaixa()." class=\"btn btn-default\" title=\"Descer\"><i class=\"fa fa-download\"></i></a></td>";
			$corpo .= "</tr>";
		}

		return $corpo;
	}
	
	function popularTablePesquisa($lista){
		$util = new util();
		$corpo = "";
		foreach($lista as $obj){
			$corpo .= "<tr>";
			$corpo .= "<td><strong>".$obj->getCaixa()->getDescricao()."</strong></td>";
			$corpo .= "<td><strong>".$obj->getOrdem()."</strong></td>";
			$corpo .= "<td><strong>".$obj->getNome()."</strong></td>";
			$corpo .= "<td><strong>".$obj->getAno()->getDescricao()."</strong></td>";
			$corpo .= "<td><strong>".$obj->getNome_mae()."</strong></td>";
			$corpo .= "<td><strong>".$util->converteData($obj->getData_nascimento())."</strong></td>";
			$corpo .= "</tr>";
		}
	
		return $corpo;
	}
	
	function retornaAno($lista){
		if(!empty($lista[0])){
			$total = count($lista)-1;
			if($lista[0]->getAno()->getDescricao() == $lista[$total]->getAno()->getDescricao()){
				return($lista[0]->getAno()->getDescricao());
			}else{
				return "{$lista[0]->getAno()->getDescricao()} - {$lista[$total]->getAno()->getDescricao()}";
			}
		}else{
			return "nenhum resultado";
		}
	}
	
	function popularTableImpressao($lista){
		$util = new util();
		$corpo = "";
		if(!empty($lista[0])){
			foreach($lista as $obj){
					
				$corpo .= "<tr>";
				$corpo .= "<td>".$obj->getOrdem()."</td>";
				$corpo .= "<td>".$obj->getNome()."</td>";
				$corpo .= "<td>".$util->converteData($obj->getData_nascimento())."</td>";
				$corpo .= "<td>".$obj->getCaixa()->getDescricao()."</td>";
				$corpo .= "<td>".$obj->getAno()->getDescricao()."</td>";
				
				$corpo .= "</tr>";
			}
		}else{
			$corpo ="";
		}
		return $corpo;
	}
		
	function conferirLista($obj, $lista){
		$retorno = 0;
		foreach($lista as $pagina){
			if($obj->getId_pagina() == $pagina->getId_pagina()){
				return 1;
			}
		}
		return $retorno;
	}
	
}
?>