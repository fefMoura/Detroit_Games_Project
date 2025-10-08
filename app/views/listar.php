<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detroit Games | Produtos</title>
  <link rel="stylesheet" href="../public/css/ps5.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<body>
  <header class="header">
    <div class="logo">
      <img src="/public/images/LogoSemFundo.png" alt="Detroit Games Logo" onclick="window.location.href='index.php'" />
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
      <li><a href="/index.php?controller=produto&action=listar">Produtos</a></li>
      <li><a href="/index.php?controller=venda&action=listar">Vendas</a></li>
      <li><a href="/index.php?controller=venda&action=historico">Histórico de Vendas</a></li>
    </ul>
  </nav>

  <main class="products-section">
    <h1>Todos os Produtos</h1>

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
              <img src="/public/images/uploads/<?php echo htmlspecialchars($produto['imagem']); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
            <?php else: ?>
              <img src="/public/images/default.png" alt="Imagem indisponível">
            <?php endif; ?>

            <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
            <p>R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></p>

            <form action="/index.php?controller=venda&action=registrar" method="post">
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
