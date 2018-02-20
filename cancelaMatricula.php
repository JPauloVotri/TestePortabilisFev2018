<?php

include("dbConnect.php");

$matricula = $_GET['matricula'];

$data = date('Y-m-d', time());
$query = "UPDATE matricula SET ativo = 0, datacancelamento = '$data' WHERE id = $matricula";
$result = pg_exec(getDb(), $query);

if (!$result) {
  $errorMessage = pg_last_error();

  echo "<div id='mensagem' class='erro'>
    <h3>Error with query:</h3> $errorMessage <br>
    <a href='index.php'><button type='button'>Voltar</a>";

  pg_close(getDb());
  exit();
}

pg_close(getDb());

?>

<script>
  alert("Matricula cancelada com sucesso!");
  window.location = "/";
</script>