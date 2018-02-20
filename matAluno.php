<link rel="stylesheet" type="text/css" href="css/style.css" />
<?php

include('dbConnect.php');

$alunoId = $_POST['alunoId'];
$cursoId = $_POST['cursoId'];
$dataMatricula = $_POST['dataMatricula'];
$anoLetivo = $_POST['anoLetivo'];
$pago = $_POST['pago'];

$dbCurso = pg_exec(getDb(), "SELECT *
                             FROM curso
                            WHERE id=".$cursoId);
$valor = pg_fetch_result($dbCurso, 0, "valorInscricao");

$pago = ($valor == 0) ? 1 : $pago;

if (!validaMatricula($alunoId, $cursoId, $anoLetivo)) {
  pg_close(getDb());
  exit();
}

$query = "INSERT INTO matricula (alunoId, cursoId, dataMatricula, anoLetivo, pago)
          VALUES ('$alunoId', '$cursoId', '$dataMatricula', $anoLetivo, '$pago')";
$result = pg_query(getDb(), $query);

if (!$result) {
  $errorMessage = pg_last_error();

  echo "<div id='mensagem' class='erro'>
    <h3>Error with query:</h3> $errorMessage <br>
    <a href='index.php'><button type='button'>Voltar</a>";
    
  pg_close(getDb());
  exit();
}

function validaMatricula($aluno, $curso, $anoLetivo) {
  $query = "SELECT *
              FROM matricula
             WHERE alunoId=$aluno";
  $dbMatriculas = pg_exec(getDb(), $query);
  $numLinhas = pg_numrows($dbMatriculas);

  if ($numLinhas > 0) {
    for ($i = 0; $i < $numLinhas; $i++) {
      $linha = pg_fetch_array($dbMatriculas, $i);

      if ($linha['anoletivo'] == $anoLetivo && $linha['ativo'] == 1) {
        if ($linha['cursoid'] == $curso) {?>
          <div id="mensagem" class="erro">
            <h3>Aluno já matriculado neste curso no ano inserido.</h3>
            <a href='index.php'><button type="button">Voltar</a>
          </div> <?php
					return false;
        } else {
          $query = "SELECT *
                      FROM curso
                     WHERE id=$curso";
          $dbPeriodoCurso[0] = pg_exec(getDb(), $query);
          $dbPeriodoCurso[0] = pg_fetch_result($dbPeriodoCurso[0], 0, "periodo");

          $query = "SELECT *
                      FROM curso
                     WHERE id=".$linha['cursoid'];
          $dbPeriodoCurso[1] = pg_exec(getDb(), $query);
          $dbPeriodoCurso[1] = pg_fetch_result($dbPeriodoCurso[1], 0, "periodo");

          if ($dbPeriodoCurso[0] == $dbPeriodoCurso[1]) {?>
            <div id="mensagem" class="erro">
              <h3>Aluno já matriculado para esse período no ano inserido.</h3>
              <a href='index.php'><button type="button">Voltar</a>
            </div> <?php
						return false;
          }
        }
      }
    }
  }

  return true;
}

pg_close(getDb());

header("location:/?sucesso=1");

?>