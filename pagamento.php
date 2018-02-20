<link rel="stylesheet" type="text/css" href="css/style.css"/>
<?php

include("dbConnect.php");

$matricula = $_GET['matricula'];

$query = "SELECT cursoid FROM matricula WHERE id = $matricula";
$curso = pg_exec(getDb(), $query);
$curso = pg_fetch_array($curso);

$query = "SELECT * FROM curso WHERE id = ".$curso["cursoid"];
$curso = pg_exec(getDb(), $query);
$curso = pg_fetch_array($curso);

?>

<div class="form">
  <fieldset>
    <legend><h3>Efetuar pagamento</h3></legend>
    <form action="efetuaPagamento.php" method="post">
      Curso: <?= $curso["nome"] ?><br>
      Valor: <?= $curso["valormatricula"] ?><br><br>
      <label for="valor"> Valor recebido: </label><br>
      <input id="valor" name="valor" class="moeda" type="text" required>
      <input type="hidden" name="matricula" value="<?= $matricula ?>">
      <input type="hidden" name="valorMatricula" value="<?= $curso["valormatricula"] ?>">
      <input type="submit">
    </form>
  </fieldset>
</div>