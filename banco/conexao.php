<?php
/**
*
*Classe responsável pela conexão com o banco de dados mysql.
*
*/
class conexao{
	private $usuario = "root";
	private $host = "localhost";
	private $senha = "";
	private $db = "passivo";
	public $con;
	
	function conectar(){
		try {
			    $conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db.';', $this->usuario, $this->senha);
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    return $conn;
			    
			} catch(PDOException $e) {
			    echo 'ERROR: ' . $e->getMessage();
			}
			
	}
}

/*$conexao = new conexao();
$teste = $conexao->conectar();
$id=1;
$stmt = $teste->prepare('SELECT * FROM ano WHERE idano = :id');
$stmt->bindParam(':id', $id);
$stmt->execute();

$result = $stmt->fetchAll();

if ( count($result) ) {
	foreach($result as $row) {
		print_r($row);
	}
} else {
	echo "Nennhum resultado retornado.";
}*/

?>