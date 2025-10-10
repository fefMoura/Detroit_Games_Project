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
    
     public function listarPorPlataforma(string $plataforma) {
        $db = \Database::getInstance()->getConnection();
        // Usamos um prepared statement para segurança contra SQL Injection
        $stmt = $db->prepare("SELECT * FROM produtos WHERE plataforma = ? ORDER BY nome");
        $stmt->execute([$plataforma]);
        return $stmt->fetchAll();
    }
    // Busca produtos por uma substring do nome
public function pesquisarPorNome($nome) {
    $db = \Database::getInstance()->getConnection();
    
    $termoDePesquisa = '%' . $nome . '%'; 
    
    // Prepara a query usando LIKE e um placeholder
    $stmt = $db->prepare("SELECT * FROM produtos WHERE nome LIKE ?");
    // Executa a query com o termo de pesquisa preparado
    $stmt->execute([$termoDePesquisa]);
    // Altera para fetchAll() para retornar múltiplos resultados, 
    // já que a pesquisa por substring pode retornar mais de um produto.
    return $stmt->fetchAll();
}
    public function criar(string $nome, float $valor, int $estoque, string $imagem, string $desenvolvedora, string $genero, string $plataforma) {
        $db = \Database::getInstance()->getConnection();
        
        try {
            $sql = "INSERT INTO produtos (nome, valor, estoque, imagem, desenvolvedora, genero, plataforma) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
        
            return $stmt->execute([$nome, $valor, $estoque, $imagem, $desenvolvedora, $genero, $plataforma]);
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