<?php
require_once __DIR__ . '/config.php';

class Database
{
    private static $connection = null;

    /**
     * Restituisce una connessione PDO al database.
     *
     * @return PDO La connessione al database.
     */
    public static function getConnection()
    {
        if (self::$connection === null) {
            self::$connection = new PDO(DSN, DB_USER, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }
        return self::$connection;
    }
}
