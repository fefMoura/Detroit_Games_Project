<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/Venda.php';

class VendaController {
    // Método para processar o formulário de nova venda
    public function registrar() {
        // Inicia a sessão para usar mensagens flash
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProduto = filter_input(INPUT_POST, 'id_produto', FILTER_VALIDATE_INT);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);

            if ($idProduto && $quantidade > 0) {
                $vendaModel = new \App\Models\Venda();
                $sucesso = $vendaModel->registrar($idProduto, $quantidade);

                if ($sucesso) {
                    $_SESSION['mensagem'] = "Venda registrada com sucesso!";
                } else {
                    $_SESSION['mensagem'] = "Erro ao registrar venda. Verifique o estoque.";
                }
            } else {
                $_SESSION['mensagem'] = "Dados inválidos.";
            }
        }
        
        // Redireciona de volta para a página de produtos
        header('Location: /index.php?controller=produto&action=listar');
        exit;
    }

    // Método para buscar e exibir o histórico de vendas
    public function historico() {
        $vendaModel = new \App\Models\Venda();
        $vendas = $vendaModel->historico();
        
        // Carrega a view passando o histórico
        require_once __DIR__ . '/../views/vendas/historico.php';
    }
}
?>