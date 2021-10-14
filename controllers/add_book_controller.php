<?php
include('db_controller.php');

// Insertion du livre
if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["genre"]) && isset($_POST["pages"]) && isset($_POST["description"])) {
    $title = $_POST["title"];
    $author = intval($_POST["author"]);
    $genre = intval($_POST["genre"]);
    $pages = intval($_POST["pages"]);
    $description = $_POST["description"];
    
    $sql = "INSERT INTO book (book_title, book_pages, author_id, genre_id, book_description) VALUES (:title, :pages, :author, :genre, :description)";
    $statement = $connection->prepare($sql);
    $statement->execute([
        ':title' => $title, 
        ':pages' => $pages, 
        ':author' => $author, 
        ':genre' => $genre,
        ":description" => $description
    ]);
}

header("Location: ../index.php");

?>