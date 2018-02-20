<link rel="stylesheet" type="text/css" href="css/style.css" />
<?php

include('dbConnect.php');
include('validaCpf.php');

$nome = $_POST['nome'];
$telefone = ($_POST['telefone'] == "") ? NULL : $_POST['telefone'];
$dataNasc = pg_escape_string($_POST['dataNasc']);
$cpf = $_POST['cpf'];
$rg = (int) $_POST['rg'];

$anoNasc = date('Y', strtotime($dataNasc));

if ($anoNasc % 4 == 0 && ($anoNasc % 100 != 0 || $anoNasc % 400 == 0))
  echo "<script> alert('Ano Bissexto!'); </script>";

$cpf = preg_replace('/[^0-9]/is', '', $cpf);

if (!validaCpf($cpf)) { ?>
  <div id="mensagem" class="erro">
    <h3>CPF Inválido!</h3>
    <a href='index.php'><button type="button">Voltar</a>
  </div> <?php
  pg_close(getDb());
  exit();
}

$query = "INSERT INTO aluno (nome, telefone, dataNasc, cpf, rg)
          VALUES ('$nome', '$telefone', '$dataNasc', '$cpf', '$rg')"; 

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

header("location:/?sucesso=1");

?>