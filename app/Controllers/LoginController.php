<?php
require_once __DIR__ . '/../Models/UserModel.php';
require_once __DIR__ . '/../Services/TokenService.php';

class LoginController
{
    public static function showLoginPage()
    {
        require_once __DIR__ . '/../Views/login.php';
    }

    public static function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        // Sanificazione
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

        // Verifica credenziali
        $user = UserModel::findByUsername($username);
        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['token'] = TokenService::generateToken($user['id']);
            echo json_encode(['token' => $_SESSION['token']]); // Invia il token al client
            return;
        }

        http_response_code(401);
        echo json_encode(['error' => 'Invalid credentials']);
    }
}
