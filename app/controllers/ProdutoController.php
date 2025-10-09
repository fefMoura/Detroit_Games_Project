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

    public function adicionar() {
        // carregar a view do formulário
        require_once __DIR__ . '/../views/adicionar.php';
    }

     public function salvar() {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //coleta e limpa os dados
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
            $estoque = filter_input(INPUT_POST, 'estoque', FILTER_VALIDATE_INT);
            $imagem = filter_input(INPUT_POST, 'imagem', FILTER_SANITIZE_STRING);

            //Valida dados 
            if ($nome && $valor && $estoque !== false && $imagem) {
                $produtoModel = new \App\Models\Produto();
                
            
                $sucesso = $produtoModel->criar($nome, $valor, $estoque, $imagem);
                
                if ($sucesso) {
                    $_SESSION['mensagem'] = "Produto cadastrado com sucesso!";
                } else {
                    $_SESSION['mensagem'] = "Erro ao cadastrar o produto no banco de dados.";
                }
            } else {
                $_SESSION['mensagem'] = "Dados inválidos. Por favor, preencha todos os campos corretamente.";
            }
            header('Location: /Detroit_Games_Project/public/roteador.php?controller=produto&action=listar');
            exit;
        }
    }


}
?>

