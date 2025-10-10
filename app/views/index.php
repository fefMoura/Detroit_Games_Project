<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detroit Games | Loja Online</title>
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="../../public/images/LogoSemFundo.png" alt="Detroit Games Logo" />
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
            <!-- Menu de navegação inteligente e consistente -->
            <li><a href="../../public/roteador.php?controller=produto&action=listar">Produtos</a></li>
            
            <?php if (isset($_SESSION['usuario'])): // Verifica se o usuário está logado ?>
                
                <?php if ($_SESSION['role'] === 'admin'): // Se for admin, mostra os links de administração ?>
                    <li><a href="../../public/roteador.php?controller=venda&action=historico">Histórico de Vendas</a></li>
                    <li><a href="../../public/roteador.php?controller=produto&action=adicionar">Adicionar Produto</a></li>
                <?php endif; ?>
                <li>
                    <span style="color: white; padding: 0 15px;">
                      <strong> Olá, <?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>
                    </span>
                  </li>
                <!-- Links para todos os usuários logados -->
                <li><a href="../../public/roteador.php?controller=auth&action=logout">Logout</a></li>

            <?php else: // Se não estiver logado, mostra o link de Login ?>
                <li><a href="../../public/roteador.php?controller=auth&action=login">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
        <section class="carousel">
            <div class="carousel-container">
                <div class="slide active">
                    <img src="../../public/images/carousel/GOW.jpg" alt="God of War Ragnarok" />
                </div>
                <div class="slide">
                    <img src="../../public/images/carousel/EldenRing.avif" alt="Elden Ring" />
                </div>
                <div class="slide">
                    <img src="../../public/images/carousel/DetroitBecomeHuman.jpg" alt="Detroit Become Human" />
                </div>
            </div>
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </section>

        <section class="platforms">
            <!-- LINKS ATUALIZADOS PARA SEREM DINÂMICOS -->
            <div class="platform-card nintendo" onclick="window.location.href='../../public/roteador.php?controller=produto&action=listar&plataforma=Nintendo'">Nintendo</div>
            <div class="platform-card ps4" onclick="window.location.href='../../public/roteador.php?controller=produto&action=listar&plataforma=PS4'">PS4</div>
            <div class="platform-card ps5" onclick="window.location.href='../../public/roteador.php?controller=produto&action=listar&plataforma=PS5'">PS5</div>
            <div class="platform-card xbox" onclick="window.location.href='../../public/roteador.php?controller=produto&action=listar&plataforma=Xbox'">Xbox</div>
        </section>
    </main>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="../../public/js/main.js"></script>
</body>
</html>