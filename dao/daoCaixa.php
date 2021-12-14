<?php
class daoCaixa{
	private $conexao;
	public $con;
	
	function __construct(){
		$this->conexao = new conexao();
		$this->con = $this->conexao->conectar();
	}
	
	function inserir($obj){
		
		try {
			$stmt = $this->con->prepare('INSERT INTO caixa(descricao) values(:descricao)');
			$stmt->bindValue('descricao', $obj->getDescricao());
			$stmt->execute();
			return true;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
	}

	function listar(){		
		try {
			$stmt = $this->con->prepare('SELECT * FROM caixa order by ordem');
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			if($result){
				foreach ($result as $row){
					
					$caixa = new caixa();
					$caixa->setIdCaixa($row['idcaixa']);
					$caixa->setDescricao($row['descricao']);
					$caixa->setOrdem($row['ordem']);
					
					$lista[]= $caixa;
					
				}
				return $lista;
			}else{
				$lista[] = "";
				return $lista;
			}
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	function alterar($obj){
	
		try {
			$stmt = $this->con->prepare('UPDATE caixa set descricao=:descricao where idcaixa=:idcaixa');
			$stmt->bindValue('descricao', $obj->getDescricao());
			$stmt->bindValue('idcaixa', $obj->getIdCaixa());
			$stmt->execute();
			return true;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	function listaPorId($id){
		
		try {
			$stmt = $this->con->prepare('SELECT * FROM caixa WHERE idcaixa=:id');
			$stmt->bindValue('id', $id);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$caixa = new caixa();
			$caixa->setIdCaixa($result['idcaixa']);
			$caixa->setDescricao($result['descricao']);
			
			return $caixa;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
		
	}
	
	function excluir($obj){
		try{
			$stmt = $this->con->prepare('DELETE FROM caixa WHERE idcaixa=:id');
			$stmt->bindValue('id', $obj->getIdCaixa());
			$stmt->execute();
			
			return true;
			
		}catch(Exception $e){
			echo $e->getMessage();
			return false;
		}		
	}
	
function confereCaixa($obj){
		
		try {
			$stmt = $this->con->prepare('SELECT * FROM caixa WHERE descricao=:descricao');
			$stmt->bindValue('descricao', $obj->getDescricao());
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
}
?>