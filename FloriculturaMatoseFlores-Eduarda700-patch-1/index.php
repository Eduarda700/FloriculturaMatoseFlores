<?php
include_once './conexao.php';
include_once './usuarioCliente.php';

session_start();

if (isset($_POST['usuario_cliente'])) {
    $usuario = $_POST['usuario_cliente'];
    $senha = $_POST['senha'];

    $consulta = mysqli_query($conn, "select idcliente, usuario_cliente, email, senha, telefone, endereco_cliente from usuario_cliente where usuario_cliente = '" . $usuario . "'");
    $dados = mysqli_fetch_assoc($consulta);
    $user = null;

    if ($dados != null){
        $user = new usuarioCliente($dados["idcliente"],$dados["usuario_cliente"],$dados["email"],$dados["senha"],$dados["telefone"],$dados["endereco_cliente"]);
    }


    if ($user != null && $user->validaUsuarioClienteSenha ($usuario,$senha)){
        $_SESSION['user']=$user;
    } 
        else {
        $_SESSION['msg'] = "Usuario ou senha incorretos !!";
       // echo $dados;
        header("Location: index.php");
        exit;
        }
}else if (!isset($_SESSION['user'])) {
        $_SESSION['msg']= "necessario logar antes de acessar a a pagina de home!!";
        header("Location: index.php");
        exit;
    }?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cliente</title>
</head>
<body>
    <h1> Tela de login do Sistema</h1>
    <form action="home.php" method="POST">
        <fieldset>
            <legend>Dados: </legend>
            <table> 
                <tbody>
                    <tr>
                        <td>Usuario:</td>
                        <td><input type="text" name="usuario_cliente"/></td>
                    </tr>
                    <tr>
                        <td>Senha:</td>
                        <td><input type="password" name="senha"/></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Entrar"/></td>
                    </tr>

                </tbody> 
 
            </table>
       </fieldset>
    </form>
</body>
</html>