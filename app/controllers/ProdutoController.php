<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/Produto.php';

class ProdutoController {
    /**
     * busca os produtos e decide qual view mostrar
     */
    public function listar() {
        $produtoModel = new \App\Models\Produto();
        
        $produtos = $produtoModel->listarTodos();
        
        require_once __DIR__ . '/../views/listar.php';
    }

}
?>

