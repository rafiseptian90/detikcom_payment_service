<?php

require_once 'config/Connection.php';

use Config\MySQLConnection;

try {
    $pdo = MySQLConnection::init();
    $pdo->exec(file_get_contents(dirname(__FILE__) . "/dump.sql"));

    echo "Successfully dump sql file !" . PHP_EOL;
} catch(\PDOException $e) {
    echo "Error : " . $e->getMessage() . PHP_EOL;
    exit(1);
}

exit(1);
