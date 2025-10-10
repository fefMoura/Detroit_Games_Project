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

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../public/roteador.php?controller=produto&action=listar');
        exit;
    }

    // captura entradas
    $nome = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING));
    $valor = filter_input(INPUT_POST, 'valor', FILTER_VALIDATE_FLOAT);
    $estoque = filter_input(INPUT_POST, 'estoque', FILTER_VALIDATE_INT);
    $desenvolvedora = trim(filter_input(INPUT_POST, 'desenvolvedora', FILTER_SANITIZE_STRING));
    $genero = trim(filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING));
    $plataforma = trim(filter_input(INPUT_POST, 'plataforma', FILTER_SANITIZE_STRING));
    $jogoExiste = isset($_POST['jogoExiste']) && $_POST['jogoExiste'];

    $produtoModel = new \App\Models\Produto();
    $produtoExistente = $produtoModel->buscarPorNomeExato($nome);

    // processa upload SOMENTE se arquivo enviado
    $caminhoImagemParaSalvar = null;
    if (!$jogoExiste && !$produtoExistente) {
        if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['mensagem'] = "É necessário enviar uma imagem para novos produtos.";
            header('Location: ../public/roteador.php?controller=produto&action=adicionar');
            exit;
        }
        $diretorioUploads = __DIR__ . '/../../public/images/uploads/';
        if (!is_dir($diretorioUploads)) mkdir($diretorioUploads, 0777, true);
        $nomeArquivo = uniqid() . '-' . basename($_FILES['imagem']['name']);
        $caminhoCompleto = $diretorioUploads . $nomeArquivo;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto);
        $caminhoImagemParaSalvar = '../public/images/uploads/' . $nomeArquivo;
    }

    if ($jogoExiste || $produtoExistente) {
        // Atualizar estoque: exige apenas nome + estoque
        if (empty($nome) || $estoque === false || $estoque === null) {
            $_SESSION['mensagem'] = "Nome e quantidade (estoque) são obrigatórios para atualizar estoque.";
        } else {
            $produtoModel->criar($nome, 0.0, (int)$estoque, null, null, null, null);
            $_SESSION['mensagem'] = "Estoque atualizado com sucesso!";
        }
    } else {
        // novo produto: exige todos os campos + imagem
        if (empty($nome) || $valor === false || $estoque === false || empty($desenvolvedora) || empty($genero) || empty($plataforma) || empty($caminhoImagemParaSalvar)) {
            $_SESSION['mensagem'] = "Dados inválidos. Preencha todos os campos obrigatórios para cadastrar um novo produto.";
        } else {
            $produtoModel->criar($nome, $valor, $estoque, $caminhoImagemParaSalvar, $desenvolvedora, $genero, $plataforma);
            $_SESSION['mensagem'] = "Produto cadastrado com sucesso!";
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

