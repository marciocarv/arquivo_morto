<?php
class paginacaoE{

private $pagina;
	private $inicio;
	private $tamanhoPagina = 0;
	private $totalRegistros;
	private $total_paginas;
	private $url;
	private $barra;


	function paginar($obj){

		$this->totalRegistros = sizeof($obj);
		
		if($this->tamanhoPagina == 0){
			if($this->totalRegistros == 0){
				$this->tamanhoPagina = 1;
			}else{
				$this->tamanhoPagina = $this->totalRegistros;
			}
		}
		
		$this->total_paginas = ceil($this->totalRegistros/$this->tamanhoPagina);		
		
		$array = array();

		$inicial = $this->inicio;		
		$final = $this->tamanhoPagina + $inicial;
		
		$cont = ($final >= $this->totalRegistros) == true ? $this->totalRegistros : $final;
		
		if($this->totalRegistros > 0){

			for($i=$inicial;$i<$cont;$i++){
				if($obj[$i]){
					$array[] = $obj[$i];
				}			
			}
		}
		return $array;
	}

	function setTamanhoPagina($tamanhoPagina){
		$this->tamanhoPagina = $tamanhoPagina;

		$this->setPagina();
		$this->setUrl();
	}

	function setPagina(){
		if(!isset($_GET['pagina'])){
			$this->pagina = 1;
			$this->inicio = 0;			
		}else{
			$this->pagina = $_GET['pagina'];
			$calculo = ($_GET['pagina'] - 1) * $this->tamanhoPagina;
			if($calculo >= 0){
				$this->inicio = $calculo;
			}else{
				$this->pagina = 1;
				$this->inicio = 0;
			}			
		}
	}

	function setUrl(){
		if(!isset($this->url)){
			$self = explode("/",$_SERVER['PHP_SELF']);	
			if(isset($_GET['pagina'])){
				$url_temp = $self[sizeof($self)-1]."?".$_SERVER['QUERY_STRING'];
				$url_temp = explode("&pagina", $url_temp);
				$this->url = $url_temp[0];
			}else{
				$this->url = $self[sizeof($self)-1]."?".$_SERVER['QUERY_STRING'];
			}			
		}
	}

	function anterior(){
		if($this->pagina==1){
			$this->barra .=  "<li class=\"prev disabled\"><a>&larr; Primeira</a></li><li class=\"prev disabled\"><a>&laquo; Anterior</a></li>";
		}else{
			$this->barra .= "<li class=\"prev\"><a href=\"".$this->url."&pagina=1\" title=\"Primeira P&aacute;gina\">&larr; Primeira</a></li><li class=\"prev\"><a href=\"".$this->url."&pagina=".($this->pagina-1)."\">&laquo; Anterior</a></li>";
		}		
	}

	function proximo(){
		if($this->pagina==$this->total_paginas){
			$this->barra .= "<li class=\"next disabled\"><a >Pr&oacute;xima &raquo;</a></li><li class=\"next disabled\"><a >&Uacute;ltima &rarr;</a></li>";
		}else
		if($this->total_paginas==0){
			$this->barra .= "<li class=\"next disabled\"><a >Pr&oacute;xima &raquo;</a></li><li class=\"next disabled\"><a >&Uacute;ltima &rarr;</a></li>";
		}else{
			$this->barra .= "<li class=\"next\"><a href=\"".$this->url."&pagina=".($this->pagina+1)."\" title=\"Pr&oacute;xima P&aacute;gina\">Pr&oacute;xima &raquo;</a></li><li class=\"next\"><a href=\"".$this->url."&pagina=".$this->total_paginas."\" title=\"&Uacute;ltima P&aacute;gina\">&Uacute;ltima &rarr;</a></li>";
		}
	}

	function barra(){
			$this->barra .= "<nav><ul class=\"pagination\">";
			$this->anterior();
			$this->proximo();
			$this->barra .= "</ul></nav>";

			return $this->barra;
	}

}
?>