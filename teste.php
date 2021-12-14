<?php




?>
<head>
	<title>rifa</title>
	<style>
		table{padding: 0 0 0 50px;text-align:justify;}
		td{border: 1px solid; font-size: 15px; width: 370px;}
		span.numero{margin-left: 200px;}
		span.titulo{margin-left: 80px;}
		span.texto{margin-left: 5px;}
		.final{padding: 5px;}
	</style>
</head>
<body>
<table cellspacing="0">

<?php
	$i=1;
	while($i<=100){
		echo "<tr>";
		echo "<td>";
		echo "<strong>NOME:__________________________________________</strong><br />";
		echo "<strong>ENDEREÇO:_____________________________________</strong><br />";
		echo "<strong>TELEFONE:______________________________________</strong><br />";
		echo "<br /><strong>Nº $i.</strong>";
		echo "</td>";
		echo "<td class=\"final\">";
		echo "<span class=\"titulo\"><strong>RIFA ENTRE AMIGOS</strong><br /><span>";
		echo "<span class=\"texto\">Sorteio de um perfume importado Contém1g <br /> <strong>Data:</strong> 04/05/2018&nbsp;<strong>Local:</strong> Escola Mestre Pacifico <strong>&nbsp;&nbsp;&nbsp;&nbsp;Valor:R$ 5,00</strong></span>";
		echo "<span class=\"numero\"><strong>Nº $i</strong><br /></span>";
		echo "</td>";
		echo "</tr>";
		$i++;
	}

?>
	
</table>
</body>
