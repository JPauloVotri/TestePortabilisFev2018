<link rel="stylesheet" type="text/css" href="css/style.css" />
<?php

include("dbConnect.php");

$valor = (double)$_POST['valor'];
$matricula = $_POST['matricula'];
$valorMatricula = $_POST['valorMatricula'];

if ($valorMatricula > $valor) {?>
  <div id="mensagem" class="erro">
    <h3>Saldo insuficiente para efetuar o pagamento do curso. Ainda são necessarios R$ <?= $valorMatricula-$valor ?></h3>
    <a href='index.php'><button type="button">Voltar</a>
  </div> <?php
} else {
  $query = "UPDATE matricula SET pago = 1 where id = ".$matricula;
  $result = pg_query(getDb(), $query);?>
  <div id="mensagem" class="sucesso" style="display: block;">
  <h3>Inscriçao paga com sucesso</h3> <?php
	
	if ($valorMatricula < $valor){
		$troco = number_format($valor-$valorMatricula, 2);
    echo "<h4>Troco: $troco</h4>".geraTroco($troco)."
    <br><a href='matricula.php?matricula=$matricula'><button type='button'>Voltar</a>";
	}
}

function geraTroco($troco){
	
	$c = 0;
	$l = 0;
	$x = 0;
	$v = 0;
	$i = 0;
	$L = 0;
	$X = 0;
	$V = 0;
	$I = 0;
	
	while ($troco >= 100){
		$c++;
		$troco -= 100;
	}
	while ($troco >= 50){
		$l++;
		$troco -= 50;
	}
	while ($troco >= 10){
		$x++;
		$troco -= 10;
	}
	while ($troco >= 5){
		$v++;
		$troco -= 5;
	}
	while ($troco >= 1){
		$i++;
		$troco -= 1;
	}
	while ($troco >= 0.5){
		$L++;
		$troco -= 0.5;
	}
	while ($troco >= 0.1){
		$X++;
		$troco -= 0.1;
	}
	while ($troco >= 0.05){
		$V++;
		$troco -= 0.05;
	}
	while ($troco >= 0.01){
		$I++;
		$troco -= 0.01;
	}
	
	return $c." cédulas de R$ 100,00;<br>
		".$l." cédulas de R$ 50,00;<br>
		".$x." cédulas de R$ 10,00;<br>
		".$v." cédulas de R$ 5,00;<br>
		".$i." cédulas de R$ 1,00;<br>
		".$L." moedas de R$ 0,50;<br>
		".$X." moedas de R$ 0,10;<br>
		".$V." moedas de R$ 0,05;<br>
		".$I." moedas de R$ 0,01;<br>";
}

pg_close(getDb());

?>