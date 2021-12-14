<?php

class caixaController extends Controle{

	function inserir($caixa){
		$daoCaixa = new daoCaixa();
		if($daoCaixa->confereCaixa($caixa)==false){
			if($daoCaixa->inserir($caixa)==true){
				return "sucesso";
			}else{
				return "erro";
			}
		}else{
			return "cadastrado";
		}
	}

	
	function alterar($caixa){
		$daoCaixa = new daoCaixa();
		
		return $daoCaixa->alterar($caixa);		
	}

	function excluir($caixa){
		$daoCaixa = new daoCaixa();

		if($daoCaixa->excluir($caixa)==true){
			return "excluido";
		}else{
			return "erro";
		}
	}

	function listar(){
		$daoCaixa = new daoCaixa();
		
		$lista = $daoCaixa->listar();

		return $lista;
	}

	function listaPorId($id){
		$daoCaixa = new daoCaixa();

		$caixa = $daoCaixa->listaPorId($id);

		return $caixa;
	}

	function combo($id=null){
		$daoCaixa = new daoCaixa();

		$lista = $daoCaixa->listar();

		$combo = "<select name=\"caixa\" id=\"caixa\" data-form=\"select2\" style=\"width:350px\" data-placeholder=\"Escolha uma op&ccedil;&atilde;o\" >\n";

		$combo .= "<option value=\"\"></option>\n";

		for($i=0;$i<=sizeof($lista)-1;$i++){
			$p = $lista[$i];
			if($p->getIdCaixa()==$id){
				$combo .= "<option value=\"".$p->getIdCaixa()."\" selected=\"selected\">".$p->getDescricao()."</option>\n";
			}else{
				$combo .= "<option value=\"".$p->getIdCaixa()."\">".$p->getDescricao()."</option>\n";
			}
		}
		$combo .= "</select>\n";

		return $combo;
	}
	
	function popularTable($lista){ 

		$corpo = "";
		foreach($lista as $obj){
							
			$corpo .= "<tr>";
			$corpo .= "<td>".$obj->getDescricao()."</td>";
			$corpo .= "<td><a href=?acao=caixaAction&pg=Alterar&id=".$obj->getIdCaixa()." class=\"btn btn-default\" title=\"Editar\"><i class=\"fa fa-edit\"></i></a></td>";
			$corpo .= "<td><a href=?acao=caixaAction&pg=Excluir&id=".$obj->getIdCaixa()." onclick=\"if(!confirm('Deseja realmente excluir ??')) return false;\" class=\"btn btn-default\" title=\"Excluir\"><i class=\"fa fa-trash-o\"></i></a></td>";
			$corpo .= "</tr>";
		}

		return $corpo;
	}
	
	function listarCaixasInicio($lista){
		$corpo = "";
		$i = 1;
		if(!empty($lista[0])){
			foreach($lista as $obj){
				if($i%2==0){
					$panel = "panel panel-primary";
				}else{
					$panel = "panel panel-red";
				}
				
				$i++;
				
				$corpo .= "<div class=\"col-lg-2 col-md-4\">";
				$corpo .= "<div class=\"$panel\">";
				$corpo .= "<div class=\"panel-heading\">";
				$corpo .= "<div class=\"row\">";
				$corpo .= "<div class=\"col-xs-3\">";
				$corpo .= "<i class=\"fa fa-folder fa-5x\"></i>";
				$corpo .= "</div>";
				$corpo .= "<div class=\"col-xs-9 text-right\">";
				$corpo .= "<div class=\"huge\">".$obj->getDescricao()."</div>";
				$corpo .= "<div>CAIXA</div>";
				$corpo .= "</div>";
				$corpo .= "</div>";
				$corpo .= "</div>";
				$corpo .= "<a href=\"?acao=alunoAction&pg=Cadastrar&idcaixa=".$obj->getIdCaixa()."\">";
				$corpo .= "<div class=\"panel-footer\">";
				$corpo .= "<span class=\"pull-left\">Adicionar Alunos</span>";
				$corpo .= "<span class=\"pull-right\"><i class=\"fa fa-plus-square\"></i></span>";
				$corpo .= "<div class=\"clearfix\"></div>";
				$corpo .= "</div>";
				$corpo .= "</a>";
				$corpo .= "<a target='_blank' href=\"?acao=listaImpressaoAction&pg=Listar&idcaixa=".$obj->getIdCaixa()."\">";
				$corpo .= "<div class=\"panel-footer\">";
				$corpo .= "<span class=\"pull-left\">Listar Alunos</span>";
				$corpo .= "<span class=\"pull-right\"><i class=\"fa fa-th-list\"></i></span>";
				$corpo .= "<div class=\"clearfix\"></div>";
				$corpo .= "</div>";
				$corpo .= "</a>";
				$corpo .= "</div>";
				$corpo .= "</div>";			
			}
		}else{
			$corpo = "Nenhum resultado encontrado!";
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