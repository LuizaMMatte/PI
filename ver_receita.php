<?php
include_once 'header.php';
include_once 'PHP/conexao.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<main class='container mt-5 pt-5'><p class='text-center'>Receita não encontrada.</p></main>";
    include 'footer.php';
    exit();
}

$id_receita = (int) $_GET['id'];

$sql = "SELECT r.*, u.nome AS autor, c.nome_categoria
        FROM receitas r
        JOIN usuario u ON r.usuario_id = u.id_usuario
        LEFT JOIN receita_categorias rc ON r.id_receita = rc.receita_id
        LEFT JOIN categorias c ON rc.categoria_id = c.id_categoria
        WHERE r.id_receita = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_receita);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "<main class='container mt-5 pt-5'><p class='text-center'>Receita não encontrada.</p></main>";
    include 'footer.php';
    exit();
}

$receita = $resultado->fetch_assoc();

$sql_comentarios = "SELECT c.*, u.nome
                    FROM comentarios c
                    JOIN usuario u ON c.usuario_id = u.id_usuario
                    WHERE c.receita_id = ?
                    ORDER BY c.criado_em DESC";

$stmt_comentarios = $conn->prepare($sql_comentarios);
$stmt_comentarios->bind_param("i", $id_receita);
$stmt_comentarios->execute();
$comentarios = $stmt_comentarios->get_result();

?>

<main class="container mt-5 pt-5 mb-5" style="min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="mb-4 text-center">
                <span class="badge bg-light text-dark border mb-3">
                    <?php echo htmlspecialchars($receita['nome_categoria'] ?? 'Sem categoria'); ?>
                </span>

                <h1 class="fw-bold mb-3" style="color: #F15E66;">
                    <?php echo htmlspecialchars($receita['titulo']); ?>
                </h1>

                <p class="text-muted">
                    Compartilhada por <strong><?php echo htmlspecialchars($receita['autor']); ?></strong>
                    em <?php echo date('d/m/Y', strtotime($receita['cadastrada_em'])); ?>
                </p>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <img 
                    src="IMAGES/receitas/<?php echo htmlspecialchars($receita['foto']); ?>" 
                    alt="<?php echo htmlspecialchars($receita['titulo']); ?>"
                    class="img-fluid rounded-top"
                    style="width: 100%; max-height: 420px; object-fit: cover;"
                >
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h3 class="fw-bold mb-3" style="color: #F47939;">Sobre esta receita</h3>
                            <p class="mb-0" style="line-height: 1.8;">
                                <?php echo nl2br(htmlspecialchars($receita['descricao'])); ?>
                            </p>
                        </div>
                    </div>

                    <?php if (!empty($receita['historia'])): ?>
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h3 class="fw-bold mb-3" style="color: #F47939;">A história por trás da receita</h3>
                                <p class="mb-0" style="line-height: 1.8;">
                                    <?php echo nl2br(htmlspecialchars($receita['historia'])); ?>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-3" style="color: #F15E66;">Informações</h4>

                            <p class="mb-2"><strong>Tempo de preparo:</strong><br>
                                <?php echo (int)$receita['tempo_preparo']; ?> minutos
                            </p>

                            <p class="mb-2"><strong>Porções:</strong><br>
                                <?php echo (int)$receita['porcoes']; ?> porções
                            </p>

                            <p class="mb-2"><strong>Categoria:</strong><br>
                                <?php echo htmlspecialchars($receita['nome_categoria'] ?? 'Sem categoria'); ?>
                            </p>

                            <p class="mb-0"><strong>Autor:</strong><br>
                                <?php echo htmlspecialchars($receita['autor']); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mt-4">
    <div class="card-body p-4">
        <h3 class="fw-bold mb-3" style="color: #F15E66;">Comentários</h3>

        <?php if (isset($_GET['comentario_sucesso'])): ?>
            <div class="alert alert-success text-center py-2 mb-3" style="background-color: #F47939; color: white; border: none; font-weight: bold;">
                Comentário enviado com sucesso!
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['erro_comentario'])): ?>
            <div class="alert alert-danger text-center py-2 mb-3" style="font-weight: bold;">
                Não foi possível enviar o comentário.
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['id_usuario'])): ?>
            <form action="PHP/salvar_comentario.php" method="POST" class="mb-4">
                <input type="hidden" name="receita_id" value="<?php echo $receita['id_receita']; ?>">

                <textarea name="comentario"
                          class="form-control mb-2"
                          rows="3"
                          placeholder="Escreva seu comentário..."
                          required></textarea>

                <button type="submit"
                        class="btn text-white"
                        style="background-color: #F15E66; font-weight: bold;">
                    Comentar
                </button>
            </form>
        <?php else: ?>
            <p class="text-muted">
                Faça <a href="login.php" style="color: #F15E66; font-weight: bold;">login</a> para comentar.
            </p>
        <?php endif; ?>

        <?php if ($comentarios->num_rows > 0): ?>
            <?php while ($coment = $comentarios->fetch_assoc()): ?>
                <div class="border rounded p-3 mb-3 bg-light">
                    <p class="mb-1 fw-bold"><?php echo htmlspecialchars($coment['nome']); ?></p>
                    <p class="text-muted small mb-2">
                        <?php echo date('d/m/Y', strtotime($coment['criado_em'])); ?>
                    </p>
                    <p class="mb-0"><?php echo nl2br(htmlspecialchars($coment['comentario'])); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-muted mb-0">Ainda não há comentários nessa receita.</p>
        <?php endif; ?>
    </div>
</div>

            <div class="text-center mt-4">
          
    <button type="button" class="btn text-white" style="background-color: #F15E66; font-weight: bold;" onclick="history.back();">
        Voltar
    </button>
</div>
            </div>

        </div>
    </div>
</main>

<?php include 'footer.php'; ?>