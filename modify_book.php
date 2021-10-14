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

$sql_author = "SELECT * FROM author";
$sql_genre = "SELECT * FROM literary_genre";

$statement = $connection->query($sql_author);
$authors = $statement->fetchAll(PDO::FETCH_OBJ);
$statement->closeCursor();

$statement = $connection->query($sql_genre);
$genres = $statement->fetchAll(PDO::FETCH_OBJ);
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('partials/head.php'); ?>
</head>
<body>
    <div class="wrapper">
        <a href="index.php"><-- Retour</a>
        <!-- <pre><?php print_r($book) ?></pre> -->
        <!-- <pre><?php print_r($authors) ?></pre> -->
        <h3>Modifier le livre</h3>
        <div class="form-book">
            <form action="controllers/modify_book_controller.php" method="POST">
                <input name="id" value="<?= $id ?>" type="hidden">
                <input type="text" name="title" value="<?= $book[0]->book_title; ?>">

                <div class="horizontal">
                    <fieldset>
                        <legend>Auteur</legend>
                        <select name="author" id="author">
                        <?php foreach($authors as $author): ?>
                            <option value="<?= $author->author_id ?>"><?= $author->author_name . " " . $author->author_lastname; ?></option>
                        <?php endforeach ?>
                    </select>
                    </fieldset>

                    <fieldset>
                        <legend>Genre</legend>
                        <select name="genre" id="genre">
                        <?php foreach($genres as $genre): ?>
                            <option value="<?= $genre->genre_id ?>"><?= $genre->genre_name ?></option>
                        <?php endforeach ?>
                    </select>
                    </fieldset>
                </div>

                <input type="text" name="pages" value="<?= $book[0]->book_pages; ?>">
                <textarea name="description" id="" cols="30" rows="10" placeholder="Résumé"><?= $book[0]->book_description ?></textarea>
                <input type="submit" value="Valider">
            </form>
        </div>
    </div>
</body>
</html>