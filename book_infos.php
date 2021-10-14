<?php 
include('controllers/db_controller.php');
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM book 
        INNER JOIN author ON book.author_id = author.author_id 
        INNER JOIN literary_genre ON book.genre_id = literary_genre.genre_id
        WHERE book_id = :id";
    $statement = $connection->prepare($sql);
    $statement->execute([":id" => $id]);
    $book = $statement->fetchAll(PDO::FETCH_OBJ);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('partials/head.php'); ?>
</head>
<body>
    <div class="wrapper">
        <?php require('partials/header.php'); ?>
        <a href="index.php"><-- Retour</a>
        <hr>
        
        <h3><?= $book[0]->book_title ?></h3>
        <p><b>Auteur : </b><?= ucwords($book[0]->author_name) . " " . ucwords($book[0]->author_lastname); ?></p>
        <p><b>Genre : </b><?= ucwords($book[0]->genre_name) ?></p>
        <p><b>Nombre de pages : </b><?= $book[0]->book_pages ?></p>
        <p><b>Résumé : </b><?= $book[0]->book_description ?></p>
        <hr>

        <div id="infos-link">
            <a href="modify_book.php?id=<?= $book[0]->book_id ?>">Modifier</a>
            <a onclick="return confirm('Êtes vous sur de vouloir supprimer ce livre')" href="controllers/del_book_controller.php?id=<?= $id ?>">Supprimer</a>
        </div>
    </div>
</body>
</html>