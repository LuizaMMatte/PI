<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id_usuario'])) {
    $id = $_SESSION['id_usuario'];

    // EXCLUIR PERFIL
    if (isset($_POST['acao']) && $_POST['acao'] === 'excluir') {

        // Buscar fotos das receitas do usuário
        $sql_fotos = "SELECT foto FROM receitas WHERE usuario_id = ?";
        $stmt_fotos = $conn->prepare($sql_fotos);
        $stmt_fotos->bind_param("i", $id);
        $stmt_fotos->execute();
        $resultado_fotos = $stmt_fotos->get_result();

        $fotos = [];
        while ($linha = $resultado_fotos->fetch_assoc()) {
            if (!empty($linha['foto'])) {
                $fotos[] = $linha['foto'];
            }
        }

        // Buscar ids das receitas do usuário
        $sql_ids = "SELECT id_receita FROM receitas WHERE usuario_id = ?";
        $stmt_ids = $conn->prepare($sql_ids);
        $stmt_ids->bind_param("i", $id);
        $stmt_ids->execute();
        $resultado_ids = $stmt_ids->get_result();

        $ids_receitas = [];
        while ($linha = $resultado_ids->fetch_assoc()) {
            $ids_receitas[] = $linha['id_receita'];
        }

        // Excluir favoritos ligados às receitas do usuário
        foreach ($ids_receitas as $id_receita) {
            $sql_del_fav_receita = "DELETE FROM favoritos WHERE receita_id = ?";
            $stmt_del_fav_receita = $conn->prepare($sql_del_fav_receita);
            $stmt_del_fav_receita->bind_param("i", $id_receita);
            $stmt_del_fav_receita->execute();

            $sql_del_cat = "DELETE FROM receita_categorias WHERE receita_id = ?";
            $stmt_del_cat = $conn->prepare($sql_del_cat);
            $stmt_del_cat->bind_param("i", $id_receita);
            $stmt_del_cat->execute();
        }

        // Excluir favoritos do próprio usuário
        $sql_favoritos_usuario = "DELETE FROM favoritos WHERE usuario_id = ?";
        $stmt_favoritos_usuario = $conn->prepare($sql_favoritos_usuario);
        $stmt_favoritos_usuario->bind_param("i", $id);
        $stmt_favoritos_usuario->execute();

        // Excluir comentários das receitas do usuário
        foreach ($ids_receitas as $id_receita) {
        $sql_coment = "DELETE FROM comentarios WHERE receita_id = ?";
        $stmt_coment = $conn->prepare($sql_coment);
        $stmt_coment->bind_param("i", $id_receita);
        $stmt_coment->execute();
        
}
// Excluir comentários do próprio usuário
$sql_coment_usuario = "DELETE FROM comentarios WHERE usuario_id = ?";
$stmt_coment_usuario = $conn->prepare($sql_coment_usuario);
$stmt_coment_usuario->bind_param("i", $id);
$stmt_coment_usuario->execute();


        // Excluir receitas do usuário
        $sql_receitas = "DELETE FROM receitas WHERE usuario_id = ?";
        $stmt_receitas = $conn->prepare($sql_receitas);
        $stmt_receitas->bind_param("i", $id);
        $stmt_receitas->execute();

        // Excluir usuário
        $sql_usuario = "DELETE FROM usuario WHERE id_usuario = ?";
        $stmt_usuario = $conn->prepare($sql_usuario);
        $stmt_usuario->bind_param("i", $id);

        if ($stmt_usuario->execute()) {
            foreach ($fotos as $foto) {
                $caminho = "../IMAGES/receitas/" . $foto;
                if (!empty($foto) && file_exists($caminho)) {
                    unlink($caminho);
                }
            }

            session_unset();
            session_destroy();

            header("Location: ../index.php");
            exit();
        } else {
            echo "Erro ao excluir perfil: " . $conn->error;
            exit();
        }
    }

    // ATUALIZAR PERFIL
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $cidade = $_POST['cidade'] ?? '';

    $sql = "UPDATE usuario SET nome = ?, email = ?, cep = ?, endereco = ?, cidade = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nome, $email, $cep, $endereco, $cidade, $id);

    if ($stmt->execute()) {
        $_SESSION['nome'] = $nome;
        header("Location: ../perfil.php?sucesso=1");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>