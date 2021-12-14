<?php

class controle{

	function __construct(){

	}

	/**
	* void mostrar(String page);
	*
	* M�todo que recebe o nome da paginaAction.
	* Verifica se a p�gina existe para depois incluir, se n�o existir redireciona para uma pagina de erro.
	* 
	*Parametros
	*  String page. Contem a paginaAction que vai ser verificada e incluida.
	*Retorno
	*  sem retorno.
	*/
	function mostrar($page){
		if(!empty($_GET['acao'])){
			
			$caminhoAction = "controlador/".$_GET['acao'].".php";
			
			if(file_exists($caminhoAction)){
				
				$action = new $_GET['acao'];
				$action->show();
			}else{
				include("visao/404.php");
			}
		}else{
			
			$this->redirecionarUrl($page);
		}
	}
	
	function setPost($post, $classe, $campos = array()){
	
		try{
			$reflector = new \ReflectionClass($classe);
				
			$classe = $reflector->newInstance();
				
			foreach(array_keys($post) as $campo){
	
				if(in_array($campo, $campos) == false){
					$metodo = $reflector->getMethod("set".$campo);
					$classe->{$metodo->name}($post[$campo]);
				}
			}
			return $classe;
		}catch(\ReflectionException $e){
			echo $e->getMessage();
			return null;
		}
	}

	/**
	* void redirecionar(String pagina, Object obj);
	*
	* M�todo que redireciona uma p�gina na view. 
	* 
	*Parametros
	*  String pagina. Essa var�vel contem o caminho para a pagina
	*  Object obj. Essa vari�vel contem o objeto que � repassada para a view.
	*Retorno
	*  sem retorno.
	*/
	function redirecionar($pagina){
		//include($pagina);
		echo $pagina;
	}

	/**
	* void redirecionarUrl(String url);
	*
	* M�todo que redireciona para uma url. 
	* 
	*Parametros
	*  String url. Essa var�vel contem o caminho para a pagina.	  
	*Retorno
	*  sem retorno.
	*/
	function redirecionarUrl($url){
		header("Location: ".$url);
	}

	/**
	* void erro(String url);
	*
	* M�todo que cria uma div com o erro para mostrar. 
	* 
	*Parametros
	*  String url. Essa var�vel o erro.	  
	*Retorno
	*  retorna o erro formatado.
	*/
	function erro($erro=null){
		$msg = "";

		if($erro == "cadastrado"){
			$msg = "<div id=\"$erro\" class=\"alert alert-danger\">J&aacute; cadastrado no Sistema</div>";
		}else
		if($erro == "erro"){
			$msg = "<div id=\"$erro\" class=\"alert alert-danger\">Opera&ccedil;&atilde;o n&atilde;o realizada!!</div>";
		}else
		if($erro == "sucesso"){
			$msg = "<div id=\"$erro\" class=\"alert alert-success\">Opera&ccedil;&atilde;o realizada com sucesso!!</div>";
		}else
		if($erro == "vazio"){
			$msg = "<div id=\"erro\" class=\"alert alert-danger\">Erro ao Cadastrar. Verifique se todos os dados foram preenchidos Corretamente!!!</div>";
		}else
		if($erro == "consultavazio"){
			$msg = "<div id=\"erro\" class=\"alert alert-danger\">Verifique se todos os campos foram preenchidos!!!</div>";
		}else
		if($erro == "erroExcluir"){
			$msg = "<div id=\"erro\" class=\"alert alert-danger\">Opera&ccedil;&atilde;o n&atilde;o realizada!! Verifique se h&aacute; dados relacionados.</div>";
		}else
		if($erro == "nenhumC"){
			$msg = "<div id=\"cadastrado\" class=\"alert alert-info\">Nenhum Campo foi alterado!.</div>";
		}else
		if($erro == "nenhum"){
			$msg = "<div id=\"cadastrado\" class=\"alert alert-info\">A consulta n&atilde;o retornou nenhum resultado!.</div>";
		}else
		if($erro == "excluido"){
			$msg = "<div id=\"$erro\" class=\"alert alert-success\">&Iacute;tem exclu&iacute;do com sucesso!</div>";
		}else{
			$msg = "<div id=\"none\"></div>";
		}
		

		return $msg;
	}

	function slug($str){
		$str = strtolower(trim($str));

		$str = str_replace ("&aacute;", "a", $str); 
		$str = str_replace ("&eacute;","e", $str); 
		$str = str_replace ("&iacute;","i", $str); 
		$str = str_replace ("&oacute;","o", $str); 
		$str = str_replace ("&uacute;","u", $str); 		
		$str = str_replace ("&agrave;","a", $str); 
		$str = str_replace ("&egrave;","e", $str); 
		$str = str_replace ("&igrave;","i", $str); 
		$str = str_replace ("&ograve;","o", $str); 
		$str = str_replace ("&ugrave;","u",$str); 		
		$str = str_replace ("&auml;","a", $str); 
		$str = str_replace ("&euml;","e", $str); 
		$str = str_replace ("&iuml;","i", $str); 
		$str = str_replace ("&ouml;","o", $str); 
		$str = str_replace ("&uuml;","u", $str); 		
		$str = str_replace ("&acirc;","a", $str); 
		$str = str_replace ("&ecirc;","e", $str); 
		$str = str_replace ("&icirc;","i", $str); 
		$str = str_replace ("&ocirc;","o", $str); 
		$str = str_replace ("&ucirc;","u", $str); 		
		$str = str_replace ("&atilde;","a", $str); 
		$str = str_replace ("&otilde;","o", $str); 		
		$str = str_replace ("&ntilde;","n", $str); 
		$str = str_replace ("&ccedil;","c", $str); 
		$str = str_replace ("&yacute;","y", $str); 
		$str = str_replace ("�", "a", $str); 
		$str = str_replace ("�", "e", $str); 
		$str = str_replace ("�", "i", $str); 
		$str = str_replace ("�", "o", $str); 
		$str = str_replace ("�", "u", $str); 		
		$str = str_replace ("�", "a", $str); 
		$str = str_replace ("�", "e", $str); 
		$str = str_replace ("�", "i", $str); 
		$str = str_replace ("�", "o",$str); 
		$str = str_replace ("�", "u", $str); 		
		$str = str_replace ("�", "a", $str); 
		$str = str_replace ("�", "e", $str); 
		$str = str_replace ("�", "i", $str); 
		$str = str_replace ("�", "o", $str); 
		$str = str_replace ("�", "u", $str); 		
		$str = str_replace ("�", "a", $str); 
		$str = str_replace ("�", "e", $str); 
		$str = str_replace ("�", "i", $str); 
		$str = str_replace ("�", "o", $str); 
		$str = str_replace ("�", "u", $str); 		
		$str = str_replace ("�", "a",$str); 
		$str = str_replace ("�", "o", $str); 		
		$str = str_replace ("�", "n", $str); 
		$str = str_replace ("�", "c", $str); 
		$str = str_replace ("�", "y", $str); 

		$str = preg_replace('/[^a-z0-9-]/', '-', $str);
		$str = preg_replace('/-+/', "-", $str);
		return $str;
	}

	function limpar($msg){
		$msg = get_magic_quotes_gpc() ? stripslashes($msg) : addslashes($msg);
		return $msg;
	}

	function __destruct(){

	}
}
?>