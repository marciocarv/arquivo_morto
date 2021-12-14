<?php

class anoAction{
	private $anoC;


	function __construct(){
		$this->anoC = new anoController();
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

		$this->anoC->redirecionarUrl("?acao=anoAction&pg=Cadastrar");
	}


	function cadastrar(){
		$script = "	<script src=\"select2/js/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadAno').validate();
						
					</script>";
		
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";

		if(filter_input(INPUT_POST, 'descricao')){
						
			$ano = $this->anoC->setPost($_POST, get_class(new Ano()));
			
			$resposta = $this->anoC->inserir($ano);

			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/cadAno.php");

			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	


			$paginaT = str_replace("#MENSAGEM#", $this->anoC->erro($resposta), $paginaT);

			$paginaT = str_replace("#TITULOHEADER#", "Ano", $paginaT);
			$paginaT = str_replace("#TITULO#", "Cadastrar Ano", $paginaT);

			$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
			$paginaT = str_replace("#CSS#", $css, $paginaT);

		}else{
			
			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/cadAno.php");

			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	

			if(filter_input(INPUT_GET, 'flag')==1){

				$paginaT = str_replace("#MENSAGEM#", $this->anoC->erro("vazio"), $paginaT);
			}

			$paginaT = str_replace("#MENSAGEM#", $this->anoC->erro(), $paginaT);

			$paginaT = str_replace("#TITULOHEADER#", "Ano", $paginaT);
			$paginaT = str_replace("#TITULO#", "Cadastrar Ano", $paginaT);
		
			$paginaT = str_replace("#SCRIPT#", $script, $paginaT);
			$paginaT = str_replace("#CSS#", $css, $paginaT);
			
		}
		
		$lista = $this->anoC->listar();
		
		$paginacao = new paginacaoE();
		
		$paginacao->setTamanhoPagina(10);
		$lista = $paginacao->paginar($lista);
		
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->anoC->popularTable($lista), $paginaT);

		$this->anoC->redirecionar($paginaT);	
	}

	function alterar(){

		$script = "	<script src=\"select2/js/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadAno').validate();
						
					</script>";
		
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";


		if(filter_input(INPUT_POST, 'descricao')){

			$ano = new ano();

			$ano = $this->anoC->setPost($_POST, get_class($ano));
						
			$ano = $this->anoC->alterar($ano);
			
			$resposta = (is_null($ano))==true? "erro": "sucesso";
			
			$ano = $this->anoC->listaPorId($_POST['idano']);
			
			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/altAno.php");

			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	

			$paginaT = str_replace("#MENSAGEM#", $this->anoC->erro($resposta), $paginaT);

			$paginaT = str_replace("#IDANO#", $ano->getIdAno(), $paginaT);
			$paginaT = str_replace("#DESCRICAO#", $ano->getDescricao(), $paginaT);

			$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
			$paginaT = str_replace("#CSS#", "", $paginaT);
			
			$paginaT = str_replace("#TITULOHEADER#", "Ano", $paginaT);
			$paginaT = str_replace("#TITULO#", "Editar Ano", $paginaT);

		}else{

			$ano = $this->anoC->listaPorId(filter_input(INPUT_GET, 'id'));

			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/altAno.php");

			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	

			$paginaT = str_replace("#MENSAGEM#", $this->anoC->erro(), $paginaT);

			$paginaT = str_replace("#IDANO#", $ano->getIdAno(), $paginaT);
			$paginaT = str_replace("#DESCRICAO#", $ano->getDescricao(), $paginaT);

			$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
			$paginaT = str_replace("#CSS#", "", $paginaT);
			
			$paginaT = str_replace("#TITULOHEADER#", "Ano", $paginaT);
			$paginaT = str_replace("#TITULO#", "Editar Ano", $paginaT);
		}
		
		$lista = $this->anoC->listar();		
		$paginacao = new PaginacaoE();
		$paginacao->setTamanhoPagina(10);
		$lista = $paginacao->paginar($lista);
		
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->anoC->popularTable($lista), $paginaT);

		$this->anoC->redirecionar($paginaT);	
	}


	function excluir(){
		$script = "	<script src=\"select2/js/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadAno').validate();
		
					</script>";
		
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";
		
		$ano = $this->anoC->listaPorId($_GET['id']);
		$resposta = $this->anoC->excluir($ano);
		
		$template = file_get_contents("visao/template.php");
		$paginaTemp = file_get_contents("visao/cadAno.php");
		
		$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);
		$paginaT = str_replace("#MENSAGEM#", $this->anoC->erro($resposta), $paginaT);
		
		$paginaT = str_replace("#TITULOHEADER#", "Ano", $paginaT);
		$paginaT = str_replace("#TITULO#", "Cadastrar Ano", $paginaT);
		
		$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
		$paginaT = str_replace("#CSS#", $css, $paginaT);
		
		$lista = $this->anoC->listar();
		
		$paginacao = new paginacaoE();
		
		$paginacao->setTamanhoPagina(10);
		$lista = $paginacao->paginar($lista);
		
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->anoC->popularTable($lista), $paginaT);
		
		$this->anoC->redirecionar($paginaT);
		
		
	}
	
	function imprimirCentrodecusto(){
	
		$lista = $this->centrodecustoC->listar();
	
		if(!$_SESSION['configuracoes']['permissoes'][$this->urlAction]['ler']){
			$lista = array();
		}
	
		$relatorio = new CentrodecustoRelatorio();
		$relatorio->imprimirCentrodecusto($lista);
	}
}
?>