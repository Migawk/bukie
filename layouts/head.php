<?php
include __DIR__ . "/../helpers/dotenv.php";
include __DIR__ . "/../helpers/actions.php";
include __DIR__ . "/../helpers/db.php";
include __DIR__ . "/../helpers/db/pages.php";
include __DIR__ . "/../helpers/db/books.php";
include __DIR__ . "/../helpers/db/users.php";
include __DIR__ . "/../helpers/db/libs.php";
session_start();

$isUser = false;


if (isset($_SESSION["user"])) {
    $isUser = true;
}

if (!isset($_SESSION["user"])) {
    if (isset($_COOKIE["token"])) {
        $actions = new Actions();
        $token = $actions->verifyToken($_COOKIE["token"]);
        var_dump($token);
        $isUser = true;
    } else {
        $isUser = false;
    }
}
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="./assets/style.css">