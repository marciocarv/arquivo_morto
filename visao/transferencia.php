            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">#TITULO#</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
            <div class="row formularios">
                <div class="col-lg-12">
                	<div class="col-lg-4">
                		<a href="?acao=alunoAction&idcaixa=#IDCAIXA#" class="btn btn-primary voltar">Voltar</a>
                		#MENSAGEM#
                    	<form role="form" id="altAluno" action="?acao=alunoAction&pg=Transferir&flag=1&idcaixa=#IDCAIXA#&id=#IDALUNO#" method="post">
                    	<input type="hidden" name="idaluno" value="#IDALUNO#" />
                    	<input type="hidden" name="nome" value="#NOME#" />
                    	<input type="hidden" name="data_nascimento" value="#NASCIMENTO#" />
                    	<input type="hidden" name="ordem" value="#ORDEM#" />
                    	<input type="hidden" name="nome_mae" value="#NOME_MAE#" />
                                 <div class="form-group">
                                  <label>Ano de destino</label>
	                                  <div>
	                                  	#ANO#
	                                  </div>
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