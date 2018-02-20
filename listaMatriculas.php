<link rel="stylesheet" type="text/css" href="css/style.css" />

<?php

include("dbConnect.php");

$ano = $_GET['ano'];
$nome = $_GET['nome'];
$cursoId = $_GET['cursoId'];
$pagamento = $_GET['pagamento'];
$ativo = $_GET['ativas'];

$ano = ($ano != '') ? " AND mat.anoletivo = $ano" : '';
$nome = ($nome != '') ? " AND alu.nome LIKE '%$nome%'" : '';
$cursoId = ($cursoId != '') ? " AND mat.cursoid = $cursoId" : '';
$pagamento = ($pagamento != '') ? " AND mat.pago = $pagamento" : '';
$ativo = ($ativo != '') ? " AND mat.ativo = $ativo" : '';

$filtro = "$ano $nome $cursoId $pagamento $ativo";

?>

<div class="form">
  <div><button class='voltar' type='button' onclick="document.location.href='/'">Voltar</div>
  <fieldset>
    <legend><h3>Listagem de Matriculas</h3></legend>
    <table id="tabelaMatriculas">
      <tr>
        <th onclick="sorteiaLista(0)">ID da Matrícula</th>
        <th onclick="sorteiaLista(1)">Aluno (ID)</th>
        <th onclick="sorteiaLista(2)">Curso (ID)</th>
        <th onclick="sorteiaLista(3)">Data da Matrícula</th>
        <th onclick="sorteiaLista(4)">Ano</th>
        <th onclick="sorteiaLista(5)">Pago?</th>
      </tr>

<?php

$query = "SELECT mat.id,
                 mat.alunoid,
                 mat.cursoid,
                 mat.datamatricula,
                 mat.anoletivo,
                 mat.pago,
                 alu.nome
            FROM matricula AS mat,
                 aluno AS alu 
           WHERE mat.alunoid = alu.id $filtro
           ORDER BY mat.id";
$result = pg_exec(getDb(), $query);
$numLinhas = pg_numrows($result);

for ($i = 0; $i < $numLinhas; $i++) {
  $linha = pg_fetch_array($result, $i);

  $query = "SELECT nome FROM aluno WHERE id = ".$linha['alunoid'];
  $aluno = pg_exec(getDb(), $query);

  $query = "SELECT nome FROM curso WHERE id = ".$linha['cursoid'];
  $curso = pg_exec(getDb(), $query);

	$aluno = pg_fetch_result($aluno, 0, 'nome');
	$curso = pg_fetch_result($curso, 0, 'nome');

  echo "<tr onclick='location.href = \"matricula.php?matricula=".$linha['id']."\"'>
          <td>".$linha['id']."</td>
          <td>$aluno (".$linha['alunoid'].")</td>
          <td>$curso (".$linha['cursoid'].")</td>
          <td>".$linha['datamatricula']."</td>
          <td>".$linha['anoletivo']."</td>
          <td>".(($linha['pago'] == 1) ? 'Sim' : 'Não')."</td>
        </tr>";
}

pg_close(getDb());

?>

    </table>
  </fieldset>
</div>

<script>
  function sorteiaLista(campo) {
    var tabela, linhas, trocando, i, x, y, deveMudar, direcao, contagemTroca = 0;
    tabela = document.getElementById("tabelaMatriculas");
    trocando = true;
    
    direcao = "asc"; 
    
    while (trocando) {
      trocando = false;
      linhas = tabela.getElementsByTagName("TR");
      
      for (i = 1; i < (linhas.length - 1); i++) {
        deveMudar = false;
        
        x = linhas[i].getElementsByTagName("TD")[campo];
        y = linhas[i + 1].getElementsByTagName("TD")[campo];
        
        if (direcao == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            deveMudar = true;
            break;
          }
        } else if (direcao == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            deveMudar = true;
            break;
          }
        }
      }
      if (deveMudar) {
        linhas[i].parentNode.insertBefore(linhas[i + 1], linhas[i]);
        trocando = true;
        
        contagemTroca ++;      
      } else {
        if (contagemTroca == 0 && direcao == "asc") {
          direcao = "desc";
          trocando = true;
        }
      }
    }
  }

  function acessaMatricula(matriculaId){

  }
</script>