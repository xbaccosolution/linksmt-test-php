<?php
require_once __DIR__ . '/../Services/TokenService.php';

class AuthMiddleware
{
    public static function redirectIfAuthenticated($redirectUrl)
    {
        if (isset($_SESSION['token']) && TokenService::validateToken($_SESSION['token'])) {
            header("Location: $redirectUrl");
            exit;
        }
    }

    public static function redirectIfNotAuthenticated($redirectUrl)
    {
        if (!isset($_SESSION['token']) || !TokenService::validateToken($_SESSION['token'])) {
            header("Location: $redirectUrl");
            exit;
        }
    }

    /**
     * Valida il token dalla sessione.
     *
     * @return array|false Il payload del token se valido, false altrimenti.
     */
    public static function validateSessionToken()
    {
        // Verifica la presenza del token nella sessione
        if (!isset($_SESSION['token'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return false;
        }

        // Valida il token
        $token = $_SESSION['token'];
        $payload = TokenService::validateToken($token);

        if (!$payload) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid token']);
            return false;
        }

        return $payload;
    }
}
