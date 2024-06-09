<?php
include __DIR__ . "/../helpers/dotenv.php";
include __DIR__ . "/../helpers/actions.php";
include __DIR__ . "/../helpers/db.php";
include __DIR__ . "/../helpers/db/pages.php";

$pagesAction = new Pages();

header("Content-Type: application/json");

if (!isset($_COOKIE["token"])) {
    return header("HTTP/1.1 403");
}
$body = json_decode(file_get_contents("php://input"), true);

function returnBody($code)
{
    header("HTTP/1.1 " . $code);
}

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST": {
            if (isset($body["book_id"]) && isset($body["number"])) {
                try {
                    $res = $pagesAction->pushPage($body["book_id"], $body["number"]);
                    echo '{"status": "ok", "body": ' . json_encode($res) . '}';
                } catch (Exception $e) {
                    echo '{"status": "bad", "message": "' . $e->getMessage() . '"}';
                    returnBody(400);
                }
            } else {
                returnBody(422);
            }
            break;
        }
    case "DELETE": {
            if (isset($body["book_id"]) && isset($body["number"])) {
                $res = $pagesAction->deletePage($body["book_id"], $body["number"]);
                if ($res == 1) {
                    returnBody(204);
                } else {
                    returnBody(400);
                    echo '{"status": "bad"}';
                };
            } else {
                returnBody(422);
            }
            break;
        }
    default:
        header("HTTP/1.1 405");
        break;
}
