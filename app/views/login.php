<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Detroit Games</title>
    <link rel="stylesheet" href="/Detroit_Games_Project/public/css/login.css">
</head>
<body>

    <!-- Fundo com Carrossel -->
    <div class="carousel-container">
        <?php
        $dir = __DIR__ . '/../../public/images/carousel/';
        $files = array_diff(scandir($dir), ['..', '.']);
        foreach ($files as $i => $file) {
            $active = $i === 2 ? 'active' : ''; // primeira imagem ativa
            echo "<img src='/Detroit_Games_Project/public/images/carousel/$file' class='$active'>";
        }
        ?>
        <div class="overlay"></div>
    </div>

    <!-- Card de Login -->
    <div class="login-card">
        <div class="logo-container">
            <img src="/Detroit_Games_Project/public/images/LogoSemFundo.png" alt="Logo Detroit Games">
        </div>
        <h2>Bem-vindo de volta!</h2>
        <p class="subtitle">Acesse sua conta para continuar</p>

        <?php if (isset($_SESSION['erro_login'])): ?>
            <p class="error-message"><?= htmlspecialchars($_SESSION['erro_login']); ?></p>
            <?php unset($_SESSION['erro_login']); ?>
        <?php endif; ?>

        <form action="../public/roteador.php?controller=auth&action=autenticar" method="POST">
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" placeholder="Digite seu usuário" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>
            <button type="submit" class="form-button">Entrar</button>
        </form>
    </div>

    <script src="/Detroit_Games_Project/public/js/login.js"></script>
</body>
</html>
