<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detroit Games | Produtos</title>
    <!-- CAMINHO CORRIGIDO E PADRONIZADO -->
    <link rel="stylesheet" href="../public/css/ps5.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        /* Estilos para o link de admin e mensagens */
        .admin-link-container { text-align: center; margin: 20px 0; }
        .admin-link { padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .mensagem { padding: 15px; margin: 20px auto; max-width: 80%; text-align: center; border-radius: 5px; border: 1px solid #c3e6cb; background-color: #d4edda; color: #155724; }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="../public/images/LogoSemFundo.png" alt="Detroit Games Logo" onclick="window.location.href='/Detroit_Games_Project/public/index.php'" style="cursor: pointer;" />
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Buscar produtos" />
            <button><i class="fa fa-search"></i></button>
        </div>
        <div class="cart">
            <i class="fa fa-shopping-cart"></i>
        </div>
    </header>

    <nav class="navbar">
        <ul>
            <li><a href="../public/roteador.php?controller=produto&action=listar">Produtos</a></li>
            <li><a href="../public/roteador.php?controller=produto&action=listar">Vendas</a></li>
            <li><a href="../public/roteador.php?controller=venda&action=historico">Histórico de Vendas</a></li>
        </ul>
    </nav>

    <main class="products-section">
        <h1>Todos os Produtos</h1>

        <?php
        if (isset($_GET['admin']) && $_GET['admin'] === 'true'):
        ?>
            <div class="admin-link-container">
                <a href="/Detroit_Games_Project/public/roteador.php?controller=produto&action=adicionar" class="admin-link">
                    + Adicionar Novo Produto
                </a>
            </div>
        <?php 
        endif;
        ?>

        <?php
        session_start();
        if (isset($_SESSION['mensagem'])) {
            echo "<p class='mensagem'>" . htmlspecialchars($_SESSION['mensagem']) . "</p>";
            unset($_SESSION['mensagem']);
        }
        ?>

        <div class="products-grid">
            <?php if (!empty($produtos)): ?>
                <?php foreach ($produtos as $produto): ?>
                    <div class="product-card">
                        <?php if (!empty($produto['imagem'])): ?>
                            <img src="../<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                        <?php else: ?>
                            <img src="../public/images/default.png" alt="Imagem indisponível">
                        <?php endif; ?>

                        <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                        <p>R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></p>

                        <!-- ACTION DO FORMULÁRIO CORRIGIDO E PADRONIZADO -->
                        <form action="../public/roteador.php?controller=venda&action=registrar" method="post">
                            <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                            <input type="number" name="quantidade" value="1" min="1" max="<?php echo $produto['estoque']; ?>">
                            <button type="submit" <?php echo $produto['estoque'] == 0 ? 'disabled' : ''; ?>>
                                <?php echo $produto['estoque'] == 0 ? 'Indisponível' : 'Comprar'; ?>
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum produto encontrado.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
