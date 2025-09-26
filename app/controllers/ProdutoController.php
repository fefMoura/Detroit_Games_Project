<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/Produto.php';

class ProdutoController {
    // Método para buscar os produtos e exibir a view de listagem
    public function listar() {
        $produtoModel = new \App\Models\Produto();
        $produtos = $produtoModel->listarTodos();
        
        // Carrega a view passando a lista de produtos
        require_once __DIR__ . '/../views/produtos/listar.php';
    }
}
?>