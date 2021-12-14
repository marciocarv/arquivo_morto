            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">#TITULO#</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
            <div class="row formularios">
                <div class="col-lg-12">
                	<div class="col-lg-5">
                		<form action="?acao=alunoAction&pg=Pesquisar" method="post">
                    	<div class="form-group">
                     		<label>Pesquisar por</label>
                        		<div class="radio">
		                           	<label>
		                            	<input type="radio" name="filtro_pesquisa" id="nome" value="nome" checked>Nome
		                            </label>
                                </div>
                                <div class="radio">
                                	<label>
                                		<input type="radio" name="filtro_pesquisa" id="ano" value="ano">Ano
                                	</label>
                                </div>
                                <div class="radio">
                                	<label>
                                		<input type="radio" name="filtro_pesquisa" id="nascimento" value="nascimento">Data Nascimento
                                	</label>
                                </div>
                        </div>                    	
                        <div class="form-group">                           	
                            	<input class="form-control" type="text" id="pesquisa" name="pesquisa">
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Pesquisar" />
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
                            <i class="fa fa-th-list"></i> Resultados
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                        	<th>Caixa</th>
                                            <th>Ordem</th>
                                            <th>Nome</th>
                                            <th>Ano</th>
                                            <th>M&atilde;e</th>
                                            <th>Data Nascimento</th>
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