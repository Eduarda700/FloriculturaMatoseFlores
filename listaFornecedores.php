<?php
session_start();
include_once './conexao.php';
include_once './usuarioProprietaria.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario_proprietaria WHERE email_proprietaria = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    if ($dados) {
        $proprietaria = new UsuarioProprietaria(
            $dados['idusuario_proprietaria'],
            $dados['nome_proprietaria'],
            $dados['email_proprietaria'],
            $dados['senha_proprietaria']
        );

        if ($proprietaria->validaUsuarioSenha($email, $senha)) {
            $_SESSION['proprietaria'] = $proprietaria;
            header("Location: painelProprietaria.php");
            exit;
        }
    }

    $_SESSION['msg'] = "Email ou senha incorretos!";
    header("Location: index.loginProprietaria.php");
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Fornecedores</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="javascriptFornecedor.js"></script>
    <style>
        .navbar-brand { font-family: 'Poetsen One', sans-serif !important; color: #9932CC !important; font-size: 24px; }
        body { background-color: #B0C4DE; }
        .navbar-inverse { background-color: #222; border-color: #080808; }
        .navbar-inverse .navbar-header, .navbar-inverse .navbar-nav > li > a { color: white; }
        .page-title-box { background-color: #9932CC; padding: 15px; border-radius: 10px; margin-bottom: 20px; text-align: center; }
        .page-title-box h2 { color: white; margin: 0; }
        .navbar .navbar-text { color: white !important; float: right; }
        .btn-success, .btn-primary { background-color: #9932CC; border-color: #7a29a4; }
        .btn-success:hover, .btn-primary:hover { background-color: #7a29a4; }
        .modal-header { background-color: #9932CC; color: white; }
        .table-bordered > thead > tr { background-color: #9932CC; color: white; }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Sistema Floricultura</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="homeProprietaria.php?classe=Fornecedor">Início</a></li>
            <li><a href="logout.php?classe=logout">Sair</a></li>
        </ul>
        <span class="navbar-text">Usuário logado: <?php echo $_SESSION['user']->nome; ?></span>
    </div>
</nav>
<div class="container">
    <div class="page-title-box">
        <h2>Fornecedores Cadastrados</h2>
    </div>
    <div class="input-group" style="margin-bottom: 20px; max-width: 400px;">
        <input type="text" class="form-control" id="filtro" placeholder="Buscar fornecedor">
        <div class="input-group-btn">
            <button type="button" class="btn btn-primary" id="btFiltro">Buscar</button>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fornecedor</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>CNPJ</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="fornecedores-tbody"></tbody>
    </table>
    <ul id="pagination" class="pagination-sm"></ul>
    <div class="text-right" style="margin-bottom: 20px;">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">Adicionar Fornecedor</button>
    </div>
    <div class="modal fade" id="create-item" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    <h4 class="modal-title">Cadastrar Fornecedor</h4>
                </div>
                <div class="modal-body">
                    <form id="form-cadastro">
                        <div class="form-group"><label for="fornecedor">Nome:</label><input type="text" class="form-control" name="fornecedor" required></div>
                        <div class="form-group"><label for="email_fornecedor">Email (fornecedor):</label><input type="email" class="form-control" name="email_fornecedor" required></div>
                        <div class="form-group"><label for="telefone">Telefone:</label><input type="text" class="form-control" name="telefone" required></div>
                        <div class="form-group"><label for="cnpj_fornecedor">CNPJ:</label><input type="text" class="form-control" name="cnpj_fornecedor" required></div>
                        <div class="form-group"><label for="rua_fornecedor">Rua:</label><input type="text" class="form-control" name="rua_fornecedor" required></div>
                        <div class="form-group"><label for="numero_fornecedor">Número:</label><input type="text" class="form-control" name="numero_fornecedor" required></div>
                        <div class="form-group"><label for="complemento_fornecedor">Complemento:</label><input type="text" class="form-control" name="complemento_fornecedor"></div>
                        <div class="form-group"><label for="bairro_fornecedor">Bairro:</label><input type="text" class="form-control" name="bairro_fornecedor" required></div>
                        <div class="form-group"><label for="cidade_fornecedor">Cidade:</label><input type="text" class="form-control" name="cidade_fornecedor" required></div>
                        <div class="form-group"><label for="estado_fornecedor">Estado:</label><input type="text" class="form-control" name="estado_fornecedor" required></div>
                        <div class="form-group"><label for="cep_cliente">CEP:</label><input type="text" class="form-control" name="cep_cliente" required></div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>