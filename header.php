<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/header.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/estilo.css">
    <script src="_js/favoritar.js"></script>
    <title>Receitas Afetivas</title>
</head>
<body>

<header class="custom-header">
    <nav class="navbar navbar-expand-lg w-100">
        <div class="container-fluid d-flex align-items-center">
            
            <div class="collapse navbar-collapse flex-grow-1" id="navbarNav" style="flex-basis: 0;">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="proposta.php">Nossa proposta</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Receitas
                        </a>
                        <ul class="dropdown-menu" style="background-color: #F15E66; border: none;">
                            <li><a class="dropdown-item" href="cafedamanha.php">Café da Manhã</a></li>
                            <li><hr class="dropdown-divider" style="border-top: 1px solid rgba(255,255,255,0.2);"></li>
                            <li><a class="dropdown-item" href="almoco.php">Almoço</a></li>
                            <li><hr class="dropdown-divider" style="border-top: 1px solid rgba(255,255,255,0.2);"></li>
                            <li><a class="dropdown-item" href="lanche.php">Lanche</a></li>
                            <li><hr class="dropdown-divider" style="border-top: 1px solid rgba(255,255,255,0.2);"></li>
                            <li><a class="dropdown-item" href="jantar.php">Jantar</a></li>
                        </ul>
                    </li>
                    <?php if (!isset($_SESSION['id_usuario'])): ?>
                        <li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastre-se</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="logo-container d-flex justify-content-center" style="flex-grow: 0;">
                <a href="index.php">
                    <img src="IMAGES/Logo-ReceitasAfetivas-02.png" width="140" height="100" alt="Logo">
                </a>
            </div>

            <div class="d-flex align-items-center justify-content-end flex-grow-1" style="flex-basis: 0;">
                <div class="auth-section me-3">
                    <?php if (isset($_SESSION['id_usuario'])): ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #F15E66;">
                                Olá, <?php echo explode(' ', $_SESSION['nome'])[0]; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" style="background-color: #F15E66; border: none;">
                                <li><a class="dropdown-item" href="perfil.php">Meu Perfil</a></li>
                                <li><hr class="dropdown-divider" style="border-top: 1px solid rgba(255,255,255,0.2);"></li>
                                <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-link text-decoration-none" style="color: #F15E66;">Login</a>
                    <?php endif; ?>
                </div>

                <form class="d-flex pesquisar-form" action="pesquisa.php" method="GET">
                    <input 
                        class="form-control me-2" 
                        type="search" 
                        name="busca"
                        placeholder="Pesquisar"
                        value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>"
                        style="max-width: 150px;"
                    >
                    <button class="btn btn-danger" type="submit" style="background-color: #F15E66; border: none;">❤︎⁠</button>
                </form>
            </div>

            <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</header>