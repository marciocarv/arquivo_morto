<?php

class table{

	private $tabela;
	private $obj; //objeto a ser inserido na tabela
	private $c; //cabeçalho

	function gerar($obj, $c=null, $campos){
		$this->obj = $obj;
		$this->c = $c;

		print_r($campos);

		$this->inicia();

		$this->cabecalho();		
		$this->popular();

		$this->termina();

		echo $this->tabela;
	}

	function inicia(){
		$this->tabela = "\n<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\" id=\"tabela\">\n";
	}

	function termina(){
		$this->tabela .= "\n</table>\n";
	}

	function cabecalho(){

		$this->tabela .= "<tr>\n";

		for($i=0;$i<=sizeof($this->c)-1;$i++){
			$this->tabela .= "\t<th>";
			$this->tabela .= $this->c[$i];
			$this->tabela .= "\t</th>\n";
		}
		
		$this->tabela .= "</tr>\n";
	}

	function popular(){

		//parei aki

		$api = new ReflectionClass(get_class($this->obj[0]));

		$d = "get".$this->c[0];

		foreach($api->getMethods() as $method)
		{
			if($method->getName()==$d){
				$d.="()";
				//$f="$this->obj[$j]->$d";
				//print_r($f);
				//var_dump(call_user_func(array($api->getName(),$d)));
				call_user_func($api->getName()."::".$d);
				print_r($g);

			}
		}



		for($j=0;$j<=sizeof($this->obj)-1;$j++){

print_r($this->obj[$j]->$d);

			$this->tabela .= "<tr>\n";
			for($i=0;$i<=sizeof($this->c)-1;$i++){
				
				
				$this->tabela .= "\t<td>";
				/*$a = "get".$this->c[$i]."()";
				$b = "$this->obj[$j]->$a";
*/
				//echo "b=".$b;
				$this->tabela .= $d;
				$this->tabela .= "\t</td>\n";
				
			}
			$this->tabela .= "</tr>\n";
		}

		
	}
}
?>