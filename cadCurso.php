<link rel="stylesheet" type="text/css" href="css/style.css" />
<?php

include('dbConnect.php');

$nome = $_POST['nome'];
$valorMensalidade = $_POST['valorMensalidade'];
$valorMatricula = $_POST['valorMatricula'];
$periodo = (int) $_POST['periodo'];
$duracao = (int) $_POST['duracao'];

$query = "INSERT INTO curso (nome, valorMensalidade, valorMatricula, periodo, duracao)
          VALUES ('$nome', '$valorMensalidade', '$valorMatricula', '$periodo', '$duracao')"; 

$result = pg_query(getDb(), $query);

if (!$result) {
  $errorMessage = pg_last_error();

  echo "<div id='mensagem' class='erro'>
    <h3>Error with query:</h3> $errorMessage <br>
    <a href='index.php'><button type='button'>Voltar</a>";

  pg_close(getDb());
  exit();
}

pg_close(getDb());

header("location:/");

?>