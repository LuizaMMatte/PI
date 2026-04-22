<?php
session_start();
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id_usuario'])) {
    
    $usuario_id = $_SESSION['id_usuario'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $historia = $_POST['historia'];

    $tempo = (int)$_POST['tempo_preparo']; 
    $porcoes = (int)$_POST['porcoes'];
    $id_categoria = (int)$_POST['id_categoria'];
    



    $nome_foto = "default.jpg";
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $nome_foto = uniqid() . "." . $extensao;
        

        if (!is_dir("../IMAGES/receitas/")) {
            mkdir("../IMAGES/receitas/", 0777, true);
        }
        
        move_uploaded_file($_FILES['foto']['tmp_name'], "../IMAGES/receitas/" . $nome_foto);
    }


    $sql = "INSERT INTO receitas (usuario_id, titulo, descricao, historia, tempo_preparo, porcoes, cadastrada_em, foto) 
            VALUES (?, ?, ?, ?, ?, ?, CURDATE(), ?)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("isssiis", $usuario_id, $titulo, $descricao, $historia, $tempo, $porcoes, $nome_foto);

    if ($stmt->execute()) {
        $id_receita_nova = $conn->insert_id;


        $sql_cat = "INSERT INTO receita_categorias (receita_id, categoria_id) VALUES (?, ?)";
        $stmt_cat = $conn->prepare($sql_cat);
        $stmt_cat->bind_param("ii", $id_receita_nova, $id_categoria);
        $stmt_cat->execute();

        header("Location: ../perfil.php?sucesso_receita=1");
        exit();
    } else {
        echo "Erro ao salvar na tabela receitas: " . $stmt->error;
    }
}
?>