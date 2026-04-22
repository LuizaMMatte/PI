<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'conexao.php';

// Define o cabeçalho como JSON para o JavaScript ler corretamente
header('Content-Type: application/json');

// 1. Verifica se o utilizador está logado
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['status' => 'error', 'message' => 'Precisas de fazer login para favoritar!']);
    exit;
}


if (isset($_GET['id'])) {
    $usuario_id = $_SESSION['id_usuario'];
    $receita_id = intval($_GET['id']);

    // 3. Verifica se a receita já foi favoritada antes (para não duplicar)
    $check_sql = "SELECT id_favorito FROM favoritos WHERE usuario_id = ? AND receita_id = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("ii", $usuario_id, $receita_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Se já existe, vamos "desfavoritar" (remover dos favoritos)
        $del_sql = "DELETE FROM favoritos WHERE usuario_id = ? AND receita_id = ?";
        $stmt_del = $conn->prepare($del_sql);
        $stmt_del->bind_param("ii", $usuario_id, $receita_id);
        
        if ($stmt_del->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Removida dos favoritos!']);
        }
    } else {
        // 4. Se não existe, insere nos favoritos
        $ins_sql = "INSERT INTO favoritos (usuario_id, receita_id) VALUES (?, ?)";
        $stmt_ins = $conn->prepare($ins_sql);
        $stmt_ins->bind_param("ii", $usuario_id, $receita_id);

        if ($stmt_ins->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Receita favoritada com sucesso!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar favorito.']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID da receita não fornecido.']);
}
?>