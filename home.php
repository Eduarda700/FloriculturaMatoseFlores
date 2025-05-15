<?php
include_once './database.php';
include_once '/usuarioCliente.php';

seassion_start();
if (isset($_POST('usuario'))) {
    $usuario = $_POST['usuario'];
    $usuario = $_POST['senha'];

    $consulta = mysql_query($conexao, "select idcliente, usuario_cliente, email, senha, telefone, endereco_cliente from usuario_cliente where email = '" . $usuario . "'");
    $dados = mysqli_fetch_assoc($consulta);
    $user = null;
    if ($dados != null){
        $user = new usuarioCliente($dados["idcliente"],$dados["usuario_cliente"],$dados["email"],$dados["senha"],$dados["telefone"],$dados["endereco_cliente"]);

}

    if ($user != null && $user->validaUsuarioClienteSenha ($usuario,$senha)){
        $_SESSION['user']=$user;

    }else {
        $_SESSION['msg'] = "Usuario ou senha incorretos !!";
        header("Location: index.php");
        exit;
    }else if (!iseet($_SESSION['user'])) {
        $_SESSION['msg']= "necessario logar antes de acessar a apagina de menu!!";
        header("location: index.php");
        exit;
    }
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>user cliente logado</h1>
</body>
</html>