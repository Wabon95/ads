<?php

namespace App\Util;

abstract class Database {
    public static $pdo;

    public static function dbConnect() {
        try {
            if (!self::$pdo) {
                self::$pdo = new \PDO('mysql:host=' .DB_HOST. ';dbname=' .DB_NAME, DB_USER, DB_PASSWORD);
                self::$pdo->setAttribute(\PDO::ATTR_ERRMODE , \PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
                return self::$pdo;
            }
            return self::$pdo;
        } catch (\PDOException $e) {
            echo "Une erreur est survenue : <br>" . $e->getMessage();
        }
    }
}