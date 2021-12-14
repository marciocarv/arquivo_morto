<?php
class util{

	private $data;

	function getData(){
		return $this->data;
	}

	/**
	* String converteData($data)
	*
	* Mйtodo que recebe uma data, confere o formato da mesma. 
	* Se tiver com (/) ele formata para inserir no banco, 
	* se for o contrario ela formata com as barras e retorna a data para aplicaзгo.
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
			$mes = "MARЗO";
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

		$texto = str_replace ("б", "&aacute;", $texto); 
		$texto = str_replace ("й", "&eacute;", $texto); 
		$texto = str_replace ("н", "&iacute;", $texto); 
		$texto = str_replace ("у", "&oacute;", $texto); 
		$texto = str_replace ("ъ", "&uacute;", $texto); 
		$texto = str_replace ("Б", "&Aacute;", $texto); 
		$texto = str_replace ("Й", "&Eacute;", $texto); 
		$texto = str_replace ("Н", "&Iacute;", $texto); 
		$texto = str_replace ("У", "&Oacute;", $texto); 
		$texto = str_replace ("Ъ", "&Uacute;", $texto); 
		$texto = str_replace ("а", "&agrave;", $texto); 
		$texto = str_replace ("и", "&egrave;", $texto); 
		$texto = str_replace ("м", "&igrave;", $texto); 
		$texto = str_replace ("т", "&ograve;", $texto); 
		$texto = str_replace ("щ", "&ugrave;", $texto); 
		$texto = str_replace ("А", "&Agrave;", $texto); 
		$texto = str_replace ("И", "&Egrave;", $texto); 
		$texto = str_replace ("М", "&Igrave;", $texto); 
		$texto = str_replace ("Т", "&Ograve;", $texto); 
		$texto = str_replace ("Щ", "&Ugrave;", $texto); 
		$texto = str_replace ("д", "&auml;", $texto); 
		$texto = str_replace ("л", "&euml;", $texto); 
		$texto = str_replace ("п", "&iuml;", $texto); 
		$texto = str_replace ("ц", "&ouml;", $texto); 
		$texto = str_replace ("ь", "&uuml;", $texto); 
		$texto = str_replace ("Д", "&Auml;", $texto); 
		$texto = str_replace ("Л", "&Euml;", $texto); 
		$texto = str_replace ("П", "&Iuml;", $texto); 
		$texto = str_replace ("Ц", "&Ouml;", $texto); 
		$texto = str_replace ("Ь", "&Uuml;", $texto);
		$texto = str_replace ("в", "&acirc;", $texto); 
		$texto = str_replace ("к", "&ecirc;", $texto); 
		$texto = str_replace ("о", "&icirc;", $texto); 
		$texto = str_replace ("ф", "&ocirc;", $texto); 
		$texto = str_replace ("ы", "&ucirc;", $texto); 
		$texto = str_replace ("В", "&Acirc;", $texto); 
		$texto = str_replace ("К", "&Ecirc;", $texto); 
		$texto = str_replace ("О", "&Icirc;", $texto); 
		$texto = str_replace ("Ф", "&Ocirc;", $texto); 
		$texto = str_replace ("Ы", "&Ucirc;", $texto);
		$texto = str_replace ("г", "&atilde;", $texto); 
		$texto = str_replace ("х", "&otilde;", $texto); 
		$texto = str_replace ("Г", "&Atilde;", $texto); 
		$texto = str_replace ("Х", "&Otilde;", $texto); 
		$texto = str_replace ("с", "&ntilde;", $texto); 
		$texto = str_replace ("С", "&Ntilde;", $texto); 
		$texto = str_replace ("з", "&ccedil;", $texto); 
		$texto = str_replace ("З", "&Ccedil;", $texto); 
		$texto = str_replace ("э", "&yacute;", $texto); 
		$texto = str_replace ("Э", "&Yacute;", $texto);

		return $texto;
	}
}

?>