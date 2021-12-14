<?php

class anoController extends Controle{

	function inserir($ano){
		$daoAno = new daoAno();
		if($daoAno->confereAno($ano)==false){
			if($daoAno->inserir($ano)==true){
				return "sucesso";
			}else{
				return "erro";
			}
		}else{
			return "cadastrado";
		}
	}

	
	function alterar($ano){
		$daoAno = new daoAno();
		
		return $daoAno->alterar($ano);		
	}

	function excluir($ano){
		$daoAno = new daoAno();

		if($daoAno->excluir($ano)==true){
			return "excluido";
		}else{
			return "erro";
		}
	}

	function listar(){
		$daoAno = new daoAno();
		
		$lista = $daoAno->listar();

		return $lista;
	}

	function listaPorId($id){
		$daoAno = new daoAno();

		$ano = $daoAno->listaPorId($id);

		return $ano;
	}

	function combo($id=null){
		$daoAno = new daoAno();

		$lista = $daoAno->listar();

		$combo = "<select name=\"ano\" id=\"ano\" data-form=\"select2\" style=\"width:100%\" data-placeholder=\"Escolha uma op&ccedil;&atilde;o\" >\n";

		$combo .= "<option value=\"\"></option>\n";

		for($i=0;$i<=sizeof($lista)-1;$i++){
			$p = $lista[$i];
			if($p->getIdAno()==$id){
				$combo .= "<option value=\"".$p->getIdAno()."\" selected=\"selected\">".$p->getDescricao()."</option>\n";
			}else{
				$combo .= "<option value=\"".$p->getIdAno()."\">".$p->getDescricao()."</option>\n";
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
			$corpo .= "<td><a href=?acao=anoAction&pg=Alterar&id=".$obj->getIdAno()." class=\"btn btn-default\" title=\"Editar\"><i class=\"fa fa-edit\"></i></a></td>";
			$corpo .= "<td><a href=?acao=anoAction&pg=Excluir&id=".$obj->getIdAno()." onclick=\"if(!confirm('Deseja realmente excluir ??')) return false;\" class=\"btn btn-default\" title=\"Excluir\"><i class=\"fa fa-trash-o\"></i></a></td>";
			$corpo .= "</tr>";
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