<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Votri CRUD</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  </head>

  <body>
    <!-- Carrega o jQuery -->
    <script src="https://code.jquery.com/jquery-2.1.3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

    <script>
      $(document).ready(function(){
        $(".moeda").maskMoney();
      });
    </script>
    
    <!-- Botões do menu -->
    <div class="menu">
      <button type="button" onclick="abrirTela('cadAluno')">Cadastrar Alunos</button>
      <button type="button" onclick="abrirTela('cadCurso')">Cadastrar Cursos</button>
      <button type="button" onclick="abrirTela('matAluno')">Matricular Alunos</button>
      <button type="button" onclick="document.location.href='filtroMatriculas.php'">Listar Matriculas</button>
    </div>

    <div id="mensagem" class="sucesso">
      <h3>Cadastro Efetuado com sucesso!</h3>
    </div>

    <?php
      if ($_GET["sucesso"] == "1")
        echo "<script>
          document.getElementById('mensagem').style.display = 'block';
        </script>";
    ?>

    <!-- Cadastro de Alunos -->
    <div id="cadAluno" class="form">
      <fieldset>
        <legend><h3>Cadastro de Alunos</h3></legend>
        <form action="cadAluno.php" method="post">
          Nome:
          <input id="nome" name="nome" type="text" required>

          Telefone:
          <input id="telefone" name="telefone" type="tel">

          Data de Nascimento:
          <input id="dataNasc" name="dataNasc" type="date" required>

          CPF:
          <input id="cpf" name="cpf" type="text" required>

          Registro Geral:
          <input id="rg" name="rg" type="text">

          <input type="submit">
          <input type="reset">
        </form>
      </fieldset>
    </div>

    <!-- Cadastro de Cursos -->
    <div id="cadCurso" class="form">
      <fieldset>
        <legend><h3>Cadastro de Cursos</h3></legend>
        <form action="cadCurso.php" method="post">
          Nome:
          <input id="nome" name="nome" type="text" required>

          Valor da Mensalidade:
          <input id="valorMensalidade" name="valorMensalidade" class="moeda" type="text" required>

          Valor da Matricula:
          <input id="valorMatricula" name="valorMatricula" class="moeda" type="text" required>

          Periodo:
          <select name="periodo">
            <option value="0">Matutino</option>
            <option value="1">Vespertino</option>
            <option value="2">Noturno</option>
          </select>

          Duração (Meses):
          <input id="duracao" name="duracao" type="number">

          <input type="submit">
          <input type="reset">
        </form>
      </fieldset>
    </div>

    <!-- Matricula de Alunos -->
    <div id="matAluno" class="form">
      <fieldset>
        <legend><h3>Matricula de Alunos</h3></legend>
        <form action="matAluno.php" method="post">
          ID do Aluno:
          <input id="alunoId" name="alunoId" type="number" required>

          ID do Curso:
          <input id="cursoId" name="cursoId" type="number" required>

          Data da Matricula:
          <input id="dataMatricula" name="dataMatricula" type="date">

          Ano Letivo:
          <input id="anoLetivo" name="anoLetivo" type="year" required>

          Pago:
          <select name="pago">
            <option value="0">Sim</option>
            <option value="1">Não</option>
          </select>

          <input type="submit">
          <input type="reset">
        </form>
      </fieldset>
    </div>

    <script>
      function abrirTela(tela) {
        var status = document.getElementById(tela).style.display;
        if (status == "block")
          status = "none";
        else
          status = "block";
        
        document.getElementById("cadAluno").style.display = "none";
        document.getElementById("cadCurso").style.display = "none";
        document.getElementById("matAluno").style.display = "none";
        document.getElementById("listaMatriculas").style.display = "none";
        document.getElementById("mensagem").style.display = "none";

        document.getElementById(tela).style.display = status;
      }
    </script>
  </body>
</html>