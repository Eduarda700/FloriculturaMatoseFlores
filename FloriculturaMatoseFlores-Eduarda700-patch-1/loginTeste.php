<?php
include_once 'conexao.php';
include_once 'usuarioCliente.php';
include_once 'usuarioFuncionario.php';
include_once 'usuarioProprietaria.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

    // ================== CLIENTE ====================
    $query = "SELECT * FROM usuario_cliente WHERE email_cliente = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $dados = mysqli_fetch_assoc($result);
        $user = new usuarioCliente(
            $dados["idusuario_cliente"], $dados["nome_cliente"], $dados["senha_cliente"], $dados["email_cliente"],
            $dados["telefone_cliente"], $dados["cpf_cliente"], $dados["data_nascimento"], $dados["cep_cliente"],
            $dados["rua_cliente"], $dados["numero_cliente"], $dados["complemento_cliente"],
            $dados["bairro_cliente"], $dados["cidade_cliente"], $dados["estado_cliente"]
        );
        if ($user->validaSenha($senha)) {
            $_SESSION["user"] = $user;
            $_SESSION["tipo"] = "cliente";
            header("Location: homeCliente.php");
            exit;
        } else {
            $_SESSION['msg'] = 'Senha incorreta';
            header("Location: index.php");
            exit;
        }
    }

    // ================== FUNCIONÁRIO ====================
    $query = "SELECT * FROM usuario_funcionario WHERE email_funcionario = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $dados = mysqli_fetch_assoc($result);
        $user = new usuarioFuncionario(
            $dados["idusuario_funcionario"], $dados["nome_funcionario"],
            $dados["email_funcionario"], $dados["senha_funcionario"]
        );
        if ($user->validaSenha($senha)) {
            $_SESSION["user"] = $user;
            $_SESSION["tipo"] = "funcionario";
            header("Location: homeFuncionario.php");
            exit;
        } else {
            $_SESSION['msg'] = 'Senha incorreta';
            header("Location: index.php");
            exit;
        }
    }

    // ================== PROPRIETÁRIA ====================
    $query = "SELECT * FROM usuario_proprietaria WHERE email_proprietaria = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $dados = mysqli_fetch_assoc($result);
        $user = new usuarioProprietaria(
            $dados["idusuario_proprietaria"], $dados["nome_proprietaria"],
            $dados["email_proprietaria"], $dados["senha_proprietaria"]
        );
        if ($user->validaSenha($senha)) {
            $_SESSION["user"] = $user;
            $_SESSION["tipo"] = "proprietaria";
            header("Location: homeProprietaria.php");
            exit;
        } else {
            $_SESSION['msg'] = 'Senha incorreta';
            header("Location: index.php");
            exit;
        }
    }

    // ================== NENHUM USUÁRIO ENCONTRADO ====================
    $_SESSION['msg'] = 'Usuário não encontrado';
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
                        <td><input type="text" name="email"/></td>
                    </tr>
                    <tr>
                        <td>Senha:</td>
                        <td><input type="text" name="senha"/></td>
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
</body>
</html>