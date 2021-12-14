<?php

class alunoAction{
	private $alunoC;
	private $anoC;


	function __construct(){
		$this->alunoC = new alunoController();
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
			case 'Subir':
				$this->subir();
				break;
			case 'Descer':
				$this->descer();
				break;
			case 'Transferir':
				$this->transferir();
				break;
			case 'Pesquisar':
				$this->pesquisar();
				break;
			default:
				$this->index();
				break;
		}
	}


	function index(){
		
		if(filter_input(INPUT_GET, 'idcaixa')){
			$this->alunoC->redirecionarUrl("?acao=alunoAction&pg=Cadastrar&idcaixa=".$_GET['idcaixa']);
		}else{
			$this->alunoC->redirecionarUrl("?acao=indexAction");
		}
	}


	function cadastrar(){
		$script = "	<script src=\"js/select2/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadAluno').validate();
						$('[data-form=select2]').select2();
						$('#data_nascimento').mask('00/00/0000');
						
					</script>";
		
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";
		
		if(filter_input(INPUT_POST, 'nome') && filter_input(INPUT_GET, 'idcaixa') && filter_input(INPUT_POST, 'data_nascimento')){
		
						
			$aluno = $this->alunoC->setPost($_POST, get_class(new aluno()));
			
			$caixaC = new caixaController();
			$caixa = $caixaC->listaPorId(filter_input(INPUT_GET, 'idcaixa'));
			
			$aluno->setCaixa($caixa);
			
			$ano = $this->anoC->listaPorId($aluno->getAno());
			$aluno->setAno($ano);
			
			$resposta = $this->alunoC->inserir($aluno);

			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/cadAluno.php");

			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	


			$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro($resposta), $paginaT);
			$paginaT = str_replace("#ANO#", $this->anoC->combo(), $paginaT);
			$paginaT = str_replace("#IDCAIXA#", $caixa->getIdCaixa(), $paginaT);

			$paginaT = str_replace("#TITULOHEADER#", "Aluno", $paginaT);
			$paginaT = str_replace("#TITULO#", "Cadastrar Aluno - Caixa ".$caixa->getDescricao(), $paginaT);

			$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
			$paginaT = str_replace("#CSS#", $css, $paginaT);

		}else{
			
			if(filter_input(INPUT_GET, 'idcaixa')){
				
				$caixaC = new caixaController();
				$caixa = $caixaC->listaPorId(filter_input(INPUT_GET, 'idcaixa'));
					
				$template = file_get_contents("visao/template.php");
				$paginaTemp = file_get_contents("visao/cadAluno.php");
				
				$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);
				
				if(filter_input(INPUT_GET, 'flag')==1){
				
					$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro("vazio"), $paginaT);
				}
				
				$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro(), $paginaT);
				$paginaT = str_replace("#IDCAIXA#", $caixa->getIdCaixa(), $paginaT);
				$paginaT = str_replace("#ANO#", $this->anoC->combo(), $paginaT);
				
				$paginaT = str_replace("#TITULOHEADER#", "Aluno", $paginaT);
				$paginaT = str_replace("#TITULO#", "Cadastrar Aluno - Caixa ".$caixa->getDescricao(), $paginaT);
				
				$paginaT = str_replace("#SCRIPT#", $script, $paginaT);
				$paginaT = str_replace("#CSS#", $css, $paginaT);
				
			}else{
				$this->alunoC->redirecionarUrl('?acao=indexAction');
			}
			
		}
		
		$lista = $this->alunoC->listar(filter_input(INPUT_GET, 'idcaixa'));
		
		$paginacao = new paginacaoE();
		
		$paginacao->setTamanhoPagina(100);
		$lista = $paginacao->paginar($lista);
		
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->alunoC->popularTable($lista), $paginaT);

		$this->alunoC->redirecionar($paginaT);
	}

	function alterar(){

		$script = "	<script src=\"js/select2/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#altAluno').validate();
						$('[data-form=select2]').select2();
						$('#data_nascimento').mask('00/00/0000');
						
					</script>";
		
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";


		if(filter_input(INPUT_POST, 'nome') && filter_input(INPUT_GET, 'idcaixa') && filter_input(INPUT_POST, 'data_nascimento')){

			$aluno = new aluno();
			$caixaC = new caixaController();
			$ano = new ano();
			$util = new util();
			
			$caixa = $caixaC->listaPorId(filter_input(INPUT_GET, 'idcaixa'));
			$ano = $this->anoC->listaPorId(filter_input(INPUT_POST, 'ano'));

			$aluno = $this->alunoC->setPost($_POST, get_class($aluno));
			
			$aluno->setCaixa($caixa);
			$aluno->setAno($ano);
						
			$aluno = $this->alunoC->alterar($aluno);
			
			$resposta = (is_null($aluno))==true? "erro": "sucesso";
			
			$aluno = $this->alunoC->listaPorId($_POST['idaluno']);
			
			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/altAluno.php");

			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	

			$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro($resposta), $paginaT);

			$paginaT = str_replace("#IDCAIXA#", filter_input(INPUT_GET, 'idcaixa'), $paginaT);
			$paginaT = str_replace("#IDALUNO#", $aluno->getIdAluno(), $paginaT);
			$paginaT = str_replace("#NOME#", $aluno->getNome(), $paginaT);
			$paginaT = str_replace("#NOME_MAE#", $aluno->getNome_mae(), $paginaT);
			$paginaT = str_replace("#ANO#", $this->anoC->combo($aluno->getAno()->getIdAno()), $paginaT);
			$paginaT = str_replace("#NASCIMENTO#", $aluno->getData_nascimento(), $paginaT);
			$paginaT = str_replace("#ORDEM#", $aluno->getOrdem(), $paginaT);

			$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
			$paginaT = str_replace("#CSS#", $css, $paginaT);
			
			$paginaT = str_replace("#TITULOHEADER#", "Aluno", $paginaT);
			$paginaT = str_replace("#TITULO#", "Editar Aluno", $paginaT);

		}else{
			if(filter_input(INPUT_GET, 'idcaixa')){

				$aluno = $this->alunoC->listaPorId(filter_input(INPUT_GET, 'id'));
	
				$template = file_get_contents("visao/template.php");
				$paginaTemp = file_get_contents("visao/altAluno.php");
	
				$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);	
	
				$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro(), $paginaT);
	
				$paginaT = str_replace("#IDALUNO#", $aluno->getIdAluno(), $paginaT);
				$paginaT = str_replace("#IDCAIXA#", filter_input(INPUT_GET, 'idcaixa'), $paginaT);
				$paginaT = str_replace("#NOME#", $aluno->getNome(), $paginaT);
				$paginaT = str_replace("#NOME_MAE#", $aluno->getNome_mae(), $paginaT);
				$paginaT = str_replace("#ANO#", $this->anoC->combo($aluno->getAno()->getIdAno()), $paginaT);
				$paginaT = str_replace("#NASCIMENTO#", $aluno->getData_nascimento(), $paginaT);
				$paginaT = str_replace("#ORDEM#", $aluno->getOrdem(), $paginaT);
	
				$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
				$paginaT = str_replace("#CSS#", $css, $paginaT);
				
				$paginaT = str_replace("#TITULOHEADER#", "Aluno", $paginaT);
				$paginaT = str_replace("#TITULO#", "Editar Aluno", $paginaT);
			}else{
				$this->alunoC->redirecionarUrl('?acao=indexAction');
			}
		}
		
		$lista = $this->alunoC->listar(filter_input(INPUT_GET, 'idcaixa'));
		
		$paginacao = new paginacaoE();
		
		$paginacao->setTamanhoPagina(100);
		$lista = $paginacao->paginar($lista);
		
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->alunoC->popularTable($lista), $paginaT);

		$this->alunoC->redirecionar($paginaT);	
	}
	
	function transferir(){
	
		$script = "	<script src=\"js/select2/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#altAluno').validate();
						$('[data-form=select2]').select2();
						$('#data_nascimento').mask('00/00/0000');
	
					</script>";
	
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";
	
	
		if(filter_input(INPUT_POST, 'ano')){
	
			$aluno = new aluno();
			$caixaC = new caixaController();
			$ano = new ano();
			$util = new util();
	
			$aluno = $this->alunoC->setPost($_POST, get_class($aluno));
			$ano = $this->anoC->listaPorId(filter_input(INPUT_POST, 'ano'));
			
			$aluno->setAno($ano);
			
			$nome = filter_input(INPUT_POST, 'nome');
			
			$aluno->setNome($nome."<span class=\"transf\"> TRANSFERIDO PARA ".$aluno->getAno()->getDescricao()."</span>");
	
			$aluno = $this->alunoC->alterar($aluno);
				
			$resposta = (is_null($aluno))==true? "erro": "sucesso";
				
			$aluno = $this->alunoC->listaPorId($_POST['idaluno']);
				
			$template = file_get_contents("visao/template.php");
			$paginaTemp = file_get_contents("visao/cadAluno.php");
	
			$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);
	
			$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro($resposta), $paginaT);
	
			$paginaT = str_replace("#IDCAIXA#", filter_input(INPUT_GET, 'idcaixa'), $paginaT);
			$paginaT = str_replace("#IDALUNO#", $aluno->getIdAluno(), $paginaT);
			$paginaT = str_replace("#NOME#", $aluno->getNome(), $paginaT);
			$paginaT = str_replace("#NOME_MAE#", $aluno->getNome_mae(), $paginaT);
			$paginaT = str_replace("#ANO#", $this->anoC->combo($aluno->getAno()->getIdAno()), $paginaT);
			$paginaT = str_replace("#NASCIMENTO#", $aluno->getData_nascimento(), $paginaT);
			$paginaT = str_replace("#ORDEM#", $aluno->getOrdem(), $paginaT);
	
			$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
			$paginaT = str_replace("#CSS#", $css, $paginaT);
				
			$paginaT = str_replace("#TITULOHEADER#", "Transferencia", $paginaT);
			$paginaT = str_replace("#TITULO#", "Transferencia", $paginaT);
	
		}else{
			if(filter_input(INPUT_GET, 'idcaixa')){
	
				$aluno = $this->alunoC->listaPorId(filter_input(INPUT_GET, 'id'));
	
				$template = file_get_contents("visao/template.php");
				$paginaTemp = file_get_contents("visao/transferencia.php");
	
				$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);
	
				$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro(), $paginaT);
	
				$paginaT = str_replace("#IDALUNO#", $aluno->getIdAluno(), $paginaT);
				$paginaT = str_replace("#IDCAIXA#", filter_input(INPUT_GET, 'idcaixa'), $paginaT);
				$paginaT = str_replace("#NOME#", $aluno->getNome(), $paginaT);
				$paginaT = str_replace("#NOME_MAE#", $aluno->getNome_mae(), $paginaT);
				$paginaT = str_replace("#ANO#", $this->anoC->combo($aluno->getAno()->getIdAno()), $paginaT);
				$paginaT = str_replace("#NASCIMENTO#", $aluno->getData_nascimento(), $paginaT);
				$paginaT = str_replace("#ORDEM#", $aluno->getOrdem(), $paginaT);
	
				$paginaT = str_replace("#SCRIPT#", $script , $paginaT);
				$paginaT = str_replace("#CSS#", $css, $paginaT);
	
				$paginaT = str_replace("#TITULOHEADER#", "Transferencia", $paginaT);
				$paginaT = str_replace("#TITULO#", "Transferencia", $paginaT);
			}else{
				$this->alunoC->redirecionarUrl('?acao=indexAction');
			}
		}
	
		$lista = $this->alunoC->listar(filter_input(INPUT_GET, 'idcaixa'));
	
		$paginacao = new paginacaoE();
	
		$paginacao->setTamanhoPagina(100);
		$lista = $paginacao->paginar($lista);
	
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->alunoC->popularTable($lista), $paginaT);
	
		$this->alunoC->redirecionar($paginaT);
	}
	
	
	function excluir(){
		$script = "	<script src=\"js/select2/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadAluno').validate();
						$('[data-form=select2]').select2();
						$('#data_nascimento').mask('00/00/0000');
						
					</script>";
		
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";
		
		$aluno = $this->alunoC->listaPorId($_GET['id']);
		$resposta = $this->alunoC->excluir($aluno);
		
		$caixaC = new caixaController();
		$caixa = $caixaC->listaPorId(filter_input(INPUT_GET, 'idcaixa'));
			
		$template = file_get_contents("visao/template.php");
		$paginaTemp = file_get_contents("visao/cadAluno.php");
		
		$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);
		
		if(filter_input(INPUT_GET, 'flag')==1){
		
			$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro("vazio"), $paginaT);
		}
		
		$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro($resposta), $paginaT);
		$paginaT = str_replace("#IDCAIXA#", $caixa->getIdCaixa(), $paginaT);
		$paginaT = str_replace("#ANO#", $this->anoC->combo(), $paginaT);
		
		$paginaT = str_replace("#TITULOHEADER#", "Aluno", $paginaT);
		$paginaT = str_replace("#TITULO#", "Cadastrar Aluno - Caixa ".$caixa->getDescricao(), $paginaT);
		
		$paginaT = str_replace("#SCRIPT#", $script, $paginaT);
		$paginaT = str_replace("#CSS#", $css, $paginaT);

		$lista = $this->alunoC->listar(filter_input(INPUT_GET, 'idcaixa'));
		
		$paginacao = new paginacaoE();
		
		$paginacao->setTamanhoPagina(100);
		$lista = $paginacao->paginar($lista);
		
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->alunoC->popularTable($lista), $paginaT);
		
		$this->alunoC->redirecionar($paginaT);
		
	}
	
	function subir(){
		$script = "	<script src=\"js/select2/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadAluno').validate();
						$('[data-form=select2]').select2();
						$('#data_nascimento').mask('00/00/0000');
	
					</script>";
	
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";
	
		$aluno = $this->alunoC->listaPorId($_GET['id']);
		
		$resposta = $this->alunoC->subir($aluno);
		
		$caixaC = new caixaController();
		$caixa = $caixaC->listaPorId(filter_input(INPUT_GET, 'idcaixa'));
			
		$template = file_get_contents("visao/template.php");
		$paginaTemp = file_get_contents("visao/cadAluno.php");
	
		$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);
	
		if(filter_input(INPUT_GET, 'flag')==1){
	
			$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro("vazio"), $paginaT);
		}
	
		$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro($resposta), $paginaT);
		$paginaT = str_replace("#IDCAIXA#", $caixa->getIdCaixa(), $paginaT);
		$paginaT = str_replace("#ANO#", $this->anoC->combo(), $paginaT);
	
		$paginaT = str_replace("#TITULOHEADER#", "Aluno", $paginaT);
		$paginaT = str_replace("#TITULO#", "Cadastrar Aluno - Caixa ".$caixa->getDescricao(), $paginaT);
	
		$paginaT = str_replace("#SCRIPT#", $script, $paginaT);
		$paginaT = str_replace("#CSS#", $css, $paginaT);
	
		$lista = $this->alunoC->listar(filter_input(INPUT_GET, 'idcaixa'));
	
		$paginacao = new paginacaoE();
	
		$paginacao->setTamanhoPagina(100);
		$lista = $paginacao->paginar($lista);
	
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->alunoC->popularTable($lista), $paginaT);
	
		$this->alunoC->redirecionar($paginaT);
	
	}
	
	function descer(){
		$script = "	<script src=\"js/select2/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadAluno').validate();
						$('[data-form=select2]').select2();
						$('#data_nascimento').mask('00/00/0000');
	
					</script>";
	
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";
	
		$aluno = $this->alunoC->listaPorId($_GET['id']);
		
		$resposta = $this->alunoC->descer($aluno);
		
		$caixaC = new caixaController();
		$caixa = $caixaC->listaPorId(filter_input(INPUT_GET, 'idcaixa'));
			
		$template = file_get_contents("visao/template.php");
		$paginaTemp = file_get_contents("visao/cadAluno.php");
	
		$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);
	
		if(filter_input(INPUT_GET, 'flag')==1){
	
			$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro("vazio"), $paginaT);
		}
	
		$paginaT = str_replace("#MENSAGEM#", $this->alunoC->erro($resposta), $paginaT);
		$paginaT = str_replace("#IDCAIXA#", $caixa->getIdCaixa(), $paginaT);
		$paginaT = str_replace("#ANO#", $this->anoC->combo(), $paginaT);
	
		$paginaT = str_replace("#TITULOHEADER#", "Aluno", $paginaT);
		$paginaT = str_replace("#TITULO#", "Cadastrar Aluno - Caixa ".$caixa->getDescricao(), $paginaT);
	
		$paginaT = str_replace("#SCRIPT#", $script, $paginaT);
		$paginaT = str_replace("#CSS#", $css, $paginaT);
	
		$lista = $this->alunoC->listar(filter_input(INPUT_GET, 'idcaixa'));
	
		$paginacao = new paginacaoE();
	
		$paginacao->setTamanhoPagina(100);
		$lista = $paginacao->paginar($lista);
	
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->alunoC->popularTable($lista), $paginaT);
	
		$this->alunoC->redirecionar($paginaT);
	
	}
	
	function pesquisar(){
		$script = "	<script src=\"js/select2/select2.min.js\"></script>
					<script src=\"js/validate/jquery.validate.js\"></script>
					<script src=\"js/validate/jquery.metadata.js\"></script>
					<script src=\"js/mask/mask.js\"></script>
					<script>
						// validate form
						$('#cadAluno').validate();
						$('[data-form=select2]').select2();
						$('#data_nascimento').mask('00/00/0000');
	
					</script>";
	
		$css = "<link href=\"css/select2.css\" rel=\"stylesheet\" type=\"text/css\" />";
		$aluno = new aluno();
		$ano = new ano();
		
		if(filter_input(INPUT_POST, "filtro_pesquisa")=="nome"){
			
			$aluno->setNome(filter_input(INPUT_POST, "pesquisa"));
			
		}else
			if(filter_input(INPUT_POST, "filtro_pesquisa")=="ano"){
			
				$ano->setDescricao(filter_input(INPUT_POST, "pesquisa"));
				$aluno->setAno($ano);
			
		}else
			if(filter_input(INPUT_POST, "filtro_pesquisa")=="nascimento"){
			
				$aluno->setData_nascimento(filter_input(INPUT_POST, "pesquisa"));
		}
		
	
		$lista = $this->alunoC->pesquisar($aluno, filter_input(INPUT_POST, "filtro_pesquisa"));
		
		//print_r($lista);exit;
		
			
		$template = file_get_contents("visao/template.php");
		$paginaTemp = file_get_contents("visao/resultadoPesquisa.php");
	
		$paginaT = str_replace("#CONTEUDO_SITE#", $paginaTemp, $template);
		
		$paginaT = str_replace("#TITULOHEADER#", "Resultado Pesquisa", $paginaT);
		$paginaT = str_replace("#TITULO#", "Resultado Pesquisa", $paginaT);
	
		$paginaT = str_replace("#SCRIPT#", $script, $paginaT);
		$paginaT = str_replace("#CSS#", $css, $paginaT);
	
		$paginacao = new paginacaoE();
	
		$paginacao->setTamanhoPagina(700);
		$lista = $paginacao->paginar($lista);
	
		$paginaT = str_replace("#BARRA#", $paginacao->barra(), $paginaT);
		$paginaT = str_replace("#TABELA#", $this->alunoC->popularTablePesquisa($lista), $paginaT);
	
		$this->alunoC->redirecionar($paginaT);
	
	}
}
?>