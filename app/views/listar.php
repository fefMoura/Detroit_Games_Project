<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detroit Games | Produtos</title>
    <link rel="stylesheet" href="../public/css/style.css" />
    <link rel="stylesheet" href="../public/css/ps5.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        .login-to-buy-button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #6c757d;
            color: white;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-sizing: border-box;
        }
        .login-to-buy-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="../public/images/LogoSemFundo.png" alt="Detroit Games Logo" onclick="window.location.href='../app/views/index.php'" style="cursor: pointer;" />
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
            
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <!-- Histórico de Vendas e Adicionar Produto só para admins -->
                <li><a href="../public/roteador.php?controller=venda&action=historico">Histórico de Vendas</a></li>
                <li><a href="../public/roteador.php?controller=produto&action=adicionar" style="color: #28a745; font-weight: bold;">Adicionar Produto</a></li>
            <?php endif; ?>

            <?php if (isset($_SESSION['usuario'])): ?>
                <li style="margin-left: auto;"><span>Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span></li>
                <li><a href="../public/roteador.php?controller=auth&action=logout">Logout</a></li>
            <?php else: ?>
                <!-- Login para visitantes -->
                <li style="margin-left: auto;"><a href="../public/roteador.php?controller=auth&action=login">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <main class="products-section">
        <h1>Todos os Produtos</h1>

        <?php
     
        if (isset($_SESSION['mensagem'])) {
            echo "<p style='padding: 15px; margin: 20px auto; max-width: 80%; text-align: center; border: 1px solid #c3e6cb; background-color: #d4edda; color: #155724; border-radius: 5px;'>" . htmlspecialchars($_SESSION['mensagem']) . "</p>";
            unset($_SESSION['mensagem']);
        }
        ?>

        <div class="products-grid">
            <?php if (!empty($produtos)): ?>
                <?php foreach ($produtos as $produto): ?>
                    <div class="product-card">
                        <?php if (!empty($produto['imagem'])): ?>
                            <img src="<?php echo ltrim(htmlspecialchars($produto['imagem']), '/'); ?>" alt="<?php echo htmlspecialchars($produto['nome']); ?>">
                        <?php else: ?>
                            <img src="../public/images/default.png" alt="Imagem indisponível">
                        <?php endif; ?>

                        <h3><?php echo htmlspecialchars($produto['nome']); ?></h3>
                        <p class="product-info"><?php echo htmlspecialchars($produto['plataforma']); ?> | <?php echo htmlspecialchars($produto['genero']); ?></p>
                        <p class="product-developer"><?php echo htmlspecialchars($produto['desenvolvedora']); ?></p>
                        <p class="product-price">R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></p>
<div class="buy-action">
                            <?php if (isset($_SESSION['usuario'])): // Se o usuário está logado, mostra o formulário de compra ?>
                                <form action="../public/roteador.php?controller=venda&action=registrar" method="post">
                                    <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                                    <input type="number" name="quantidade" value="1" min="1" max="<?php echo $produto['estoque']; ?>">
                                    <button type="submit" <?php echo $produto['estoque'] == 0 ? 'disabled' : ''; ?>>
                                        <?php echo $produto['estoque'] == 0 ? 'Indisponível' : 'Comprar'; ?>
                                    </button>
                                </form>
                            <?php else: // Se não está logado, mostra um botão que leva para a página de login ?>
                                <a href="../public/roteador.php?controller=auth&action=login" class="login-to-buy-button">
                                    Faça login para comprar
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum produto encontrado.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
