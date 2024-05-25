<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <title>Bukie | Editing</title>
</head>

<body>
    <script src="./assets/edit.js">

    </script>
    <?php
    include "./layouts/header.php";

    $db = new DB();
    $pagesAction = new Pages();
    $booksAction = new Books();

    $books = $booksAction->getAuthorsBooks($_SESSION["user"]["id"]);

    if (isset($_POST["name"])) {
        $booksAction->updateBook($_POST["name"], $_POST["description"], $_POST["image"], $_GET["bookId"]);
    ?>
        <article class="px-4">
            <h3>Main data is changed!</h3>
            <form action="edit.php?bookId=<?php $_GET["bookId"] ?>">
                <button class="btn btn-primary">Continue editing</button>
            </form>
        </article>
        <?php
        return;
    };
    if (isset($_POST["create"])) { // if customer wants to create
        var_dump($booksAction->createBook($_SESSION["user"]["id"], $_POST["name"], $_POST["url"], $_POST["description"]));
    }
    if (sizeof($_POST) > 0 && sizeof($_GET) > 0) { // post handling
        if (isset($_POST["add"])) {
            $pagesAction->pushPage($_GET["bookId"], sizeof($pagesAction->getPages($_GET["bookId"])));
        }
        if (isset($_POST["sub"])) {
            unset($_POST["sub"]);
            foreach ($_POST as $pageId => $page) {
                $pagesAction->updatePage($pageId, $page);
            }
        }
    }
    if ($books && !isset($_GET["bookId"])) { // default, list
        echo "<div class=\"row gap-5 px-5\">";
        foreach ($books as $bookNumber => $book) {
        ?>
            <div class="col-sm border d-flex flex-column align-items-center p-2 gap-2 rounded">
                <img src="<?php echo $book["image"] ?>" alt="<?php echo $book["name"] ?>" width="64">
                <div class="name d-flex flex-column align-items-center">
                    <p><?php
                        if (strlen($book["name"] > 12)) {
                            echo trim(substr($book["name"], 0, 12)) . "...";
                        } else {
                            echo $book["name"];
                        } ?>
                    </p>
                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="get">
                        <input type="text" hidden name="bookId" value="<?php echo $book["id"] ?>">
                        <button class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        <?php
            if ($bookNumber % 2) {
                echo '<div class="w-100"></div>';
            }
        }
        ?>
        <div class="col-sm border d-flex flex-column align-items-center p-2 gap-2">
            <div class="name d-flex flex-column align-items-center">
                <p>Create a new book</p>
                <form class="d-flex flex-column gap-2" action="<?php $_SERVER["PHP_SELF"] ?>" method="post">

                    <input class="form-control" type="text" name="url" placeholder="URL to image of the book">
                    <input class="form-control" type="text" name="name" placeholder="name of the book">
                    <textarea class="form-control" name="description" placeholder="Description"></textarea>
                    <input type="hidden" name="create">

                    <div class="buttons">
                        <button class="btn btn-success float-end">Create</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        if (sizeof($books) % 2 != true) {
            echo '<div class="col-sm"></div>';
        }
    } else { // book editing
        ?>
        <article>
            <?php
            echo '<form action="' . $_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"] . '" method="post">';
            $book = $booksAction->getBook($_GET["bookId"]);
            ?>
            <div class="list d-flex flex-column gap-3 px-4 mb-5">
                <script>
                    document.addEventListener("keyup", () => {
                        check('<?php echo htmlspecialchars($book["name"]) . "','" . htmlspecialchars($book["description"]) ?>');
                    })
                </script>
                <h2>Main information</h2>
                <div class="d-flex gap-2 align-items-center">
                    <label for="name" style="width: 6rem">Name: </label>
                    <input name="name" id="name" type="text" class="form-control" placeholder="name" value="<?php echo $book["name"] ?>">
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <label for="description" style="width: 6rem">Description:</label>
                    <input name="description" id="description" type="text" class="form-control" placeholder="description" value="<?php echo htmlspecialchars($book["description"]) ?>">
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <label for="image" style="width: 6rem">Image path: </label>
                    <input name="image" id="image" type="text" class="form-control" placeholder="image" value="<?php echo $book["image"] ?>">
                </div>
                <div><button class="btn btn-primary float-end" id="formSubmit" disabled>Change</button></div>
            </div>
            </form>
            <?php
            echo '<form action="' . $_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"] . '" method="post">
            <div class="list d-flex flex-column gap-3">
            <h2 class="mx-4">Pages</h2>';
            $pages = $pagesAction->getPages($_GET["bookId"]);
            foreach ($pages as $pageNumber => $page) {
            ?>
                <div class="page d-flex gap-2 me-5" id="page<?php echo $pageNumber ?>">
                    <div style="width: 4.66rem" class="number text-secondary d-flex flex-column align-items-end">
                        <p><?php echo $pageNumber; ?>
                        </p>
                        <?php
                        if ($pageNumber == sizeof($pages) - 1) {
                            echo '
                            <button type="button" onclick="deletePage(' . $pageNumber . ', ' . $_GET["bookId"] . ')" class="btn btn-danger deletePage" style="font-size: .5rem">
                                Delete
                            </button>';
                        } ?>
                    </div>
                    <textarea class="border p-3 w-100 pageEditing rounded" name="<?php echo $page["id"] ?>"><?php echo trim($page["content"]); ?></textarea>
                </div>
            <?php
            }
            echo "</article>";
            ?>
            <div class="d-flex gap-2 position-fixed bottom-0 end-0 p-4">
                <button type="button" class="btn btn-primary" name="add" onclick="addPage(<?php echo $_GET["bookId"] ?>)">Add a page</button>
                <button class="btn btn-success" name="sub">Submit</button>
            </div>
        <?php
        echo '</div></form>';
    }
        ?>
</body>

</html>