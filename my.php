<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <title>Bukie | books</title>
</head>

<body>
    <?php include "./layouts/header.php";
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

    if (isset($_POST["delete"])) {
        $libsActions->deleteLib($_SESSION["user"]["id"], $_POST["id"]);
    }
    ?>
    <div class="list row p-4 gap-4">
        <?php
        if (sizeof($books) == 0) {
            echo '<p>You have got an empty list.<br>You can find books at <a href="search.php">Find More</a>.</p>';
            return;
        }
        foreach ($books as $bookNum => $book) {
        ?>
            <div class="book border rounded col-sm">
                <div class="main d-flex flex-column justify-content-between p-4 gap-4 h-100">
                    <div class="mainContent d-flex justify-content-between align-items-center h-100">
                        <div class="d-flex align-items-center gap-5">
                            <div class="left">
                                <a href="book.php?id=<?php echo $book["bookId"] ?>&page=<?php echo getPage($book) ?>">
                                    <img src="<?php echo $book["bookImg"] ?>" class="rounded" alt="<?php echo $book["bookName"] ?>" width="128">
                                </a>
                            </div>
                            <div class="right">
                                <div class="name">
                                    <h2>
                                        <a href="book.php?id=<?php echo $book["bookId"] ?>&page=<?php echo getPage($book) ?>"><?php echo $book["bookName"] ?></a>
                                    </h2>
                                </div>
                                <div class="name text-secondary">
                                    <i>''<?php echo $book["bookDescription"] ?>''</i>
                                </div>
                            </div>
                        </div>
                        <form class="actions" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $book["bookId"] ?>">
                            <input type="hidden" name="delete">
                            <button class="btn btn-danger btn-lg">Delete</button>
                        </form>
                    </div>
                    <div class="progress" style="height: 6px">
                        <div class="progress-bar border-end border-light border-4" role="progressbar" style="width: <?php echo $book["progress"] ?>%;">
                        </div>
                    </div>
                </div>
            </div>
        <?php
        } ?>
    </div>
</body>

</html>