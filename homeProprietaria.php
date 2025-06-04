<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Home Proprietário - Sistema Floricultura</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            background-color: #B0C4DE;
        }

        .navbar-brand {
            font-family: 'Italiana', serif;
            color: #9932CC !important;
            font-size: 24px;
        }

        .navbar .navbar-text {
            color: #fff !important;
        }

        .title-box {
            background-color: #9932CC;
            border-radius: 10px;
            padding: 15px;
            margin: 20px auto;
            text-align: center;
            max-width: 600px;
            color: white;
            font-family: 'Italiana', serif;
        }

        h2 {
            font-family: 'Italiana', serif;
            color: #210857;
            margin-left: 550px;
            margin-bottom: -20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#210857;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sistema Floricultura</a>
    <div class="navbar-text">
      Usuário Proprietário: <strong><?php echo $_SESSION['user']->nome_proprietaria ?? 'Proprietário'; ?></strong>
    </div>
  </div>
</nav>

<div class="container mt-4">

    <div class="title-box">
        <h1>Bem-vindo, Proprietário</h1>
    </div>

    <ul class="nav nav-tabs mb-3" style="max-width: 1000px; margin: auto;">
      <li class="nav-item" role="presentation">
        <a href="cadastroFuncionario.php" class="nav-link">Cadastro Funcionário</a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="listaFuncionario.php" class="nav-link">Lista Funcionários</a>
      </li>
      <li class="nav-item" role="presentation">
        <a href="listaFornecedores.php" class="nav-link">Lista Fornecedores</a>
      </li>
    </ul>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>