<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/Produto.php';

class ProdutoController {
    // Método para buscar os produtos e exibir a view de listagem
    public function listar() {
        $produtoModel = new \App\Models\Produto();
        $produtos = $produtoModel->listarTodos();
        
        require_once __DIR__ . '/../views/listar.php';
    }
}
?>