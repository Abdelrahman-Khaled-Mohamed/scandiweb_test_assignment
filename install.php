<?php

/**
 * Open a connection via PDO to create a new database and table with structure.
 *
 */

require "config.php";

try {
    $connection = new PDO("mysql:host=$host", $username, $password, $options);
    
    $connection->exec(file_get_contents("data/init.sql"));
    
    echo "Database and tables created successfully.";
} catch(Exception $e) {
    error_log($e->getMessage());
}
