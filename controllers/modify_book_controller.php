<?php
include('db_controller.php');

// Modification du livre
if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["genre"]) && isset($_POST["pages"])) {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $author = intval($_POST["author"]);
    $genre = intval($_POST["genre"]);
    $pages = intval($_POST["pages"]);
    $description = $_POST["description"];
    
    $sql = "UPDATE book SET book_title = :title, book_pages = :pages, author_id = :author, genre_id = :genre, book_description = :b_description WHERE book_id = :id";
    $statement = $connection->prepare($sql);
    $statement->execute([
        ':title' => $title, 
        ':pages' => $pages, 
        ':author' => $author, 
        ':genre' => $genre,
        ':id' => $id,
        ':b_description' => $description
    ]);
}

header("Location: ../book_infos.php?id=".$id);

?>