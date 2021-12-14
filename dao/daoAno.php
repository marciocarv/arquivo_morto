<?php
class daoAno{
	private $conexao;
	public $con;
	
	function __construct(){
		$this->conexao = new conexao();
		$this->con = $this->conexao->conectar();
	}
	
	function inserir($obj){
		
		try {
			$stmt = $this->con->prepare('INSERT INTO ano(descricao) values(:descricao)');
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
			$stmt = $this->con->prepare('SELECT * FROM ano order by descricao');
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach ($result as $row){
				
				$ano = new ano();
				$ano->setIdAno($row['idano']);
				$ano->setDescricao($row['descricao']);
				
				$lista[]= $ano;
				
			}
			return $lista;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	function alterar($obj){
	
		try {
			$stmt = $this->con->prepare('UPDATE ano set descricao=:descricao where idano=:idano');
			$stmt->bindValue('descricao', $obj->getDescricao());
			$stmt->bindValue('idano', $obj->getIdAno());
			$stmt->execute();
			return true;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
	}
	
	function listaPorId($id){
		
		try {
			$stmt = $this->con->prepare('SELECT * FROM ano WHERE idano=:id');
			$stmt->bindValue('id', $id);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			
			$ano = new ano();
			$ano->setIdAno($result['idano']);
			$ano->setDescricao($result['descricao']);
			
			return $ano;
		}catch (Exception $e){
			echo $e->getMessage();
			return false;
		}
		
	}
	
	function excluir($obj){
		try{
			$stmt = $this->con->prepare('DELETE FROM ano WHERE idano=:id');
			$stmt->bindValue('id', $obj->getIdAno());
			$stmt->execute();
			
			return true;
			
		}catch(Exception $e){
			echo $e->getMessage();
			return false;
		}		
	}
	
	function confereAno($obj){
		
		try {
			$stmt = $this->con->prepare('SELECT * FROM ano WHERE descricao=:descricao');
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