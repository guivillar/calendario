<?php
require "verifica.php";
$pdo = new PDO('mysql:host=localhost;dbname=calendario','root','guilherme');
$connect = mysqli_connect('localhost:3306','root','guilherme','calendario');
$idUser = $_SESSION['id_usuario'];
$sql_events = "SELECT id, nome FROM eventos WHERE id_user='$idUser'";
$events = $pdo->query($sql_events);
if(isset($_POST['editarE'])){
    $nome = $_POST['nomeEE'];
    $descricao = $_POST['descricaoEE'];
    $dataInicio = $_POST['dataIEE'];
    $dataTermino = $_POST['dataTEE'];
    $horaInicio = $_POST['horaIEE'];
    $horaTermino = $_POST['horaTEE'];
    $idEvento = $_POST['idEE'];
    $query = "UPDATE eventos SET nome = '$nome', data_inicio = '$dataInicio', data_termino = '$dataTermino', hora_inicio = '$horaInicio', hora_termino = '$horaTermino', descricao = '$descricao' WHERE id = $idEvento";
    $edit = $connect->query($query);
    if (isset($edit)){
      echo"<script language='javascript' type='text/javascript'>alert('Evento editado com sucesso!');window.location.href='../php/edita.php'</script>";
    } else {
      echo"<script language='javascript' type='text/javascript'>alert('Não foi possível editar o evento.  " . $connect->error . "');window.location.href='../php/edita.php'</script>";
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
        <div id="editar_evento" class="container-fluid col-md-4 rounded border divbox">
            <form class="form-singin" method="POST" action="">
            <h1 class="h3 mb-3 font-weight-normal">Editar Evento <?php echo $idEvento; ?></h1>
            <select name="eventoE" class="btn btn-secondary dropdown-toggle">
                <?php foreach($events as $evento){
                echo "<option value=$evento[id]>$evento[nome]</option>"; 
                } ?>
            </select><br><br>
            <button type="submit" id="selecionarE" name="selecionarE" class="btn btn-primary btn-block">Selecionar</button><br><br>
            </form>
            <?php 
            if(isset($_POST['selecionarE'])){
                $idEvento = $_POST['eventoE'];
                $query = "SELECT * FROM eventos WHERE id = $idEvento";
                $list = $pdo->prepare($query);
                $list->execute();
                while($result = $list->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form class="form-singin" method="POST">
            <input type="text" name="nomeEE" id="nomeEE" class="form-control" placeholder="Nome do Evento" style="background-color: #eee;" value="<?php echo $result['nome']; ?>"><br>
            <textarea type="text" name="descricaoEE" id="descricaoEE" class="form-control" placeholder="Descrição" style="background-color: #eee;"><?php echo $result['descricao']; ?></textarea><br>
            <input type="date" name="dataIEE" id="dataIEE" class="form-control" style="background-color: #eee;" value="<?php echo $result['data_inicio']; ?>"><br>
            <input type="date" name="dataTEE" id="dataTEE" class="form-control" style="background-color: #eee;" value="<?php echo $result['data_termino']; ?>"><br>
            <input type="time" name="horaIEE" id="horaIEE" class="form-control" style="background-color: #eee;" value="<?php echo $result['hora_inicio']; ?>"><br>
            <input type="time" name="horaTEE" id="horaTEE" class="form-control" style="background-color: #eee;" value="<?php echo $result['hora_termino']; ?>"><br>
            <input type="text" name="idEE" id="idEE" value="<?php echo $idEvento; ?>" readonly style="display: none;"><br><br>
            <button type="submit" id="editar" name="editarE" class="btn btn-lg btn-primary btn-block">Editar</button><br>
            </form>
            <?php
                }
            }
            ?>
        </div>
    </body>
</html>
    