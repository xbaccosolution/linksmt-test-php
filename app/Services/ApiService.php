<?php

class ApiService
{
    public static function fetchTotalBreweries()
    {
        $apiUrl = "https://api.openbrewerydb.org/v1/breweries/meta";
        $response = file_get_contents($apiUrl);

        if ($response === false) {
            http_response_code(500);
            return ['error' => 'Failed to fetch breweries'];
        }

        return json_decode($response, true); // Decodifica la risposta JSON in un array
    }

    public static function fetchBreweries($page, $perPage)
    {
        $apiUrl = "https://api.openbrewerydb.org/breweries?page={$page}&per_page={$perPage}";
        $response = file_get_contents($apiUrl);

        if ($response === false) {
            http_response_code(500);
            return ['error' => 'Failed to fetch breweries'];
        }

        return json_decode($response, true); // Decodifica la risposta JSON in un array
    }

    public static function fetchSingleBrewery($id)
    {
        $apiUrl = "https://api.openbrewerydb.org/breweries/{$id}";
        $response = file_get_contents($apiUrl);

        if ($response === false) {
            return null;
        }

        return json_decode($response, true);
    }
}
