<?php

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

require_once __DIR__ . '/../vendor/autoload.php';
include __DIR__ . "/../helpers/dotenv.php";
include __DIR__ . "/../helpers/actions.php";
include __DIR__ . "/../helpers/db.php";
include __DIR__ . "/../helpers/db/pages.php";
include __DIR__ . "/../helpers/db/books.php";
include __DIR__ . "/../helpers/db/users.php";
include __DIR__ . "/../helpers/db/libs.php";
include __DIR__ . "/../twig/extension.php";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// class CustomTwigExtension extends AbstractExtension
// {
//     public function getFunctions()
//     {
//         return [
//             new TwigFunction('custom_function', [$this, 'customFunction']),
//         ];
//     }

//     public function customFunction($arg1, $arg2)
//     {
//         // Your custom function logic here
//         return $arg1 . ' ' . $arg2;
//     }
// }

session_start();

$isUser = false;


if (isset($_SESSION["user"])) {
    $isUser = true;
}

if (!isset($_SESSION["user"])) {
    if (isset($_COOKIE["token"])) {
        $actions = new Actions();
        $token = $actions->verifyToken($_COOKIE["token"]);
        
        if($token instanceof Exception) {
            unset($_COOKIE["token"]);
        };
        
        $isUser = true;
    } else {
        $isUser = false;
        $_SESSION["user"] = null;
    }
}

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . "/../templates");
$twig = new \Twig\Environment($loader);


$customExtension = new CustomTwigExtension();
$twig->addExtension($customExtension);

?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./assets/css/style.css">
<link rel="stylesheet" href="./assets/css/custom.css">
<script defer src="../assets/js/preload.js">

</script>