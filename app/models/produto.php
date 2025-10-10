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
public function criar(string $nome, float $valor, int $estoque, string $imagem = null, string $desenvolvedora = null, string $genero = null, string $plataforma = null) {
    $db = \Database::getInstance()->getConnection();

    try {
        // Verifica se já existe um produto com o mesmo nome
        $checkSql = "SELECT id, estoque FROM produtos WHERE nome = ?";
        $checkStmt = $db->prepare($checkSql);
        $checkStmt->execute([$nome]);
        $produtoExistente = $checkStmt->fetch(\PDO::FETCH_ASSOC);

        if ($produtoExistente) {
            // Atualiza apenas o estoque somando o valor atual com o novo
            $novoEstoque = $produtoExistente['estoque'] + $estoque;
            $updateSql = "UPDATE produtos SET estoque = ? WHERE id = ?";
            $updateStmt = $db->prepare($updateSql);
            return $updateStmt->execute([$novoEstoque, $produtoExistente['id']]);
        } else {
            // Se o produto não existir, é obrigatório ter imagem e demais dados
            if (empty($imagem)) {
                throw new \Exception("É necessário enviar uma imagem para novos produtos.");
            }

            $sql = "INSERT INTO produtos (nome, valor, estoque, imagem, desenvolvedora, genero, plataforma) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            return $stmt->execute([$nome, $valor, $estoque, $imagem, $desenvolvedora, $genero, $plataforma]);
        }
    } catch (\PDOException $e) {
        error_log('Erro ao criar produto: ' . $e->getMessage());
        return false;
    } catch (\Exception $e) {
        error_log('Erro de validação: ' . $e->getMessage());
        return false;
    }
}

public function buscarPorNomeExato(string $nome) {
    $db = \Database::getInstance()->getConnection();
    
    $stmt = $db->prepare("SELECT * FROM produtos WHERE nome = ?");
    $stmt->execute([$nome]);
    
    return $stmt->fetch(\PDO::FETCH_ASSOC); // retorna um único produto ou false se não existir
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