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
}
?>