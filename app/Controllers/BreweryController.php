<?php
require_once __DIR__ . '/../Services/ApiService.php';

class BreweryController
{
    private $payload;

    public function __construct()
    {
        // Valida il token e ottieni il payload
        $this->payload = AuthMiddleware::validateSessionToken();
        if (!$this->payload) {
            exit; // Interrompe l'esecuzione se il token non è valido
        }
    }

    public static function showBreweriesPage()
    {
        require_once __DIR__ . '/../Views/breweries.php';
    }

    public static function fetchTotalBreweries()
    {
        // Chiamata al servizio API
        $breweries = ApiService::fetchTotalBreweries();

        // Restituisce i dati JSON
        header('Content-Type: application/json');
        echo json_encode($breweries);
    }

    public static function fetchBreweries()
    {
        $page = $_GET['page'] ?? 1; // Numero di pagina (default: 1)
        $perPage = $_GET['per_page'] ?? 10; // Numero di birrerie per pagina (default: 10)

        // Chiamata al servizio API
        $breweries = ApiService::fetchBreweries($page, $perPage);

        // Restituisce i dati JSON
        header('Content-Type: application/json');
        echo json_encode($breweries);
    }

    public static function fetchSingleBrewery($id)
    {
        $brewery = ApiService::fetchSingleBrewery($id);

        if ($brewery) {
            header('Content-Type: application/json');
            echo json_encode($brewery);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Brewery not found']);
        }
    }
}
