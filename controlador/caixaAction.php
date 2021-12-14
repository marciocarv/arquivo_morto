<?php

class caixaAction{
	private $caixaC;


	function __construct(){
		$this->caixaC = new caixaController();
	}


	function show(){
		switch(filter_input(INPUT_GET, 'pg')){
			case 'Cadastrar':
				$this->cadastrar();
				break;
			case 'Excluir':
				$this->excluir();
				break;			
			case 'Alterar':
				$this->alterar();
				break;
			default:
				$this->index();
				break;
		}
	}


	function index(){

		$this->caixaC->redirecionarUrl("?acao=caixaAction&pg=Cadastrar");
	}


	function cadastrar(){
		$script = "	<script src=\"select2/js/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadCaixa').validate();
						
					</script>";
		
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";

		if(filter_input(INPUT_POST, 'descricao')){
						
			$caixa = $this->caixaC->setPost($_POST, get_class(new caixa()));
			
			$resposta = $this->caixaC->inserir($caixa);

			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/cadCaixa.php");

			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	


			$paginaT = str_replace("#MENSAGEM#", $this->caixaC->erro($resposta), $paginaT);

			$paginaT = str_replace("#TITULOHEADER#", "Caixa", $paginaT);
			$paginaT = str_replace("#TITULO#", "Cadastrar Caixa", $paginaT);

			$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
			$paginaT = str_replace("#CSS#", $css, $paginaT);

		}else{
			
			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/cadCaixa.php");

			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	

			if(filter_input(INPUT_GET, 'flag')==1){

				$paginaT = str_replace("#MENSAGEM#", $this->caixaC->erro("vazio"), $paginaT);
			}

			$paginaT = str_replace("#MENSAGEM#", $this->caixaC->erro(), $paginaT);

			$paginaT = str_replace("#TITULOHEADER#", "Caixa", $paginaT);
			$paginaT = str_replace("#TITULO#", "Cadastrar Caixa", $paginaT);
		
			$paginaT = str_replace("#SCRIPT#", $script, $paginaT);
			$paginaT = str_replace("#CSS#", $css, $paginaT);
			
		}
		
		$lista = $this->caixaC->listar();
		
		$paginacao = new paginacaoE();
		
		$paginacao->setTamanhoPagina(15);
		$lista = $paginacao->paginar($lista);
		
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->caixaC->popularTable($lista), $paginaT);

		$this->caixaC->redirecionar($paginaT);	
	}

	function alterar(){

		$script = "	<script src=\"select2/js/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadCaixa').validate();
						
					</script>";
		
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";


		if(filter_input(INPUT_POST, 'descricao')){

			$caixa = new caixa();

			$caixa = $this->caixaC->setPost($_POST, get_class($caixa));
						
			$caixa = $this->caixaC->alterar($caixa);
			
			$resposta = (is_null($caixa))==true? "erro": "sucesso";
			
			$caixa = $this->caixaC->listaPorId($_POST['idcaixa']);
			
			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/altCaixa.php");

			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	

			$paginaT = str_replace("#MENSAGEM#", $this->caixaC->erro($resposta), $paginaT);

			$paginaT = str_replace("#IDCAIXA#", $caixa->getIdCaixa(), $paginaT);
			$paginaT = str_replace("#DESCRICAO#", $caixa->getDescricao(), $paginaT);
			$paginaT = str_replace("#ORDEM#", $caixa->getOrdem(), $paginaT);

			$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
			$paginaT = str_replace("#CSS#", "", $paginaT);
			
			$paginaT = str_replace("#TITULOHEADER#", "Caixa", $paginaT);
			$paginaT = str_replace("#TITULO#", "Editar Caixa", $paginaT);

		}else{

			$caixa = $this->caixaC->listaPorId(filter_input(INPUT_GET, 'id'));

			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/altCaixa.php");

			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	

			$paginaT = str_replace("#MENSAGEM#", $this->caixaC->erro(), $paginaT);

			$paginaT = str_replace("#IDCAIXA#", $caixa->getIdCaixa(), $paginaT);
			$paginaT = str_replace("#DESCRICAO#", $caixa->getDescricao(), $paginaT);
			$paginaT = str_replace("#ORDEM#", $caixa->getOrdem(), $paginaT);

			$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
			$paginaT = str_replace("#CSS#", "", $paginaT);
			
			$paginaT = str_replace("#TITULOHEADER#", "Caixa", $paginaT);
			$paginaT = str_replace("#TITULO#", "Editar Caixa", $paginaT);
		}
		
		$lista = $this->caixaC->listar();
		$paginacao = new PaginacaoE();
		$paginacao->setTamanhoPagina(15);
		$lista = $paginacao->paginar($lista);
		
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->caixaC->popularTable($lista), $paginaT);

		$this->caixaC->redirecionar($paginaT);	
	}


	function excluir(){
		$script = "	<script src=\"select2/js/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadCaixa').validate();
		
					</script>";
		
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";
		
		$caixa = $this->caixaC->listaPorId($_GET['id']);
		$resposta = $this->caixaC->excluir($caixa);
		
		$template = file_get_contents("visao/template.php");
		$paginaTemp = file_get_contents("visao/cadCaixa.php");
		
		$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);
		$paginaT = str_replace("#MENSAGEM#", $this->caixaC->erro($resposta), $paginaT);
		
		$paginaT = str_replace("#TITULOHEADER#", "Caixa", $paginaT);
		$paginaT = str_replace("#TITULO#", "Cadastrar Caixa", $paginaT);
		
		$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
		$paginaT = str_replace("#CSS#", $css, $paginaT);
		
		$lista = $this->caixaC->listar();
		
		$paginacao = new paginacaoE();
		
		$paginacao->setTamanhoPagina(15);
		$lista = $paginacao->paginar($lista);
		
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->caixaC->popularTable($lista), $paginaT);
		
		$this->caixaC->redirecionar($paginaT);
		
	}
}
?>