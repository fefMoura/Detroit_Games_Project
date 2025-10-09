<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/Venda.php';

class VendaController {

    /**
     * Processa o registro de uma nova venda.
     */
    public function registrar() {
        session_start();

        if (!isset($_SESSION['usuario'])) {
            // Se não estiver logado, guarda uma mensagem de erro e redireciona para a página de login.
            $_SESSION['erro_login'] = "Você precisa estar logado para realizar uma compra.";
            header('Location: ../public/roteador.php?controller=auth&action=login');
            exit; // Interrompe a execução
        }

        // Se o usuário estiver logado, a lógica de compra continua normalmente...
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idProduto = filter_input(INPUT_POST, 'id_produto', FILTER_VALIDATE_INT);
            $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);

            if ($idProduto && $quantidade > 0) {
                $vendaModel = new \App\Models\Venda();
                $sucesso = $vendaModel->registrar($idProduto, $quantidade);

                if ($sucesso) {
                    $_SESSION['mensagem'] = "Compra realizada com sucesso!";
                } else {
                    $_SESSION['mensagem'] = "Erro ao registrar venda. Verifique o estoque.";
                }
            } else {
                $_SESSION['mensagem'] = "Dados inválidos.";
            }
        }
        
        // Redireciona de volta para a lista de produtos
        header('Location: ../public/roteador.php?controller=produto&action=listar');
        exit;
    }

    /**
     * Exibe o histórico de vendas do usuário.
     */
    public function historico() {
        session_start();
        
        if (!isset($_SESSION['usuario'])) {
            $_SESSION['erro_login'] = "Você precisa estar logado para ver o histórico de vendas.";
            header('Location: ../public/roteador.php?controller=auth&action=login');
            exit;
        }
        
        $vendaModel = new \App\Models\Venda();
        $vendas = $vendaModel->historico();
        
        require_once __DIR__ . '/../views/historico.php';
    }
}

