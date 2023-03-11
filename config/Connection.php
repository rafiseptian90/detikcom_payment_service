<?php

namespace Config;

use PDO;

class MySQLConnection {
    const DB_HOST = "127.0.0.1";
    const DB_PORT = 3030;
    const DB_USERNAME = "root";
    const DB_PASSWORD = "root";
    const DB_NAME = "detikcom_payment";

    /**
     * Initialize a database connection
     *
     * @return PDO
     */
    public static function init() : PDO
    {
        $dsn = sprintf("mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4", self::DB_HOST, self::DB_PORT, self::DB_NAME);
        $options = [
            // Throw exceptions when errors occur
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Set default fetch mode to object
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            // Ensure PDO uses real prepared statements to provides an additional layer of security against SQL injection
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            return new PDO($dsn, self::DB_USERNAME, self::DB_PASSWORD, $options);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }
}