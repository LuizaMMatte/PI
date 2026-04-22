<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Receitas Afetivas</title>
    
    <link rel="stylesheet" type="text/css" href="CSS/estilo.css">
</head>
<body>

    <main>
        <?php if (isset($_GET['erro'])): ?>
            <div style="background-color: #F15E66; color: #ffffff; padding: 12px; margin: 20px auto; border-radius: 5px; text-align: center; border: 1px solid #f5c6cb; max-width: 400px; font-weight: bold;">
                <?php 
                    if ($_GET['erro'] == "email_nao_found") {
                        echo "E-mail não encontrado!";
                    } elseif ($_GET['erro'] == "senha_invalida") {
                        echo "Senha incorreta! Tente novamente.";
                    } elseif ($_GET['erro'] == "cadastro_falhou") {
                        echo "Erro ao realizar cadastro.";
                    } elseif ($_GET['erro'] == "termos_nao_aceitos") {
                        echo "Você precisa aceitar os Termos e Políticas.";
                    }
                ?>
            </div>
        <?php endif; ?>
        <form action="PHP/processar.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">Não iremos compartilhar o seu e-mail.</div>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" name="senha" class="form-control" id="senha" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="termos" required>
                <label class="form-check-label" for="exampleCheck1">
                    <a href="termos.php">Aceito os Termos e Políticas</a>
                </label>
            </div>

            <button class="btn btn-white text-white" type="submit" style="background-color: #F15E66;">Login</button>
        </form>
    </main>

    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
</script>
<?php include 'footer.php'; ?>