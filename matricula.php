<link rel="stylesheet" type="text/css" href="css/style.css" />
<?php

include('dbConnect.php');

$matricula = $_GET["matricula"];

$query = "SELECT * FROM matricula WHERE id = $matricula";
$matricula = pg_exec(getDb(), $query);
$matricula = pg_fetch_assoc($matricula, 0);

$query = "SELECT * FROM aluno WHERE id = ".$matricula['alunoid'];
$aluno = pg_exec(getDb(), $query);
$aluno = pg_fetch_assoc($aluno, 0);

$query = "SELECT * FROM curso WHERE id = ".$matricula['cursoid'];
$curso = pg_exec(getDb(), $query);
$curso = pg_fetch_assoc($curso, 0);

switch ($curso['periodo']){
  case 0:
    $curso['periodo'] = "Matutino";
  break;
  case 1:
    $curso['periodo'] = "Vespertino";
  break;
  case 2:
    $curso['periodo'] = "Noturno";
  break;
}

?>

<div id="matricula" style="background-color:#2D8D2D;">
  <h1>Matricula #<?= $matricula['id']; ?></h1>
  <h4>Data da Matricula: <?= $matricula['datamatricula']; ?></h4>
  <h4>Ano Letivo: <?= $matricula['anoletivo']; ?></h4>
  <?php if ($matricula['pago'] == 0) { ?>
    <h4>Valor de inscrição pendente: <?= $curso['valormatricula'] ?></h4>
    <a href='pagamento.php?matricula=<?= $matricula['id'] ?>'><button type='button'>Pagar</a>
  <?php } ?>
  <a href='cancelaMatricula.php?matricula=<?= $matricula['id'] ?>'><button type='button'>Cancelar Matricula</a>

</div>

<div id="matricula" style="background-color:#0C5F0C;">
  <h1><?= $aluno['nome']; ?></h1>
  <h4>ID do aluno: <?= $aluno['id']; ?></h4>
  <h4>Data de Nascimento: <?= $aluno['datanasc']; ?></h4>
  <h4>Telefone: <?= $aluno['telefone']; ?></h4>
  <h4>CPF: <?= $aluno['cpf']; ?></h4>
  <h4>RG: <?= $aluno['rg']; ?></h4>
</div>

<div id="matricula" style="background-color:#2D8D2D;">
  <h1><?= $curso['nome']; ?></h1>
  <h4>ID do curso: <?= $curso['id']; ?></h4>
  <h4>Periodo: <?= $curso['periodo']; ?></h4>
  <h4>Duração (Meses): <?= $curso['duracao']; ?></h4>
  <h4>Mensalidade: <?= $curso['valormensalidade']; ?></h4>
</div>