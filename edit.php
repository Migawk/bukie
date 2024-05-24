<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <title>Bukie | Editing</title>
</head>

<body>
    <?php
    include "./layouts/header.php";

    $db = new DB();
    $books = $db->getAuthorsBooks($_SESSION["user"]["id"]);

    if(isset($_POST["create"])) {
        var_dump($db->createBook($_SESSION["user"]["id"], $_POST["name"],$_POST["url"], $_POST["description"]));
    }
    if (sizeof($_POST) > 0 && sizeof($_GET) > 0) {
        if (isset($_POST["add"])) {
            $db->pushPage($_GET["bookId"], sizeof($db->getPages($_GET["bookId"])));
        }
        if (isset($_POST["sub"])) {
            unset($_POST["sub"]);
            foreach ($_POST as $pageId => $page) {
                $db->updatePage($pageId, $page);
            }
        }
    }
    if ($books && !isset($_GET["bookId"])) {
        echo "<div class=\"row gap-5 px-5\">";
        foreach ($books as $bookNumber => $book) {
    ?>
            <div class="col-sm border d-flex flex-column align-items-center p-2 gap-2">
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
            if ($bookNumber == 1) {
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
    } else {
        echo '<form action="' . $_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"] . '" method="post"><div class="list d-flex flex-column gap-3">';
        $pages = $db->getPages($_GET["bookId"]);
        foreach ($pages as $pageNumber => $page) {
        ?>
            <div class="page d-flex gap-2 mx-5">
                <div class="number text-secondary">
                    <?php echo $pageNumber; ?>
                </div>
                <textarea class="border p-3 w-100 pageEditing" name="<?php echo $page["id"] ?>"><?php echo trim($page["content"]); ?></textarea>
            </div>
        <?php
        }
        ?>
        <div class="d-flex gap-2 position-fixed bottom-0 end-0 p-4">
            <button class="btn btn-primary" name="add">Add a page</button>
            <button class="btn btn-success" name="sub">Submit</button>
        </div>
    <?php
        echo '</div></form>';
    }
    ?>
</body>

</html>