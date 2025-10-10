<?php
namespace App\Controllers;

require_once __DIR__ . '/../models/Produto.php';

class ProdutoController {
    /**
     * busca os produtos e decide qual view mostrar
     */
     public function listar() {
        $produtoModel = new \App\Models\Produto();
        
        // Verifica se o parâmetro 'plataforma' foi passado na URL
        if (isset($_GET['plataforma']) && !empty($_GET['plataforma'])) {
            $plataforma = $_GET['plataforma'];
            // Busca apenas os produtos da plataforma especificada
            $produtos = $produtoModel->listarPorPlataforma($plataforma);
            // Define um título dinâmico para a página
            $titulo = "Jogos " . htmlspecialchars($plataforma);
        } else {
            // Se nenhuma plataforma for especificada, busca todos os produtos
            $produtos = $produtoModel->listarTodos();
            // Define o título padrão
            $titulo = "Todos os Produtos";
        }
        
        require_once __DIR__ . '/../views/listar.php';
    }

    public function adicionar() {
        // carregar a view do formulário
        require_once __DIR__ . '/../views/adicionar.php';
    }

     public function salvar() {
        session_start();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
            $estoque = filter_input(INPUT_POST, 'estoque', FILTER_VALIDATE_INT);
            $desenvolvedora = filter_input(INPUT_POST, 'desenvolvedora', FILTER_SANITIZE_STRING);
            $genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING);
            $plataforma = filter_input(INPUT_POST, 'plataforma', FILTER_SANITIZE_STRING);

            // upload da imagem
            $caminhoImagemParaSalvar = null;
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $diretorioUploads = __DIR__ . '/../../public/images/uploads/';
                if (!is_dir($diretorioUploads)) { mkdir($diretorioUploads, 0777, true); }
                $nomeArquivo = uniqid() . '-' . basename($_FILES['imagem']['name']);
                $caminhoCompleto = $diretorioUploads . $nomeArquivo;
                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
                    $caminhoImagemParaSalvar = '../public/images/uploads/' . $nomeArquivo;
                } else {
                    $_SESSION['mensagem'] = "Erro ao mover o arquivo de imagem.";
                }
            } else {
                 $_SESSION['mensagem'] = "Erro no upload da imagem ou nenhum arquivo enviado.";
            }

            // Valida todos os campos
            if ($nome && $valor && $estoque !== false && $caminhoImagemParaSalvar && $desenvolvedora && $genero && $plataforma) {
                $produtoModel = new \App\Models\Produto();
                
                // parâmetros para o método criar na ordem correta
                $sucesso = $produtoModel->criar($nome, $valor, $estoque, $caminhoImagemParaSalvar, $desenvolvedora, $genero, $plataforma);
                
                if ($sucesso) {
                    $_SESSION['mensagem'] = "Produto cadastrado com sucesso!";
                } else {
                    $_SESSION['mensagem'] = "Erro ao cadastrar o produto no banco de dados.";
                }
            } else {
                if (!isset($_SESSION['mensagem'])) {
                    $_SESSION['mensagem'] = "Dados inválidos ou falha no upload da imagem. Preencha todos os campos.";
                }
            }

        }
        header('Location: ../public/roteador.php?controller=produto&action=listar');
        exit;

     }

      public function pesquisar() {
        $produtoModel = new \App\Models\Produto();

        // Captura o termo de busca
        $termo = $_GET['q'] ?? '';

        if (!empty($termo)) {
            $produtos = $produtoModel->pesquisarPorNome($termo);
            $titulo = "Resultados da busca por: " . htmlspecialchars($termo);
        } else {
            $produtos = $produtoModel->listarTodos();
            $titulo = "Lista de Produtos";
        }

        require __DIR__ . '/../views/listar.php';
    }

}
?>

