<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Novo Produto</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        /* Estilos simples para o formulário não ficar sem formatação */
        body { font-family: sans-serif; background-color: #f0f2f5; }
        .form-container { max-width: 600px; margin: 50px auto; padding: 30px; background: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
        .form-button { width: 100%; padding: 12px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; }
        .form-button:hover { background-color: #0056b3; }
        .back-link { display: block; text-align: center; margin-top: 20px; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Cadastrar Novo Produto</h2>
        <form action="../public/roteador.php?controller=produto&action=salvar" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome do Produto:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
<div class="form-group">
                <label for="desenvolvedora">Desenvolvedora:</label>
                <input type="text" id="desenvolvedora" name="desenvolvedora" required>
            </div>

            <div class="form-group">
                <label for="genero">Gênero:</label>
                <input type="text" id="genero" name="genero" required>
            </div>
            
            <div class="form-group">
                <label for="plataforma">Plataforma:</label>
                <select id="plataforma" name="plataforma" required>
                    <option value="" disabled selected>Selecione uma plataforma</option>
                    <option value="PS5">PlayStation 5</option>
                    <option value="PS4">PlayStation 4</option>
                    <option value="Xbox">Xbox</option>
                    <option value="Nintendo">Nintendo</option>
                </select>
            </div>


            <div class="form-group">
                <label for="valor">Valor (ex: 249.90):</label>
                <input type="number" id="valor" name="valor" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="estoque">Quantidade em Estoque:</label>
                <input type="number" id="estoque" name="estoque" required>
            </div>
          <div class="form-group">
                <label for="imagem">Imagem do Produto:</label>
                <input type="file" id="imagem" name="imagem" accept="image/jpeg, image/png, image/webp" required>
            </div>
            <button type="submit" class="form-button">Salvar Produto</button>
        </form>
        <a href="../public/roteador.php?controller=produto&action=listar" class="back-link">Voltar para a lista de produtos</a>
    </div>
</body>
</html>