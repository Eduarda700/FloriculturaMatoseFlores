<?php
include_once 'conexao.php';
include_once 'usuario.php';
session_start();

// Se já estiver logado, redireciona para home
if (isset($_SESSION['user'])) {
    header("Location: home.php");
    exit;
}

// Processo de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['email'];
    $senha = $_POST['senha'];

    $consulta = mysqli_query($conn, "SELECT idcliente, usuario_cliente, email, senha, telefone FROM usuario_cliente WHERE usuario_cliente = '".mysqli_real_escape_string($conn, $usuario)."'");
    $dados = mysqli_fetch_assoc($consulta);

    if ($dados) {
        $user = new usuario($dados["idcliente"], $dados["usuario_cliente"], $dados["email"], $dados["senha"], $dados["telefone"]);
        if ($user->validaUsuarioSenha($usuario, $senha)) {
            $_SESSION["user"] = $user;
            header("Location: home.php");
            exit;
        }
    }

    $_SESSION['msg'] = 'Usuário ou senha incorretos';
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2>Login</h2>
  <form method="POST" action="index.php">
    <div class="form-group">
      <label for="usuario">Usuário:</label>
      <input type="text" name="usuario" class="form-control" required>
    </div>
    <div class="form-group">
      <label for="senha">Senha:</label>
      <input type="password" name="senha" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Entrar</button>
  </form>

  <?php if (isset($_SESSION['msg'])): ?>
    <div class="alert alert-danger" style="margin-top:10px;">
      <?php 
        echo $_SESSION['msg']; 
        unset($_SESSION['msg']);
      ?>
    </div>
  <?php endif; ?>
</div>
</body>
</html>