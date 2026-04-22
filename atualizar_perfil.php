<?php
session_start();
include "conexao.php";

if (isset($_SESSION['id_usuario']) && $_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_SESSION['id_usuario'];
    
    // Recebendo todos os campos do formulário
    $nome     = $_POST['nome'];
    $email    = $_POST['email'];
    $cep      = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $cidade   = $_POST['cidade'];
    $estado   = $_POST['estado'];

    // SQL UPDATE com todos os campos novos
    $sql = "UPDATE usuario SET nome = ?, email = ?, cep = ?, endereco = ?, cidade = ?, estado = ? WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // "ssssssi" significa 6 strings e 1 inteiro (o ID)
        $stmt->bind_param("ssssssi", $nome, $email, $cep, $endereco, $cidade, $estado, $id);

        if ($stmt->execute()) {
            // Atualiza o nome na sessão caso ele tenha mudado o nome no perfil
            $_SESSION['nome'] = $nome;
            
            header("Location: ../perfil.php?sucesso=1");
            exit();
        } else {
            header("Location: ../perfil.php?erro=db_error");
            exit();
        }
        $stmt->close();
    }
} else {
    header("Location: ../login.php");
    exit();
}
$conn->close();

<!-- Acessibilidade: A+ A- -->
<div class="acessibilidade">
    <button onclick="aumentarFonte()" aria-label="Aumentar fonte">A+</button>
    <button onclick="diminuirFonte()" aria-label="Diminuir fonte">A-</button>
</div>

<script>
    let tamanhoFonte = 100;

    function aumentarFonte() {
        if (tamanhoFonte < 150) {
            tamanhoFonte += 10;
            document.body.style.fontSize = tamanhoFonte + "%";
        }
    }

    function diminuirFonte() {
        if (tamanhoFonte > 70) {
            tamanhoFonte -= 10;
            document.body.style.fontSize = tamanhoFonte + "%";
        }
    }
</script>

<?php include 'footer.php'; ?>

?>

