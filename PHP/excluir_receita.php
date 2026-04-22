<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../perfil.php?erro=1");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$id_receita = (int) $_GET['id'];

// Buscar a receita e garantir que ela pertence ao usuário
$sql_receita = "SELECT foto FROM receitas WHERE id_receita = ? AND usuario_id = ?";
$stmt_receita = $conn->prepare($sql_receita);
$stmt_receita->bind_param("ii", $id_receita, $id_usuario);
$stmt_receita->execute();
$resultado_receita = $stmt_receita->get_result();

if ($resultado_receita->num_rows === 0) {
    header("Location: ../perfil.php?erro=1");
    exit();
}

$dados_receita = $resultado_receita->fetch_assoc();
$foto = $dados_receita['foto'];

// Excluir favoritos da receita
$sql_favoritos = "DELETE FROM favoritos WHERE receita_id = ?";
$stmt_favoritos = $conn->prepare($sql_favoritos);
$stmt_favoritos->bind_param("i", $id_receita);
$stmt_favoritos->execute();

// Excluir categorias vinculadas à receita
$sql_categorias = "DELETE FROM receita_categorias WHERE receita_id = ?";
$stmt_categorias = $conn->prepare($sql_categorias);
$stmt_categorias->bind_param("i", $id_receita);
$stmt_categorias->execute();

// Excluir comentários da receita
$sql_comentarios = "DELETE FROM comentarios WHERE receita_id = ?";
$stmt_comentarios = $conn->prepare($sql_comentarios);
$stmt_comentarios->bind_param("i", $id_receita);
$stmt_comentarios->execute();

// Excluir a receita
$sql_delete = "DELETE FROM receitas WHERE id_receita = ? AND usuario_id = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("ii", $id_receita, $id_usuario);

if ($stmt_delete->execute()) {
    $caminho_foto = "../IMAGES/receitas/" . $foto;

    if (!empty($foto) && $foto !== "default.jpg" && file_exists($caminho_foto)) {
        unlink($caminho_foto);
    }

    header("Location: ../perfil.php?receita_excluida=1");
    exit();
} else {
    header("Location: ../perfil.php?erro=1");
    exit();
}
?>