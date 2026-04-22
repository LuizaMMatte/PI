<?php
session_start();
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ---------------------------------------------------------
    // CENÁRIO 1: CADASTRO (Se enviou o campo 'nome')
    // ---------------------------------------------------------
    if (isset($_POST['nome']) && !empty($_POST['nome'])) {
        
        $nome     = $_POST['nome'];
        $email    = $_POST['email'];
        $senha    = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $data     = date("Y-m-d");
        $endereco = $_POST['endereco'] ?? ''; 
        $cidade   = $_POST['cidade'] ?? '';
        $cep      = $_POST['cep'] ?? '';

        $stmt = $conn->prepare("INSERT INTO usuario (nome, email, senha, criado_em, endereco, cidade, cep) VALUES (?, ?, ?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("sssssss", $nome, $email, $senha, $data, $endereco, $cidade, $cep);

            if ($stmt->execute()) {
                $_SESSION['id_usuario'] = $conn->insert_id; 
                $_SESSION['nome']       = $nome;

                header("Location: ../index.php"); 
                exit;
            } else {
                header("Location: ../cadastro.php?erro=cadastro_falhou");
                exit;
            }
            $stmt->close();
        }

    // ---------------------------------------------------------
    // CENÁRIO 2: LOGIN (Se enviou email e senha, mas sem nome)
    // ---------------------------------------------------------
    } elseif (isset($_POST['email']) && isset($_POST['senha'])) {

        // validação dos termos
        if (!isset($_POST['termos'])) {
            header("Location: ../login.php?erro=termos_nao_aceitos");
            exit;
        }

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT id_usuario, nome, senha FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $usuario = $result->fetch_assoc();

                if (password_verify($senha, $usuario['senha'])) {
                    $_SESSION['id_usuario'] = $usuario['id_usuario'];
                    $_SESSION['nome']       = $usuario['nome'];
                    
                    header("Location: ../index.php");
                    exit;
                } else {
                    header("Location: ../login.php?erro=senha_invalida");
                    exit;
                }
            } else {
                header("Location: ../login.php?erro=email_nao_found");
                exit;
            }
            $stmt->close();
        }
    }
}
$conn->close();
?>