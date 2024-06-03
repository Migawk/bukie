<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <title>Bukie | books</title>
</head>

<body>
    <?php
    echo $twig->render("header.twig", ["user" => $_SESSION["user"], "location" => $_SERVER["PHP_SELF"]]);
    if (!$isUser) {
        echo "<p class=\"p-4\">You have to <a href=\"auth.php\">authorize</a>.</p>";
        return;
    }

    $db = new DB();
    $libsActions = new Libs();
    $books = $libsActions->getLib($_SESSION["user"]["id"]);

    function getPage($book)
    {
        $page = $book["progress"] / 100 * $book["bookPages"];
        if (gettype($page) == "double") {
            $page = round($page);
        }
        return $page;
    }
    function changeBookKeys($book) {
        return [
            ...$book,
            "id"=>$book["bookId"],
            "img"=>$book["bookImg"],
            "name"=>$book["bookName"],
            "description"=>$book["bookDescription"],
            "progress"=>$book["progress"]
        ];
    }

    if (isset($_POST["delete"])) {
        $libsActions->deleteLib($_SESSION["user"]["id"], $_POST["id"]);
    }
    ?>
    <article class="list row gx-5 gy-3 px-5 py-2 mw-100">
        <?php
        if (sizeof($books) == 0) {
            echo '<p>You have got an empty list.<br>You can find books at <a href="search.php">Find More</a>.</p>';
            return;
        }
        foreach ($books as $bookNum => $book) {
            $newBook = changeBookKeys($book);

            echo $twig->render(
                "bookEmbed.twig",
                [
                    "book"=>$newBook,
                    "currentPage"=>getPage($book),
                    "PHP_SELF"=>$_SERVER["PHP_SELF"]
                ]
            );
        } ?>
    </article>
    <?php 
    echo $twig->render("footer.twig");
    ?>
</body>

</html>