<?php
include __DIR__ . "/../helpers/dotenv.php";
include __DIR__ . "/../helpers/actions.php";
include __DIR__ . "/../helpers/db.php";
include __DIR__ . "/../helpers/db/libs.php";
include __DIR__ . "/../helpers/text.php";
session_start();

$libsAction = new Libs();
$actions = new Actions();

$method = $_SERVER["REQUEST_METHOD"];

if (!isset($_SESSION["user"]) && isset($_COOKIE["token"])) {
    $user = json_decode(json_encode($actions->verifyToken($_COOKIE["token"])), true);
} else {
    $user = $_SESSION["user"];
}
if (strpos($_SERVER['REQUEST_URI'], "status")) {
    header("Content-Type", "application/json");

    switch ($method) {
        case "PUT":
            // INT bookId
            // FLOAT progress
            $data = json_decode(file_get_contents('php://input'), true);
            if (!isset($user)) {
                http_response_code(403);
                return;
            }
            if (!isset($data["bookId"]) || !isset($data["progress"])) {
                http_response_code(422);
                echo json_encode(["msg" => "wrong body", "required" => ["bookId" => "number", "progress" => "float"]]);
                return;
            };

            if($libsAction->setRead($user["id"], $data["bookId"], $data["progress"])) {
                http_response_code(200);
                echo '{"status": "ok"}';
            } else {
                http_response_code(500);
                echo '{"status": "bad"}';
            }


            break;
        default:
            http_response_code(405);
            echo '{"status": "bad"}';
            break;
    }
} else {
    if ($method == "POST" && isset($_POST["bookId"]) && $user) {
        header("Content-Type", "application/json");
        $libsAction->addToLib($user["id"], $_POST["bookId"]);
        echo '{"status": "ok"}';
    } else {
        print_r($method . "\n");
        print_r($_POST);
        print_r($user);
    };
}
