<?php
include_once './conexao.php';

if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];

    $rua = $_POST['endereco'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'] ?? null;
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $cep = $_POST['cep'];

    if ($senha === $confirmar_senha) {
        $sql = "INSERT INTO usuario_cliente 
                (nome_cliente, senha_cliente, email_cliente, telefone_cliente, cpf_cliente, data_nascimento, cep_cliente, rua_cliente, numero_cliente, complemento_cliente, bairro_cliente, cidade_cliente, estado_cliente)
                VALUES 
                ('$nome', '$senha', '$email', '$telefone', '$cpf', '$data_nascimento', '$cep', '$rua', '$numero', '$complemento', '$bairro', '$cidade', '$estado')";

        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success text-center'>Cadastro realizado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Erro ao cadastrar: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>As senhas não coincidem.</div>";
    }
}
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Matos & Flores</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poetsen One', sans-serif;
        }

        body {
            background-color: #f8f3ff;
            color: #3e206d;
            padding: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: #f6efff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(62, 32, 109, 0.1);
        }

        h2 {
            font-family: 'Italiana';
            font-size: 40px;
            color: #210857;
            margin-left: 370px;
            margin-bottom: 20px;
        }

        .form-group {
            font-family: 'Italiana';
            color: #210857;
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], input[type="password"], input[type="email"], input[type="date"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background-color: #e6d9fa;
        }

        .row {
            display: flex;
            gap: 10px;
        }

        .row .form-group {
            flex: 1;
        }

        .btn {
            background-color: #7851a9;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 20px auto;
        }

        .btn:hover {
            background-color: #6b469a;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .footer a {
            color: #7851a9;
            text-decoration: none;
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo img {
            height: 100px;
        }
    </style>
</head>
<body>
    <div class="logo">
            <img src="logo.png" alt="Logo Matos & Flores">
        </div>
        <h2>Cadastre-se</h2>

        <?php if (!empty($mensagem)): ?>
            <div style="text-align:center; color: <?= $tipoMensagem === 'success' ? 'green' : 'red' ?>; margin-bottom: 20px;">
                <?= $mensagem ?>
            </div>
        <?php endif; ?>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" required>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" placeholder="(00) 1234-5678">
                </div>
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" name="data_nascimento">
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" required>
                </div>
                <div class="form-group">
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <input type="password" name="confirmar_senha" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" placeholder="123.456.789-00">
                </div>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco">
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="numero">Número</label>
                    <input type="text" name="numero">
                </div>
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro">
                </div>
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep">
                </div>
                <div class="row">
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" required>
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" required>
                 </div>
                <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input type="text" name="complemento">
                </div>
</div>
            </div>
            <button type="submit" class="btn">Cadastrar</button>
        </form>
        <div class="footer">
            Já possui cadastro? <a href="index.php">Faça login</a>
        </div>
    </div>
</body>
</html>