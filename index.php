<?php 
include('controllers/db_controller.php');
$order = "";
if (isset($_GET["order"])) {
    if ($_GET["order"] === "title") {
        $order = "book_title";
    } elseif ($_GET["order"] === "author") {
        $order = "author_name";
    } elseif ($_GET["order"] === "genre") {
        $order = "genre_name";
    } else {
        $order = "book_title";
    }
} else {
    $order = "book_title";
}

$sql_book = "SELECT * FROM book 
    INNER JOIN author ON book.author_id = author.author_id 
    INNER JOIN literary_genre ON book.genre_id = literary_genre.genre_id 
    ORDER BY " . $order;

$sql_author = "SELECT * FROM author";
$sql_genre = "SELECT * FROM literary_genre";

$statement = $connection->query($sql_book);
$books = $statement->fetchAll(PDO::FETCH_OBJ);
$statement->closeCursor();

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
        <?php require('partials/header.php'); ?>
        <details class="form-book">
            <summary>Ajouter un livre</summary>
            <form action="controllers/add_book_controller.php" method="POST">
                <input type="text" name="title" placeholder="Titre">

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

                <input type="text" name="pages" placeholder="Nombre de pages">
                <textarea name="description" id="" cols="30" rows="10" placeholder="Résumé"></textarea>
                <input type="submit" value="Valider">
            </form>
        </details>

        <h3>Bibliothèque</h3>
        <div id="button" class=hozizontal>
            <a class="a-button" href="index.php?order=title">Titre</a>
            <a class="a-button" href="index.php?order=author">Auteur</a>
            <a class="a-button" href="index.php?order=genre">Genre</a>
        </div>
        <?php foreach ($books as $id => $book): ?>
            <a href="book_infos.php?id=<?= $book->book_id ?>">
                <?php if ($id % 2 === 0): ?>
                <div class="book-row even-color">
                <?php else: ?> 
                <div class="book-row odd-color">
                <?php endif ?>
                    <div class="book-row-block">
                        <p><b><?php echo $book->book_title; ?></b></p>
                        <p><?php echo ucwords($book->author_name); ?> <?php echo ucwords($book->author_lastname); ?></p>
                    </div>
                    <div>
                        <p><?php echo ucwords($book->genre_name); ?></p>
                    </div>
                </div>
            </a>
        <?php endforeach ?>
    </div>
</body>
</html>