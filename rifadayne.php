<?php




?>
<head>
	<title>rifa</title>
	<style>
		table{margin: 1px 0 0 25px;padding: 6px 0 0 6px;}
		td{font-size: 13px; width: 360px;}
		table{border-top: 2px solid #000;border-left: 4px solid #000;border-right: 4px solid #000;border-bottom: 2px solid #000;}
		.cabecalho{text-align: center; font-weight: bold; font-size: 15px;}
		.premios{padding: 0 0 0 10px;text-align:center;}
		.nome li{padding-top: 15px;}
		.n{text-align: center;}
		#t{font-size: 16px; background-color: LightGray; border-radius: 7px;}
		.borda{border-right: 2px dashed gray;}
		.premio_div{border-radius: 7px; background-color: LightGray; width: 330px; margin-left: 15px;}
		.premios ul{padding-left: 10px; font-size: 12px;}
		#t1{font-size: 16px; background-color: LightGray; border-radius: 7px; margin-left: 120px;}
	</style>
</head>
<body>

<?php
$i = 1;
while($i<=300){
	echo "<table cellspacing=\"0\">";
	echo "<tr>";
	echo "<td class=\"cabecalho borda\">RIFA DE CESTA DE CHOCOLATE<br />SORTEIO: 29/06/2017</td>";
	echo "<td class=\"cabecalho\">RIFA DE CESTA DE CHOCOLATE<BR />SORTEIO: 29/06/2017</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"nome borda\">";
	echo "<ul>";
	echo "<li>NOME: ______________________________________</li>";
	echo "<li>TELEFONE: __________________________________</li>";
	echo "</ul>";
	echo "</td>";
	echo "<td class=\"premios\">";
	echo "<div class=\"premio_div\">";
	echo "PRÊMIO:<br />";
	echo "<strong><ul>";
	echo "<li>CESTA DE CHOCOLATE</li>";
	echo "</ul></strong>";
	echo "</div>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td class=\"n borda\"><strong>VALOR:R$ 2,00</strong><span id=\"t1\"><strong>Nº $i</strong></span></td>";
	echo "<td class=\"n\"><strong>VALOR:R$ 2,00<strong>";
	echo "<span id=\"t1\"><strong>Nº $i</strong></span></td>";
	echo "</tr>";
	echo "</table>";
	$i++;
}


?>

<?php
	/*$i=3001;
	while($i<=4000){
		echo "<tr>";
		echo "<td>";
		echo "<strong>NOME:________________________________________________</strong><br />";
		echo "<strong>TELEFONE:____________________________________________</strong><br />";
		echo "<strong>VALOR R$ 1,00.</strong><br />";
		echo "O SORTEIO SERÁ REALIZADO NO DIA 24/11/2016 NO PÁTIO DA ESCOLA MUL. MESTRE PACÍFICO<br />";
		echo "<strong>Nº $i.</strong>";
		echo "</td>";
		echo "<td>";
		echo "<strong>RIFA-SE UM BALDE DE SORVETE</strong><br />";
		echo "VALOR R$ 1,00.<br />";
		echo "O SORTEIO SERÁ REALIZADO NO DIA 24/11/2016 NO PÁTIO DA ESCOLA MUL. MESTRE PACÍFICO<br />";
		echo "<strong>Nº $i</strong>";
		echo "</td>";
		echo "</tr>";
		$i++;
	}*/

?>


	

</body>
