<?php

  session_start();

  $login = $_POST['login'];
  $entrar = $_POST['entrar'];
  $senha = md5($_POST['senha']);
  $connect = mysqli_connect('localhost:3306','root','guilherme','calendario');
  if(!$login || !$senha)
  {
    echo"<script language='javascript' type='text/javascript'> alert('Você deve digitar sua senha e login!');window.location.href='../html/login.html';</script>";
    exit;
  }
  if (isset($entrar)) {
    $select = "SELECT ID, login, senha FROM usuarios WHERE login ='$login' AND senha = '$senha'";
    $verifica = $connect->query($select) or die("erro ao selecionar");
    $dados = mysqli_fetch_array($verifica);
    if (mysqli_num_rows($verifica)<=0){
      echo"<script language='javascript' type='text/javascript'> alert('Login e/ou senha incorretos');window.location.href='../html/login.html';</script>";
      die();
    }else{
      $_SESSION["id_usuario"]= $dados['ID'];
      $_SESSION["nome_usuario"] = $dados['login'];
      header("Location: index.php");
    }
  }
?>
