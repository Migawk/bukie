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
    echo $twig->render("header.twig", ["user" => $_SESSION["user"], "location" => $_SERVER["PHP_SELF"]]);

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
        echo "<article class=\"row gx-5 gy-3 px-5 py-4 mw-100\">";

        foreach ($books as $bookNumber => $book) {
            echo $twig->render("bookEmbed.twig", ["book" => $book, "mode" => "author"]);
        }
        echo "</article>";
    } else { // book editing
    ?>
        <main class="d-flex gap-4 px-5 py-4">
            <aside class="d-flex flex-column gap-4">
                <div class="box bg-lighted rounded p-2 d-flex flex-column gap-2">
                    <h3>Pages</h3>
                    <p>Nothing to update.</p>
                    <div class="d-flex justify-content-end gap-2">
                        <button disabled class="btn btn-danger">Discard</button>
                        <button disabled class="btn btn-success">Update</button>
                    </div>
                </div>
                <div class="box bg-lighted rounded p-2 d-flex flex-column gap-2">
                    <h3>Jump to page</h3>
                    <div class="d-flex gap-2">
                        <div class="number d-flex justify-content-center align-items-center bg-dark w-min rounded">
                            <button class="btn btn-dark" onclick="decr()">
                                -
                            </button>
                            <input
                            type="number"
                            name="page"
                            class="text-center bg-dark text-primary" value="0" id="pointer" style="width: 32px; border: none; outline: none">
                            <button class="btn btn-dark" onclick="incr()">
                                +
                            </button>
                            <script>
                                const pointer = document.getElementById("pointer");
                                const decr = () => pointer.value = Number(--pointer.value);
                                const incr = () => pointer.value = Number(++pointer.value);

                            </script>
                        </div>
                        <button class="btn btn-warning">Jump</button>

                    </div>
                </div>
                <div class="box bg-lighted rounded p-2 d-flex flex-column gap-2">
                    <h3>Edit main info</h3>
                    <div class="d-flex justify-content-end gap-2">
                        <div disabled class="btn btn-warning">Edit</div>
                    </div>
                </div>

            </aside>
            <article class="w-100 bg-lighted rounded p-2">123</article>
        </main>
    <?php
    }
    echo $twig->render('footer.twig');
    ?>
</body>

</html>