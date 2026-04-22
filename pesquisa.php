<?php
include_once 'header.php';
include_once 'PHP/conexao.php';

$busca = $_GET['busca'] ?? '';

$sql = "SELECT r.*, u.nome AS autor, c.nome_categoria
        FROM receitas r
        JOIN usuario u ON r.usuario_id = u.id_usuario
        LEFT JOIN receita_categorias rc ON r.id_receita = rc.receita_id
        LEFT JOIN categorias c ON rc.categoria_id = c.id_categoria";

if (!empty($busca)) {
    $sql .= " WHERE r.titulo LIKE ?
              OR r.descricao LIKE ?
              OR r.historia LIKE ?
              OR c.nome_categoria LIKE ?";
}

$sql .= " ORDER BY r.cadastrada_em DESC";

$stmt = $conn->prepare($sql);

if (!empty($busca)) {
    $busca_param = "%" . $busca . "%";
    $stmt->bind_param("ssss", $busca_param, $busca_param, $busca_param, $busca_param);
}

$stmt->execute();
$receitas = $stmt->get_result();
?>

<main class="container mt-5 pt-5 mb-5" style="min-height: 80vh;">
    <div class="text-center mb-4">
        <h2 class="fw-bold" style="color: #F15E66;">Resultado da Pesquisa</h2>

        <?php if (!empty($busca)): ?>
            <p class="text-muted">
                Você pesquisou por: <strong><?php echo htmlspecialchars($busca); ?></strong>
            </p>
        <?php endif; ?>
    </div>

    <?php if ($receitas->num_rows > 0): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while ($rec = $receitas->fetch_assoc()): ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm">
                        <a href="ver_receita.php?id=<?php echo $rec['id_receita']; ?>">
                            <img src="IMAGES/receitas/<?php echo htmlspecialchars($rec['foto']); ?>" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover;"
                                 alt="<?php echo htmlspecialchars($rec['titulo']); ?>">
                        </a>

                        <div class="card-body text-center">
                            <h5 class="fw-bold">
                                <a href="ver_receita.php?id=<?php echo $rec['id_receita']; ?>" 
                                   class="text-decoration-none text-dark">
                                    <?php echo htmlspecialchars($rec['titulo']); ?>
                                </a>
                            </h5>

                            <p class="text-muted small mb-2">
                                <?php echo htmlspecialchars($rec['nome_categoria'] ?? 'Sem categoria'); ?>
                            </p>

                            <a href="ver_receita.php?id=<?php echo $rec['id_receita']; ?>" 
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
        <p class="text-center text-muted">Nenhuma receita encontrada.</p>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>