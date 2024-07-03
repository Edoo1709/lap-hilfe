<?php
// Configuration file for the database connection

$host = 'localhost'; // Because XAMPP sets the default host to localhost
$db = 'online_shop'; // Custom database name
$user = 'root'; // Because XAMPP sets the default username to root
$password = ''; // Because XAMPP sets the default password to an empty string

$dsn = "mysql:host=$host;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
