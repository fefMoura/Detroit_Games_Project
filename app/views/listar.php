<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Loja Virtual</title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <header>
        <h1>Loja Virtual</h1>
        <nav>
            <a href="/index.php?controller=produto&action=listar">Produtos</a>
            <a href="/index.php?controller=venda&action=historico">Histórico de Vendas</a>
        </nav>
    </header>

    <main>
        <h2>Lista de Produtos</h2>

        <?php
        // Exibe a mensagem da sessão (se houver)
        session_start();
        if (isset($_SESSION['mensagem'])) {
            echo "<p class='mensagem'>" . htmlspecialchars($_SESSION['mensagem']) . "</p>";
            unset($_SESSION['mensagem']);
        }
        ?>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Estoque</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                    <td>R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></td>
                    <td><?php echo $produto['estoque']; ?></td>
                    <td>
                        <form action="/index.php?controller=venda&action=registrar" method="post">
                            <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                            <input type="number" name="quantidade" value="1" min="1" max="<?php echo $produto['estoque']; ?>">
                            <button type="submit" <?php echo $produto['estoque'] == 0 ? 'disabled' : ''; ?>>Comprar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
<<<<<<< HEAD
        <p>&copy; 2025 - Sistema de Venda</p>
=======
        <p>&copy; 2025 - Sistema de Vendas MVC</p>
>>>>>>> 1bc9986688daab944558d8a76277ca9b9894884a
    </footer>
</body>
</html>