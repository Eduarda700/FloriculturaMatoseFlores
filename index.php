<?php
include_once 'conexao.php';
include_once 'usuarioCliente.php';

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email_cliente = $_POST['email_cliente'];
    $senha_cliente = $_POST['senha_cliente'];

    $usuario = mysqli_real_escape_string($conn, $email_cliente);

    $consulta = mysqli_query($conn, "SELECT * FROM usuario_cliente WHERE email_cliente = '$usuario'");

    $dados = mysqli_fetch_assoc($consulta);
    $user = null;


    if ($dados) {
        $user = new usuarioCliente($dados["idusuario_cliente"],$dados["nome_cliente"],$dados["senha_cliente"],$dados["email_cliente"],
        $dados["telefone_cliente"],$dados["cpf_cliente"],$dados["data_nascimento"],$dados["cep_cliente"],$dados["rua_cliente"],
        $dados["numero_cliente"],$dados["complemento_cliente"],$dados["bairro_cliente"],$dados["cidade_cliente"],$dados["estado_cliente"]);
        if ($user->validaUsuarioClienteSenha($email_cliente, $senha_cliente)) {
            $_SESSION["user"] = $user;
            header("Location: homeProprietaria.php");
            exit;
        }
    }

    $_SESSION['msg'] = 'Usuário ou senha incorretos';
    header("Location: index.php");
    exit;
}


    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cliente</title>
</head>
<body>
    <h1> Tela de login do Sistema</h1>
    <form action="index.php" method="POST">
        <fieldset>
            <legend>Dados: </legend>
            <table> 
                <tbody>
                    <tr>
                        <td>Usuario:</td>
                        <td><input type="text" name="email_cliente"/></td>
                    </tr>
                    <tr>
                        <td>Senha:</td>
                        <td><input type="text" name="senha_cliente"/></td>
                    </tr>
                  
                    <tr>

                     <td colspan="2"><input type="submit" value="Entrar"/></td>
                    </tr>

                </tbody> 
 
            </table>
       </fieldset>
    </form>
    <?php if (isset($_SESSION['msg'])): ?>
    <div class="alert alert-danger" style="margin-top:10px;">
      <?php 
        echo $_SESSION['msg']; 
        unset($_SESSION['msg']);
      ?>
    </div>
  <?php endif; ?>
  <tr>
                            <td colspan="2" style="text-align: center;">
                                <input type="submit" class="btn btn-primary" value="Entrar" style="margin-right: 10px;" />
                                <a href="cadastroCliente.php" class="btn btn-default" style="background-color: #D3D3D3; color: #9932CC;">
                                    Cadastrar novo usuário
                                </a>
                            </td>
</body>
</html>