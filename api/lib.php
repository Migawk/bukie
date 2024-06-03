<?php
include __DIR__ . "/../helpers/dotenv.php";
include __DIR__ . "/../helpers/actions.php";
include __DIR__ . "/../helpers/db.php";
include __DIR__ . "/../helpers/db/libs.php";
session_start();

$libsAction = new Libs();
$method = $_SERVER["REQUEST_METHOD"];
$user = $_SESSION["user"];

if($method == "POST" && isset($_POST["bookId"]) && $user) {
    header("Content-Type", "application/json");
    $libsAction->addToLib($user["id"], $_POST["bookId"]);
    echo '{"status": "ok"}';
} else {
    print_r($method ."\n");
    print_r($_POST);
    print_r($user);
};