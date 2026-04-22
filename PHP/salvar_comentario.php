<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id_usuario'])) {
    $usuario_id = $_SESSION['id_usuario'];
    $receita_id = (int) ($_POST['receita_id'] ?? 0);
    $comentario = trim($_POST['comentario'] ?? '');
    $data_comentario = date("Y-m-d");

    if ($receita_id <= 0 || empty($comentario)) {
        header("Location: ../ver_receita.php?id=$receita_id&erro_comentario=1");
        exit();
    }

    $sql = "INSERT INTO comentarios (usuario_id, receita_id, comentario, criado_em) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $usuario_id, $receita_id, $comentario, $data_comentario);

    if ($stmt->execute()) {
        header("Location: ../ver_receita.php?id=$receita_id&comentario_sucesso=1");
        exit();
    } else {
        header("Location: ../ver_receita.php?id=$receita_id&erro_comentario=1");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>