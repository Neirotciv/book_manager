<?php
$dsn = 'mysql:host=localhost;dbname=book_manager';
$username = "root";
$password = "victorien";
$options = [];

try {
    $connection = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage() . "<br>";
    die();
}
?>