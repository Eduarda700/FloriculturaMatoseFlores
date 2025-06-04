<?php
include_once './conexao.php';
include_once './usuarioFuncionario.php';

if (isset($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $query = "INSERT INTO usuario_funcionario (usuario, senha) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $usuario, $senha);

    if (mysqli_stmt_execute($stmt)) {
        $mensagem = "Funcionário cadastrado com sucesso!";
        $tipoMensagem = "success";
    } else {
        $mensagem = "Erro ao cadastrar funcionário.";
        $tipoMensagem = "danger";
    }
}
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3e8ff;
            font-family: 'Italiana';
            color: #210857;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 40px;
            margin-top: 50px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo img {
            height: 100px;
        }

        h2 {
            font-family: 'Italiana';
            font-size: 30px;
            color: #210857;
            margin-left: 550px;
            margin-bottom: -20px;
        }

        label {
            color: #3c1361;
            margin-bottom: 5px;
            font-size: 16px;
        }

        input.form-control {
            background-color: #f1e4ff;
            border: 1px solid #d3bdf0;
            border-radius: 10px;
            height: 45px;
            font-size: 15px;
        }

        .btn-custom {
            background-color: #7b2cbf;
            color: white;
            border-radius: 10px;
            padding: 10px 30px;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-custom:hover {
            background-color: #5a189a;
        }

        .footer-text {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
        }

        .footer-text a {
            color: #210857;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

 <div class="logo">
    <img src="logo.png" alt="Logo Matos & Flores">
 </div>
 <h2>Cadastro de Funcionário</h2>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">

                    <?php if (!empty($mensagem)): ?>
                        <div class="alert alert-<?php echo $tipoMensagem; ?> text-center" role="alert">
                            <?php echo $mensagem; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Nome de Usuário</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" id="senha" name="senha" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-custom">Cadastrar</button>
                        </div>
                    </form>

                    <div class="footer-text">
                        <p>Já concluíu os cadastros? <a href="homeProprietaria.php">Volte para home</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>