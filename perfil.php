<?php
include_once 'header.php'; 
include_once 'PHP/conexao.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuario WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();

// 1. Consulta: Minhas Receitas
$sql_receitas = "SELECT r.*, c.nome_categoria 
                 FROM receitas r
                 LEFT JOIN receita_categorias rc ON r.id_receita = rc.receita_id
                 LEFT JOIN categorias c ON rc.categoria_id = c.id_categoria
                 WHERE r.usuario_id = ? 
                 ORDER BY r.cadastrada_em DESC";
$stmt_rec = $conn->prepare($sql_receitas);
$stmt_rec->bind_param("i", $id);
$stmt_rec->execute();
$minhas_receitas = $stmt_rec->get_result();

// 2. Consulta: Receitas Favoritadas
$sql_favoritas = "SELECT r.*, u.nome as autor, c.nome_categoria 
                  FROM favoritos f
                  JOIN receitas r ON f.receita_id = r.id_receita
                  JOIN usuario u ON r.usuario_id = u.id_usuario
                  LEFT JOIN receita_categorias rc ON r.id_receita = rc.receita_id
                  LEFT JOIN categorias c ON rc.categoria_id = c.id_categoria
                  WHERE f.usuario_id = ? 
                  ORDER BY f.criado_em DESC";
$stmt_fav = $conn->prepare($sql_favoritas);
$stmt_fav->bind_param("i", $id);
$stmt_fav->execute();
$receitas_favoritas = $stmt_fav->get_result();
?>

<main class="container mt-5 pt-5 mb-5" style="min-height: 80vh;">
    <div class="row mt-4">
        <div class="col-md-3 text-center border-end">
             <h3 class="fw-bold"><?php echo explode(' ', $usuario['nome'])[0]; ?></h3>
             <p class="text-muted small">Membro desde: <?php echo date('d/m/Y', strtotime($usuario['criado_em'])); ?></p>
        </div>

        <div class="col-md-9">

            <?php if (isset($_GET['sucesso'])): ?>
                <div class="alert alert-success text-center py-2 mb-3" style="background-color: #F47939; color: white; border: none; font-weight: bold;">
                    Dados atualizados com sucesso!
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['receita_excluida'])): ?>
                <div class="alert alert-success text-center py-2 mb-3" style="background-color: #F47939; color: white; border: none; font-weight: bold;">
                    Receita excluída com sucesso!
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['erro'])): ?>
                <div class="alert alert-danger text-center py-2 mb-3" style="font-weight: bold;">
                    Ocorreu um erro ao processar a solicitação.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['sucesso_receita'])): ?>
            <div class="alert alert-success text-center py-2 mb-3" style="background-color: #F47939; color: white; border: none; font-weight: bold;">
                Receita publicada com sucesso!
            </div>
            <?php endif; ?>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-dados" type="button" style="color: #F15E66; font-weight: bold;">Meus Dados</button>
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-receitas" type="button" style="color: #F15E66; font-weight: bold;">Minhas Receitas</button>
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-favoritas" type="button" style="color: #F15E66; font-weight: bold;">Favoritas ❤</button>
                </div>
            </nav>

            <div class="tab-content p-4 border border-top-0 shadow-sm bg-white rounded-bottom">
                
<div class="tab-pane fade show active" id="nav-dados" role="tabpanel">
    <form action="PHP/atualizar_perfil.php" method="POST">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo htmlspecialchars($usuario['nome']); ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">E-mail</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($usuario['email']); ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">CEP</label>
                <input type="text" name="cep" class="form-control" value="<?php echo htmlspecialchars($usuario['cep']); ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold">Cidade</label>
                <input type="text" name="cidade" class="form-control" value="<?php echo htmlspecialchars($usuario['cidade']); ?>">
            </div>

            <div class="col-12">
                <label class="form-label fw-bold">Endereço</label>
                <input type="text" name="endereco" class="form-control" value="<?php echo htmlspecialchars($usuario['endereco']); ?>">
            </div>

            <div class="col-12">
                <button type="submit" class="btn text-white mt-3 w-100" style="background-color: #F15E66; font-weight: bold;">
                    Salvar Alterações
                </button>
            </div>

            <div class="col-12">
                <button type="submit" name="acao" value="excluir"
                    class="btn btn-danger w-100 mt-2"
                    onclick="return confirm('Tem certeza que deseja excluir seu perfil? Essa ação não pode ser desfeita.');">
                    Excluir Perfil
                </button>
            </div>
        </div>
    </form>
            </div>


                <div class="tab-pane fade" id="nav-receitas" role="tabpanel">
                    <button class="btn btn-sm text-white mb-3" style="background-color: #F15E66; font-weight: bold;" data-bs-toggle="collapse" data-bs-target="#formReceita">+ Nova Receita</button>
                    
<div class="collapse mb-4" id="formReceita">
    <div class="card card-body border-0 shadow-sm">
        <form action="PHP/salvar_receita.php" method="POST" enctype="multipart/form-data">

            <input type="text" name="titulo" class="form-control mb-2" placeholder="Título da Receita" required>

            <textarea name="descricao" class="form-control mb-2" placeholder="Ingredientes e Preparo" required></textarea>

            <textarea name="historia" class="form-control mb-2" placeholder="Qual a história por trás dessa receita?"></textarea>

            <input type="number" name="tempo_preparo" class="form-control mb-2" placeholder="Tempo de preparo (em minutos)" required>

            <input type="number" name="porcoes" class="form-control mb-2" placeholder="Quantidade de porções" required>

            <select name="id_categoria" class="form-control mb-2" required>
                <option value="">Selecione uma categoria</option>
                <?php
                $sql_cat = "SELECT * FROM categorias";
                $result_cat = $conn->query($sql_cat);
                while ($cat = $result_cat->fetch_assoc()):
                ?>
                    <option value="<?php echo $cat['id_categoria']; ?>">
                        <?php echo htmlspecialchars($cat['nome_categoria']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <input type="file" name="foto" class="form-control mb-2" accept="image/*">

            <button type="submit" class="btn text-white" style="background-color: #F47939; font-weight: bold;">
                Publicar
            </button>

        </form>
    </div>
</div>

                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        <?php while($rec = $minhas_receitas->fetch_assoc()): ?>
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm">
                                    <a href="ver_receita.php?id=<?php echo $rec['id_receita']; ?>">
    <img src="IMAGES/receitas/<?php echo htmlspecialchars($rec['foto']); ?>" class="card-img-top" style="height: 120px; object-fit: cover;">
</a>
                                    <div class="card-body p-2 text-center">
                                        <h6 class="fw-bold mb-0">
                                             <a href="ver_receita.php?id=<?php echo $rec['id_receita']; ?>" 
                                                class="text-decoration-none text-dark">
                                                <?php echo htmlspecialchars($rec['titulo']); ?>
                                                </a>
                                            </h6>
                                            <a href="PHP/excluir_receita.php?id=<?php echo $rec['id_receita']; ?>" 
                                            class="text-danger small fw-bold"
                                            onclick="return confirm('Tem certeza que deseja excluir esta receita?');">
                                            Excluir
                                            </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-favoritas" role="tabpanel">
                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        <?php if ($receitas_favoritas->num_rows > 0): ?>
                            <?php while($fav = $receitas_favoritas->fetch_assoc()): ?>
                                <div class="col">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="IMAGES/receitas/<?php echo htmlspecialchars($fav['foto']); ?>" class="card-img-top" style="height: 120px; object-fit: cover;">
                                        <div class="card-body p-2 text-center">
                                            <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($fav['titulo']); ?></h6>
                                            <span class="badge bg-light text-dark border"><?php echo htmlspecialchars($fav['nome_categoria']); ?></span>
                                            
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p class="text-center text-muted w-100">Nenhuma favorita ainda. ❤</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>