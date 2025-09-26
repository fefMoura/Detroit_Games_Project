<?php

// Pega o controller da URL, ou usa 'produto' como padrão
$controllerName = $_GET['controller'] ?? 'produto';
// Pega a ação da URL, ou usa 'listar' como padrão
$actionName = $_GET['action'] ?? 'listar';

// Constrói o nome completo da classe do controller
$controllerClassName = 'App\\Controllers\\' . ucfirst($controllerName) . 'Controller';

// Verifica se o arquivo do controller existe
$controllerFile = __DIR__ . '/../app/controllers/' . ucfirst($controllerName) . 'Controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Verifica se a classe e o método existem
    if (class_exists($controllerClassName) && method_exists($controllerClassName, $actionName)) {
        $controller = new $controllerClassName();
        $controller->$actionName();
    } else {
        echo "Erro: Ação ou Controller não encontrado.";
    }
} else {
    echo "Erro: Controller não encontrado.";
}
?>