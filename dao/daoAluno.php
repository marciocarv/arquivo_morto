<?php
class daoAluno{
	private $conexao;
	public $con;
	
	function __construct(){
		$this->conexao = new conexao();
		$this->con = $this->conexao->conectar();
	}
	
	function inserir($obj){
		$util = new util();
		try {
			$stmt = $this->con->prepare('INSERT INTO aluno(idcaixa, idano, nome, nome_mae, data_nascimento, ordem) values(:idcaixa, :idano, :nome, :nome_mae, :data_nascimento, :ordem)');
			$stmt->bindValue('idcaixa', $obj->getCaixa()->getIdCaixa());
			$stmt->bindValue('idano', $obj->getAno()->getIdAno());
			$stmt->bindValue('nome', $obj->getNome());
			$stmt->bindValue('nome_mae', $obj->getNome_mae());
			$stmt->bindValue('data_nascimento', $util->converteData($obj->getData_nascimento()));
			$stmt->bindValue('ordem', $obj->getOrdem());
			$stmt->execute();
			return true;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
	}

	function listarPorCaixa($id){
		
		try {
			$stmt = $this->con->prepare('SELECT a.idaluno, a.idano, a.idcaixa, c.descricao, an.descricao as anodescricao, a.nome, a.nome_mae, a.data_nascimento, a.ordem FROM aluno a inner join ano an on a.idano = an.idano inner join caixa c on a.idcaixa = c.idcaixa where a.idcaixa = :idcaixa order by ordem desc');
			$stmt->bindValue('idcaixa', $id);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			if($result){
				foreach ($result as $row){
					
					$caixa = new caixa();
					$caixa->setIdCaixa($row['idcaixa']);
					$caixa->setDescricao($row['descricao']);
					
					$ano = new ano();
					$ano->setIdAno($row['idano']);
					$ano->setDescricao($row['anodescricao']);
					
					$aluno = new aluno();
					$aluno->setIdAluno($row['idaluno']);
					$aluno->setCaixa($caixa);
					$aluno->setAno($ano);
					$aluno->setNome($row['nome']);
					$aluno->setNome_mae($row['nome_mae']);
					$aluno->setData_nascimento($row['data_nascimento']);
					$aluno->setOrdem($row['ordem']);
					
					$lista[]= $aluno;
					
					//print_r($lista);exit;
					
				}
			}else{
				$lista[] = "";
			}
			return $lista;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	function listarPorCaixaCres($id){
	
		try {
			$stmt = $this->con->prepare('SELECT a.idaluno, a.idano, a.idcaixa, c.descricao, an.descricao as anodescricao, a.nome, a.nome_mae, a.data_nascimento, a.ordem FROM aluno a inner join ano an on a.idano = an.idano inner join caixa c on a.idcaixa = c.idcaixa where a.idcaixa = :idcaixa order by ordem');
			$stmt->bindValue('idcaixa', $id);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				
			if($result){
				foreach ($result as $row){
						
					$caixa = new caixa();
					$caixa->setIdCaixa($row['idcaixa']);
					$caixa->setDescricao($row['descricao']);
						
					$ano = new ano();
					$ano->setIdAno($row['idano']);
					$ano->setDescricao($row['anodescricao']);
						
					$aluno = new aluno();
					$aluno->setIdAluno($row['idaluno']);
					$aluno->setCaixa($caixa);
					$aluno->setAno($ano);
					$aluno->setNome($row['nome']);
					$aluno->setNome_mae($row['nome_mae']);
					$aluno->setData_nascimento($row['data_nascimento']);
					$aluno->setOrdem($row['ordem']);
						
					$lista[]= $aluno;
						
					//print_r($lista);exit;
						
				}
			}else{
				$lista[] = "";
			}
			return $lista;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	function alterar($obj){	
		$util = new util();
		try {
			$stmt = $this->con->prepare('UPDATE aluno set idano=:idano, nome=:nome, nome_mae=:nome_mae, data_nascimento=:data_nascimento, ordem=:ordem where idaluno=:idaluno');
			$stmt->bindValue('idano', $obj->getAno()->getIdAno());
			$stmt->bindValue('nome', $obj->getNome());
			$stmt->bindValue('nome_mae', $obj->getNome_mae());
			$stmt->bindValue('data_nascimento', $util->converteData($obj->getData_nascimento()));
			$stmt->bindValue('ordem', $obj->getOrdem());
			$stmt->bindValue('idaluno', $obj->getIdAluno());
			$stmt->execute();
			return true;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	function subir($aluno){
		try {
			$stmt = $this->con->prepare('UPDATE aluno set ordem=:ordem where idaluno =:idaluno');
			$stmt->bindValue('ordem', ($aluno->getOrdem()+1));
			$stmt->bindValue('idaluno', $aluno->getIdAluno());
			$stmt->execute();
			return true;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
			return true;
	}
	
	function descer($aluno){
		try {
			$stmt = $this->con->prepare('UPDATE aluno set ordem=:ordem where idaluno =:idaluno');
			$stmt->bindValue('ordem', ($aluno->getOrdem()-1));
			$stmt->bindValue('idaluno', $aluno->getIdAluno());
			$stmt->execute();
			return true;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
		return true;
	}
	
	function listaPorId($id){
			$util = new util();
		try {
			$stmt = $this->con->prepare('select c.idcaixa, c.descricao as caixadescricao, an.idano, an.descricao, a.idaluno, a.nome, a.nome_mae, a.data_nascimento, a.ordem from aluno a inner join caixa c on c.idcaixa = a.idcaixa inner join ano an on a.idano = an.idano where a.idaluno = :id');
			$stmt->bindValue('id', $id);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$caixa = new caixa;
			$caixa->setIdCaixa($result['idcaixa']);
			$caixa->setDescricao($result['caixadescricao']);
			
			$ano = new ano();
			$ano->setIdAno($result['idano']);
			$ano->setDescricao($result['descricao']);
			
			$aluno = new aluno();
			$aluno->setIdAluno($result['idaluno']);
			$aluno->setCaixa($caixa);
			$aluno->setAno($ano);
			$aluno->setNome($result['nome']);
			$aluno->setData_nascimento($util->converteData($result['data_nascimento']));
			$aluno->setNome_mae($result['nome_mae']);
			$aluno->setOrdem($result['ordem']);
			
			return $aluno;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
		
	}
	
	function excluir($obj){
		try{
			$stmt = $this->con->prepare('DELETE FROM aluno WHERE idaluno=:id');
			$stmt->bindValue('id', $obj->getIdAluno());
			$stmt->execute();
			
			return true;
			
		}catch(Exception $e){
			echo $e->getMessage();
			return false;
		}		
	}
	
	function confereAluno($obj){
		$util = new util();
			try {
				$stmt = $this->con->prepare('SELECT * FROM aluno WHERE nome=:nome AND nome_mae=:nome_mae AND data_nascimento=:data_nascimento');
				$stmt->bindValue('nome', $obj->getNome());
				$stmt->bindValue('nome_mae', $obj->getNome_mae());
				$stmt->bindValue('data_nascimento', $util->converteData($obj->getData_nascimento()));
				$stmt->execute();
				
				if($result = $stmt->fetch(PDO::FETCH_ASSOC)){
					return true;
				}else{
					return false;
				}
			}catch (Exception $e){
				echo $e->getMessage();
				return false;
			}
		}
		
		function pesquisarPorNascimento($obj){
		$util = new util();
			try {
				$stmt = $this->con->prepare('SELECT a.nome, a.nome_mae, a.data_nascimento, a.ordem, an.descricao, c.descricao as caixadescricao FROM aluno a inner join ano an on an.idano = a.idano inner join caixa c on c.idcaixa = a.idcaixa WHERE a.data_nascimento=:data_nascimento order by a.nome');
				$stmt->bindValue('data_nascimento', $util->converteData($obj->getData_nascimento()));
				$stmt->execute();
				
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				if($result){
					foreach ($result as $row){
							
						$caixa = new caixa();
						$caixa->setDescricao($row['caixadescricao']);
							
						$ano = new ano();
						$ano->setDescricao($row['descricao']);
							
						$aluno = new aluno();
						$aluno->setCaixa($caixa);
						$aluno->setAno($ano);
						$aluno->setNome($row['nome']);
						$aluno->setNome_mae($row['nome_mae']);
						$aluno->setData_nascimento($row['data_nascimento']);
						$aluno->setOrdem($row['ordem']);
							
						$lista[]= $aluno;

					}
				}else{
					$lista[] = "";
				}
				return $lista;
			}catch (Exception $e){
				echo $e->getMessage();
				return false;
			}
			
		}
		
		function pesquisarPorNome($obj){
			try {
					$stmt = $this->con->prepare('SELECT a.nome, a.nome_mae, a.data_nascimento, a.ordem, an.descricao, c.descricao as caixadescricao FROM aluno a inner join ano an on an.idano = a.idano inner join caixa c on c.idcaixa = a.idcaixa WHERE  a.nome LIKE :nome order by a.nome');
					$stmt->bindValue('nome', "%".$obj->getNome()."%");
					$stmt->execute();
					
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					if($result){
						foreach ($result as $row){
								
							$caixa = new caixa();
							$caixa->setDescricao($row['caixadescricao']);
								
							$ano = new ano();
							$ano->setDescricao($row['descricao']);
								
							$aluno = new aluno();
							$aluno->setCaixa($caixa);
							$aluno->setAno($ano);
							$aluno->setNome($row['nome']);
							$aluno->setNome_mae($row['nome_mae']);
							$aluno->setData_nascimento($row['data_nascimento']);
							$aluno->setOrdem($row['ordem']);
								
							$lista[]= $aluno;
	
						}
					}else{
						$lista[] = "";
					}
					return $lista;
				}catch (Exception $e){
					echo $e->getMessage();
					return false;
				}
				
		}
		
		function pesquisarPorAno($obj){
			try {
				$stmt = $this->con->prepare('SELECT a.nome, a.nome_mae, a.data_nascimento, a.ordem, an.descricao, c.descricao as caixadescricao FROM aluno a inner join ano an on an.idano = a.idano inner join caixa c on c.idcaixa = a.idcaixa WHERE  an.descricao=:ano order by a.nome');
				$stmt->bindValue('ano', $obj->getAno()->getDescricao());
				$stmt->execute();
				
				$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
				if($result){
					foreach ($result as $row){
							
						$caixa = new caixa();
						$caixa->setDescricao($row['caixadescricao']);
							
						$ano = new ano();
						$ano->setDescricao($row['descricao']);
							
						$aluno = new aluno();
						$aluno->setCaixa($caixa);
						$aluno->setAno($ano);
						$aluno->setNome($row['nome']);
						$aluno->setNome_mae($row['nome_mae']);
						$aluno->setData_nascimento($row['data_nascimento']);
						$aluno->setOrdem($row['ordem']);
							
						$lista[]= $aluno;

					}
				}else{
					$lista[] = "";
				}
				return $lista;
			}catch (Exception $e){
				echo $e->getMessage();
				return false;
			}	
		}
}
?>