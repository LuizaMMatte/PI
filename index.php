<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once 'header.php';
include_once 'PHP/conexao.php';

$id_usuario = $_SESSION['id_usuario'] ?? 0;

$sql = "SELECT r.*, u.nome AS autor, c.nome_categoria,
        f.id_favorito
        FROM receitas r
        JOIN usuario u ON r.usuario_id = u.id_usuario
        LEFT JOIN receita_categorias rc ON r.id_receita = rc.receita_id
        LEFT JOIN categorias c ON rc.categoria_id = c.id_categoria
        LEFT JOIN favoritos f 
            ON r.id_receita = f.receita_id 
            AND f.usuario_id = ?
        ORDER BY r.cadastrada_em DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$receitas = $stmt->get_result();
?>



<style>
    .welcome-bar {
        padding: 20px 0;
        text-align: center;
        background-color: #fdfdfd;
        border-bottom: 1px solid #eee;
        margin-top: 120px; /* Compensa o header fixo */
    }
    .categorias-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        padding: 40px 0;
    }
    .card-title {
        font-weight: 800 !important; /* Mantendo seu padrão de negrito */
    }
</style>

<main class="py-2">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <a href="cafedamanha.php">
                <img src="IMAGES/cafeindex.png" class="d-block w-100" alt="Café da manhã">
            </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Bom dia!</h5>
                    <p>Receitas perfeitas para despertar o apetite e a energia.</p>
                </div>
            </div>
            <div class="carousel-item">
                <a href="jantar.php">
                <img src="IMAGES/jantaindex.png " class="d-block w-100" alt="Almoço brasileiro">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Bateu a fome?</h5>
                    <p>Receitas para um ótimo jantar.</p>
                </div>
            </div>
            <div class="carousel-item">
                <a href="lanche.php">
                <img src="IMAGES/lancheindex.png" class="d-block w-100" alt="Comidas refrescantes">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Ta sentindo? Cheirinho de café da tarde!</h5>
                    <p>Receitas saborosas para lanchar.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</main>

<div class="container my-5">
    <h2 class="text-center fw-bold mb-4" style="color: #F15E66;">Receitas da Comunidade</h2>

    <?php if ($receitas->num_rows > 0): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while ($receita = $receitas->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
<div style="position: relative;">
    <a href="ver_receita.php?id=<?php echo $receita['id_receita']; ?>">
        <img src="IMAGES/receitas/<?php echo htmlspecialchars($receita['foto']); ?>"
             class="card-img-top"
             style="height: 220px; object-fit: cover;"
             alt="<?php echo htmlspecialchars($receita['titulo']); ?>">
    </a>

    <div onclick="favoritar(this, <?php echo $receita['id_receita']; ?>)"
         style="position: absolute; top: 10px; right: 10px; cursor: pointer; font-size: 24px; z-index: 2;">
        <?php if ($receita['id_favorito']): ?>
            <span style="color: #e74c3c;">❤</span>
        <?php else: ?>
            <span style="color: white;">🤍</span>
        <?php endif; ?>
    </div>
</div>

<div class="card-body text-center">
    <h5 class="fw-bold">
        <a href="ver_receita.php?id=<?php echo $receita['id_receita']; ?>"
           class="text-decoration-none text-dark">
            <?php echo htmlspecialchars($receita['titulo']); ?>
        </a>
    </h5>

    <p class="text-muted small mb-1">
        <?php echo htmlspecialchars($receita['nome_categoria'] ?? 'Sem categoria'); ?>
    </p>

    <p class="text-muted small mb-3">
        Por <?php echo htmlspecialchars($receita['autor']); ?>
    </p>

    <a href="ver_receita.php?id=<?php echo $receita['id_receita']; ?>"
       class="btn text-white"
       style="background-color: #F47939; font-weight: bold;">
       Ver receita
    </a>
</div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Ainda não há receitas cadastradas.</p>
    <?php endif; ?>
</div>


<?php include 'footer.php'; ?>