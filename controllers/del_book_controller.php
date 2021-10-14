<?php
require('db_controller.php');

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM book WHERE book_id = :id";

    $stmt = $connection->prepare($sql);
    $stmt->execute(array(
        ':id' => $id
    ));    
}

header("Location: ../index.php")
?>