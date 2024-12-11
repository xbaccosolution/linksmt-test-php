<?php


class UserModel
{
    /**
     * Trova un utente in base al nome utente.
     *
     * @param string $username Il nome utente da cercare.
     * @return array|false I dati dell'utente o false se non trovato.
     */
    public static function findByUsername($username)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
