<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Vendas - Detroit Games</title>
    <link rel="stylesheet" href="../public/css/ps5.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        .table-container {
            overflow-x: auto;
            padding: 0 20px;
            margin-top: 20px;
        }
        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .history-table th, .history-table td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .history-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .history-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .history-table td.center {
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="../public/images/LogoSemFundo.png" alt="Logótipo da Detroit Games" onclick="window.location.href='../public/index.php'" style="cursor: pointer;" />
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
        <h1>Histórico de Vendas</h1>
        
        <div class="table-container">
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Total</th>
                        <th>Data da Venda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($vendas)): ?>
                        <?php foreach ($vendas as $venda): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($venda['nome']); ?></td>
                                <td class="center"><?php echo $venda['quantidade']; ?></td>
                                <td>R$ <?php echo number_format($venda['valor_total'], 2, ',', '.'); ?></td>
                                <td><?php echo date('d/m/Y H:i:s', strtotime($venda['data_venda'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="center">Nenhuma venda foi registrada ainda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>