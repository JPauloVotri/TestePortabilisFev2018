<link rel="stylesheet" type="text/css" href="css/style.css" />

<div class="form">
  <div><button class='voltar' type='button' onclick="document.location.href='/'">Voltar</div>
  <fieldset>
    <legend><h3>Listar Matriculas</h3></legend>
    <form action="listaMatriculas.php" method="get">
      Ano:
      <input id="ano" name="ano" type="number">
      Nome do Aluno:
      <input id="nome" name="nome" type="text">
      ID do Curso:
      <input id="cursoId" name="cursoId" type="number">
      Listar apenas matriculas com pagamento pendente?
      <select name="pagamento">
        <option value="" selected>Todas</option>
        <option value="1">Sim</option>
        <option value="0">Não</option>
      </select>
      Listar apenas matriculas ativas?
      <select name="ativas">
        <option value="1" selected>Sim</option>
        <option value="0">Não</option>
      </select>
      <input type="submit">
    </form>
  </fieldset>
</div>
