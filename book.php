<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <title>Bukie | Auth</title>
</head>
<?php

$db = new DB();
$pagesAction = new Pages();
$booksAction = new Books();

$bookInfo;
parse_str($_SERVER["QUERY_STRING"], $bookInfo);

$book = $booksAction->getBook($bookInfo["id"]);
$pages = $pagesAction->getPages($bookInfo["id"]);

function changePage($bookInfo, $direction)
{
    if ($direction == "prev") {
        echo $_SERVER["PHP_SELF"] . "?id=" . $bookInfo["id"] . "&page=" . $bookInfo["page"] - 1;
    } else {
        echo $_SERVER["PHP_SELF"] . "?id=" . $bookInfo["id"] . "&page=" . $bookInfo["page"] + 1;
    }
}

?>

<body>
    <?php include "./layouts/header.php";
    if (!isset($book)) {
        echo "There isn't the book";
    } else {
        $progress = ($bookInfo["page"] / $book["pages_amount"]) * 100;
        if ($progress > 100) $progress = 100;

        $pagesAction->setPage(
            $_SESSION["user"]["id"],
            $book["id"],
            $bookInfo["page"],
            $progress
        );
    } ?>
    <article class="p-5">
        <section class="bookInfo">
            <div class="mainContent d-flex align-items-center gap-3">
                <div class="left">
                    <img src="<?php echo $book["image"] ?>" alt="<?php echo $book["name"] ?>" width="64">
                </div>
                <div class="right">
                    <div class="name">
                        <h4>
                            <?php echo $book["name"] ?>
                        </h4>
                    </div>
                </div>
            </div>
            <hr>
        </section>
        <section class="content">
            <?php
            if (!isset($pages[$bookInfo["page"]]["content"])) {
                echo "Empty";
            } else {
                echo str_replace("\n", "<br>", $pages[$bookInfo["page"]]["content"]);
            }
            ?>
        </section>
        <section class="nav position-fixed bottom-0 start-0 p-4">
            <a class="btn btn-secondary" href="<?php changePage($bookInfo, "prev") ?>">Previous</a>
            &nbsp;
            <a class="btn btn-primary" href="<?php changePage($bookInfo, "next") ?>">Next</a>
        </section>
        <section class=" pagesAmount position-fixed bottom-0 end-0 p-4">
            <?php echo $bookInfo["page"] . "/" . $book["pages_amount"] ?>
        </section>
    </article>
</body>

</html>