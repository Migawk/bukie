<?php
include __DIR__ . "/../helpers/dotenv.php";
include __DIR__ . "/../helpers/actions.php";
include __DIR__ . "/../helpers/db.php";
include __DIR__ . "/../helpers/db/books.php";

$booksAction = new Books();

header("Content-Type", "application/json");
if (isset($_GET["name"])) {
  echo '{ "res": ' . json_encode($booksAction->searchBook($_GET["name"])) . ', "status": "ok"}';
} else {
  echo '{ "status": "bad"}';
}
