<?php
namespace App\Controllers;

class AuthController {

    /**
     * Apenas exibe a página de login.
     */
    public function login() {
        require_once __DIR__ . '/../views/login.php';
    }

    /**
     * Processa os dados do formulário de login.
     */
    public function autenticar() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'] ?? '';
            $senha = $_POST['senha'] ?? '';

            // Lógica de autenticação simples, sem banco de dados
            if ($usuario === 'admin' && $senha === 'admin') {
                // Login de administrador bem-sucedido
                $_SESSION['usuario'] = 'admin';
                $_SESSION['role'] = 'admin'; // 'role' define o nível de acesso
                header('Location: ../app/views/index.php'); // Redireciona para a homepage
                exit;
            } elseif ($usuario === 'usuario' && $senha === 'usuario') {
                // Login de usuário comum bem-sucedido
                $_SESSION['usuario'] = 'usuario';
                $_SESSION['role'] = 'user';
                header('Location: ../app/views/index.php'); // Redireciona para a homepage
                exit;
            } else {
                // Credenciais inválidas
                $_SESSION['erro_login'] = 'Usuário ou senha inválidos.';
                header('Location: ../public/roteador.php?controller=auth&action=login');
                exit;
            }
        }
        // Se não for POST, apenas redireciona para a página de login
        header('Location: ../public/roteador.php?controller=auth&action=login');
        exit;
    }

    /**
     * Destrói a sessão e faz o logout do usuário.
     */
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../app/views/index.php'); // Redireciona para a homepage
        exit;
    }
}
