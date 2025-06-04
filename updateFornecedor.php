<?php
include_once './conexao.php';
session_start();

if (!isset($_SESSION['user'])){
    $_SESSION['msg'] = "É necessário logar antes de acessar a página de menu!!";
    header("Location: index.login.php");
    exit;   
}

header('Content-type: application/json');

if (
    isset($_POST['idfornecedor']) && isset($_POST['fornecedor']) && isset($_POST['email']) &&
    isset($_POST['telefone']) && isset($_POST['cnpj_fornecedor']) && isset($_POST['cidade_fornecedor']) &&
    isset($_POST['estado_fornecedor']) && isset($_POST['rua_fornecedor']) && isset($_POST['numero_fornecedor']) &&
    isset($_POST['complemento_fornecedor']) && isset($_POST['bairro_fornecedor']) && isset($_POST['cep_cliente'])
) {
    $id = intval($_POST['idfornecedor']);
    $fornecedor = $conn->real_escape_string($_POST['fornecedor']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    $cnpj = $conn->real_escape_string($_POST['cnpj_fornecedor']);
    $cidade = $conn->real_escape_string($_POST['cidade_fornecedor']);
    $estado = $conn->real_escape_string($_POST['estado_fornecedor']);
    $rua = $conn->real_escape_string($_POST['rua_fornecedor']);
    $numero = $conn->real_escape_string($_POST['numero_fornecedor']);
    $complemento = $conn->real_escape_string($_POST['complemento_fornecedor']);
    $bairro = $conn->real_escape_string($_POST['bairro_fornecedor']);
    $cep = $conn->real_escape_string($_POST['cep_cliente']);

    $stmt = $conn->prepare("UPDATE fornecedor SET fornecedor = ?, email = ?, telefone = ?, cnpj_fornecedor = ?, cidade_fornecedor = ?, estado_fornecedor = ?, rua_fornecedor = ?, numero_fornecedor = ?, complemento_fornecedor = ?, bairro_fornecedor = ?, cep_cliente = ? WHERE idfornecedor = ?");
    $stmt->bind_param("sssssssssssi", $fornecedor, $email, $telefone, $cnpj, $cidade, $estado, $rua, $numero, $complemento, $bairro, $cep, $id);

    if ($stmt->execute()) {
        $msg = "Fornecedor atualizado com sucesso!";
    } else {
        $msg = "Erro ao atualizar fornecedor: " . $stmt->error;
    }

    $stmt->close();
} else {
    $msg = "Erro: Dados insuficientes para atualizar o fornecedor.";
}

$conn->close();

echo json_encode(['msg' => $msg]);
?>