<?php
// require __DIR__ . "/helpers/core.php";

$request =  explode("/",substr($_SERVER['REQUEST_URI'], 1));
$gate = $request[0];
$params = array_slice($request, 1);

switch ($gate) {
	case "":
		require __DIR__ . '/views/index.php';
		break;
	case "search":
		require __DIR__ . '/views/search.php';
		break;
	case "auth":
		require __DIR__ . '/views/search.php';
		break;
	case "book":
		require __DIR__ . '/views/book.php';
		break;
	case "edit":
		require __DIR__ . '/views/edit.php';
		break;
	case "search":
		require __DIR__ . '/views/search.php';
		break;
	case "user":
		require __DIR__ . '/views/user.php';
		break;
	case "my":
		require __DIR__ . '/views/my.php';
		break;
	default:
		http_response_code(404);
		require __DIR__ . '/views/404.php';
		break;
}
?>