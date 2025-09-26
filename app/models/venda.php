<?php
namespace App\Models;

require_once __DIR__ . '/../../config/database.php';

class Venda {
    // Registra uma nova venda e atualiza o estoque
    public function registrarVenda(int $idProduto, int $quantidade) {
        $db = \Database::getInstance()->getConnection();

        try {
            // Inicia uma transação para garantir que ambas as operações funcionem
            $db->beginTransaction();

            // 1. Buscar o produto para obter o valor e o estoque
            $stmt = $db->prepare("SELECT valor, estoque FROM produtos WHERE id = ?");
            $stmt->execute([$idProduto]);
            $produto = $stmt->fetch();

            if (!$produto || $produto['estoque'] < $quantidade) {
                // Se o produto não existe ou não há estoque suficiente, cancela
                $db->rollBack();
                return false; 
            }

            // 2. Calcular o valor total da venda
            $valorTotal = $produto['valor'] * $quantidade;
            
            // 3. Dar baixa no estoque (UPDATE)
            $novoEstoque = $produto['estoque'] - $quantidade;
            $stmtUpdate = $db->prepare("UPDATE produtos SET estoque = ? WHERE id = ?");
            $stmtUpdate->execute([$novoEstoque, $idProduto]);
            
            // 4. Inserir o registro da venda (INSERT)
            $stmtInsert = $db->prepare("INSERT INTO vendas (id_produto, quantidade, valor_total) VALUES (?, ?, ?)");
            $stmtInsert->execute([$idProduto, $quantidade, $valorTotal]);
            
            // Se tudo deu certo, confirma a transação
            $db->commit();
            return true;

        } catch (\PDOException $e) {
            // Se algo deu errado, desfaz tudo
            $db->rollBack();
            error_log('Erro ao registrar venda: ' . $e->getMessage());
            return false;
        }
    }
    
    // Lista o histórico de vendas
    public function historico() {
        $db = \Database::getInstance()->getConnection();
        // Usamos JOIN para buscar o nome do produto junto com os dados da venda
        $query = $db->query("
            SELECT v.id, p.nome, v.quantidade, v.valor_total, v.data_venda 
            FROM vendas v
            JOIN produtos p ON v.id_produto = p.id
            ORDER BY v.data_venda DESC
        ");
        return $query->fetchAll();
    }
}
?>