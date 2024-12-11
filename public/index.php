<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/Controllers/LoginController.php';
require_once __DIR__ . '/../app/Controllers/BreweryController.php';
require_once __DIR__ . '/../app/Middleware/AuthMiddleware.php';

session_start();

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

// Gestione delle rotte
if ($requestUri === '/' || $requestUri === '/login') {
    AuthMiddleware::redirectIfAuthenticated('/breweries');
    LoginController::showLoginPage();
} elseif ($requestUri === '/breweries') {
    AuthMiddleware::redirectIfNotAuthenticated('/login');
    BreweryController::showBreweriesPage();
} elseif ($requestUri === '/api/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    LoginController::login();
} elseif ($requestUri === '/api/breweries/total' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    AuthMiddleware::redirectIfNotAuthenticated('/login');
    BreweryController::fetchTotalBreweries();
} elseif ($requestUri === '/api/breweries' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    AuthMiddleware::redirectIfNotAuthenticated('/login');
    BreweryController::fetchBreweries();
} elseif (preg_match('#^/api/breweries/([\w-]+)$#', $requestUri, $matches) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    AuthMiddleware::redirectIfNotAuthenticated('/login');
    BreweryController::fetchSingleBrewery($matches[1]);
} elseif ($requestUri === '/logout' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    session_destroy(); // Elimina la sessione
    header('Location: /login'); // Reindirizza alla pagina di login
    exit;
} else {
    http_response_code(404);
    echo "Page not found.";
}
