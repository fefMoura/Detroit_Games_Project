<?php
namespace App\Models;

require_once __DIR__ . '/../../config/database.php';

class Produto {
    // Busca todos os produtos no banco de dados
    public function listarTodos() {
        $db = \Database::getInstance()->getConnection();
        $query = $db->query("SELECT * FROM produtos ORDER BY nome");
        return $query->fetchAll();
    }
    
    // Busca um único produto pelo ID
    public function pesquisarPorId($id) {
        $db = \Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function criar(string $nome, float $valor, int $estoque, string $imagem) {
        $db = \Database::getInstance()->getConnection();
        
        try {
        
            $stmt = $db->prepare("INSERT INTO produtos (nome, valor, estoque, imagem) VALUES (?, ?, ?, ?)");
        
            return $stmt->execute([$nome, $valor, $estoque, $imagem]);
        } catch (\PDOException $e) {
            error_log('Erro ao criar produto: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Calcula o valor total de uma venda com base no valor de um produto e na quantidade.
     * Este método é estático porque é um cálculo puro e não depende de uma instância específica da classe.
     *
     * @param float $valorProduto O valor unitário do produto.
     * @param int $quantidade A quantidade de itens vendidos.
     * @return float O valor total da venda.
     */
    public static function calcularValorTotalVenda(float $valorProduto, int $quantidade): float {
        return $valorProduto * $quantidade;
    }
}
?>