session_start();
include 'conexao.php';

if (isset($_POST['idfornecedor'])) {
    $id = intval($_POST['idfornecedor']);

    $stmt = $conn->prepare("DELETE FROM fornecedor WHERE idfornecedor = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['msg' => 'Fornecedor excluído com sucesso!']);
    } else {
        echo json_encode(['msg' => 'Erro ao excluir fornecedor.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['msg' => 'ID do fornecedor não fornecido.']);
}
?>
