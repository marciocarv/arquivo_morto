<?php
class util{

	private $data;

	function getData(){
		return $this->data;
	}

	/**
	* String converteData($data)
	*
	* M�todo que recebe uma data, confere o formato da mesma. 
	* Se tiver com (/) ele formata para inserir no banco, 
	* se for o contrario ela formata com as barras e retorna a data para aplica��o.
	*
	* Parametros
	*  String data
	* Retorno
	*  retorna a data formatada.
	*/

	function converteData($data){
		if($data){
			if(strstr($data,'-')){
				$data = explode("-",$data);
				$data = $data[2]."/".$data[1]."/".$data[0];
			}else{
				$data = explode("/",$data);
				$data = $data[2]."-".$data[1]."-".$data[0];
			}

			return $data;
		}else{
			return "";
		}
	}	

	function converteDataHora($data){
		if(!strstr($data,'0000')){
			if(strstr($data,'-')){
				$data = explode(" ",$data);
				$hora = explode(":",$data[1]);
				$data = $data[0];
				
				$data = explode("-",$data);

				$hora = $hora[0].":".$hora[1];
				$data = $data[2]."/".$data[1]."/".$data[0];
				$this->data = $data;
				$data = $data." ".$hora;
			}else{
				$data = explode("/",$data);
				$data = $data[2]."-".$data[1]."-".$data[0];
			}
		}else{
			$data = "-";
		}
		return $data;  
	}

	function converteCPF($cpf){
		if(strstr($cpf,'.')){
			$cpf = explode("-",$cpf);
			$cpf = $cpf[0].$cpf[1];
			$cpf = explode(".",$cpf);
			$cpf = $cpf[0].$cpf[1].$cpf[2];
		}else{
			$vet[0] = substr($cpf,0,3);
			$vet[1] = substr($cpf,3,3);
			$vet[2] = substr($cpf,6,3);
			$vet[3] = substr($cpf,9,2);
			$cpf = $vet[0].".".$vet[1].".".$vet[2]."-".$vet[3];
		}

		return $cpf;
	}

	function formataNumero($valor){
		if(strstr($valor, ',')){

			$valor = str_replace(".","",$valor);
			$valor = str_replace(",",".",$valor);

			return $valor;
		}else{
			return number_format($valor,2,",",".");
		}
	}

	function getMes($i){
		$mes = null;
		if($i==1){
			$mes = "JANEIRO";
		}else
		if($i==2){
			$mes = "FEVEREIRO";
		}else
		if($i==3){
			$mes = "MAR�O";
		}else
		if($i==4){
			$mes = "ABRIL";
		}else
		if($i==5){
			$mes = "MAIO";
		}else
		if($i==6){
			$mes = "JUNHO";
		}else
		if($i==7){
			$mes = "JULHO";
		}else
		if($i==8){
			$mes = "AGOSTO";
		}else
		if($i==9){
			$mes = "SETEMBRO";
		}else
		if($i==10){
			$mes = "OUTUBRO";
		}else
		if($i==11){
			$mes = "NOVEMBRO";
		}else
		if($i==12){
			$mes = "DEZEMBRO";
		}
		return $mes;
	}

	function converteEntidadeHtml($texto){

		$texto = str_replace ("�", "&aacute;", $texto); 
		$texto = str_replace ("�", "&eacute;", $texto); 
		$texto = str_replace ("�", "&iacute;", $texto); 
		$texto = str_replace ("�", "&oacute;", $texto); 
		$texto = str_replace ("�", "&uacute;", $texto); 
		$texto = str_replace ("�", "&Aacute;", $texto); 
		$texto = str_replace ("�", "&Eacute;", $texto); 
		$texto = str_replace ("�", "&Iacute;", $texto); 
		$texto = str_replace ("�", "&Oacute;", $texto); 
		$texto = str_replace ("�", "&Uacute;", $texto); 
		$texto = str_replace ("�", "&agrave;", $texto); 
		$texto = str_replace ("�", "&egrave;", $texto); 
		$texto = str_replace ("�", "&igrave;", $texto); 
		$texto = str_replace ("�", "&ograve;", $texto); 
		$texto = str_replace ("�", "&ugrave;", $texto); 
		$texto = str_replace ("�", "&Agrave;", $texto); 
		$texto = str_replace ("�", "&Egrave;", $texto); 
		$texto = str_replace ("�", "&Igrave;", $texto); 
		$texto = str_replace ("�", "&Ograve;", $texto); 
		$texto = str_replace ("�", "&Ugrave;", $texto); 
		$texto = str_replace ("�", "&auml;", $texto); 
		$texto = str_replace ("�", "&euml;", $texto); 
		$texto = str_replace ("�", "&iuml;", $texto); 
		$texto = str_replace ("�", "&ouml;", $texto); 
		$texto = str_replace ("�", "&uuml;", $texto); 
		$texto = str_replace ("�", "&Auml;", $texto); 
		$texto = str_replace ("�", "&Euml;", $texto); 
		$texto = str_replace ("�", "&Iuml;", $texto); 
		$texto = str_replace ("�", "&Ouml;", $texto); 
		$texto = str_replace ("�", "&Uuml;", $texto);
		$texto = str_replace ("�", "&acirc;", $texto); 
		$texto = str_replace ("�", "&ecirc;", $texto); 
		$texto = str_replace ("�", "&icirc;", $texto); 
		$texto = str_replace ("�", "&ocirc;", $texto); 
		$texto = str_replace ("�", "&ucirc;", $texto); 
		$texto = str_replace ("�", "&Acirc;", $texto); 
		$texto = str_replace ("�", "&Ecirc;", $texto); 
		$texto = str_replace ("�", "&Icirc;", $texto); 
		$texto = str_replace ("�", "&Ocirc;", $texto); 
		$texto = str_replace ("�", "&Ucirc;", $texto);
		$texto = str_replace ("�", "&atilde;", $texto); 
		$texto = str_replace ("�", "&otilde;", $texto); 
		$texto = str_replace ("�", "&Atilde;", $texto); 
		$texto = str_replace ("�", "&Otilde;", $texto); 
		$texto = str_replace ("�", "&ntilde;", $texto); 
		$texto = str_replace ("�", "&Ntilde;", $texto); 
		$texto = str_replace ("�", "&ccedil;", $texto); 
		$texto = str_replace ("�", "&Ccedil;", $texto); 
		$texto = str_replace ("�", "&yacute;", $texto); 
		$texto = str_replace ("�", "&Yacute;", $texto);

		return $texto;
	}
}

?>