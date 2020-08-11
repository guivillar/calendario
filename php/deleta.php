<?php
  require "verifica.php";
  $pdo = new PDO('mysql:host=localhost;dbname=calendario','root','guilherme');
  $idUser = $_SESSION['id_usuario'];
  $sql_events = "SELECT id, nome FROM eventos WHERE id_user='$idUser'";
  $events = $pdo->query($sql_events);

  if(isset($_POST['deletarE'])){
    $idEvento = $_POST['eventoD'];
    $query = "DELETE FROM eventos WHERE id = '$idEvento'";
    if ($delete = $pdo->query($query)){
      echo"<script language='javascript' type='text/javascript'>alert('Evento apagado com sucesso!');window.location.href='../php/index.php'</script>";
    } else {
      echo"<script language='javascript' type='text/javascript'>alert('Não foi possível apagar o evento.  " . $pdo->errorInfo() . "');window.location.href='../php/index.php'</script>";
    }
  }
?>
<html>
    <head>
        <title>Calendario</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item" style="margin-right: 5%;">
                    <a href="../php/index.php" id="criar_btn" class="nav-link">Criar</a><span></span>
                </li>
                <li class="nav-item" style="margin-right: 5%;">
                    <a href="../php/edita.php" id="editar_btn" class="nav-link">Editar</a><span></span>
                </li>
                <li class="nav-item" style="margin-right: 5%;">
                    <a href="../php/deleta.php" id="apagar_btn" class="nav-link">Deletar</a><span></span>
                </li>
                <li class="nav-item" style="margin-right: 5%;">
                    <a href="../php/lista.php" id="listar_btn" class="nav-link">Listar</a>
                </li>
                </ul>
                <ul class="navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="../php/sair.php">Logout</a>
                </li>
                </ul>
            </div>
        </nav>
        <div id="apagar_evento" class="container-fluid col-md-4 rounded border divbox">
            <form class="form-singin" method="POST">
                <h1 class="h3 mb-3 font-weight-normal">Apagar Evento</h1>
                <select name="eventoD" class="btn btn-secondary dropdown-toggle">
                <?php foreach($events as $evento){
                    echo "<option value=$evento[id]>$evento[nome]</option>"; 
                } ?>
                </select><br><br>
                <button type="submit" id="deletar" name="deletarE" class="btn btn-lg btn-primary btn-block">Deletar</button><br>
            </form>
        </div>
    </body>
</html>
