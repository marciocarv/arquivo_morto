            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">#TITULO#</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
            <div class="row formularios">
                <div class="col-lg-12">
                	<div class="col-lg-4">
                		<a href="?acao=indexAction" class="btn btn-primary voltar">Voltar</a>
                		#MENSAGEM#
                    	<form role="form" id="cadAluno" action="?acao=alunoAction&pg=Cadastrar&flag=1&idcaixa=#IDCAIXA#" method="post">
                    	
                                  <div class="form-group">
                                       <label>Nome</label>
                                       <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite o Nome" data-validate="{required: true, messages:{required:'Campo Obrigat&oacute;rio'}}">
                                  </div>
                                  <div class="form-group">
                                       <label>M&atilde;e</label>
                                       <input type="text" name="nome_mae" id="nome_mae" class="form-control" placeholder="Digite o nome da m&atilde;e" data-validate="{required: true, messages:{required:'Campo Obrigat&oacute;rio'}}">
                                  </div>
                                  <div class="form-group">
                                       <label>Nascimento</label>
                                       <input type="text" name="data_nascimento" id="data_nascimento" class="form-control" placeholder="Digite a Descri&ccedil;&atilde;o" data-validate="{required: true, messages:{required:'Campo Obrigat&oacute;rio'}}">
                                  </div>
                                  <div class="form-group">
                                  <label>Ano</label>
	                                  <div>
	                                  	#ANO#
	                                  </div>
                                  </div>
                                  <div class="form-group">
                                       <label>Ordem</label>
                                       <input type="text" name="ordem" id="ordem" class="form-control" placeholder="Digite a ordem" data-validate="{required: true, messages:{required:'Campo Obrigat&oacute;rio'}}">
                                  </div>
                                  <button type="submit" class="btn btn-default">Salvar</button>
                         </form>
                     </div>
                     <div class="col-lg-8">
                     	
                     </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            	<div class="col-lg-12">
            		<div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-th-list"></i> Listagem de Caixa
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Ordem</th>
                                            <th>Nome</th>
                                            <th>Caixa</th>
                                            <th>Ano</th>
                                            <th>M&atilde;e</th>
                                            <th>Data Nascimento</th>
                                            
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        #TABELA#
                                    </tbody>
                                </table>
                                #BARRA#
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
            	</div>
            </div>
            <!-- /.row -->