<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Detroit Games</title>
    <link rel="stylesheet" href="/Detroit_Games_Project/public/css/style.css">
    <style>
        /* Estilos simples para a página de login */
        body { font-family: sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-container { width: 100%; max-width: 400px; padding: 40px; background: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .form-button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .form-button:hover { background-color: #0056b3; }
        .error-message { color: #dc3545; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Acessar o Sistema</h2>

        <?php
        // Exibe a mensagem de erro, se houver
        if (isset($_SESSION['erro_login'])) {
            echo "<p class='error-message'>" . htmlspecialchars($_SESSION['erro_login']) . "</p>";
            unset($_SESSION['erro_login']); // Limpa 
        }
        ?>

        <form action="../public/roteador.php?controller=auth&action=autenticar" method="POST">
            <div class="form-group">
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="form-button">Entrar</button>
        </form>
    </div>
</body>
</html>