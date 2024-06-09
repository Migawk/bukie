<?php

function rack($books, $libsAction, $lib)
{
    if (isset($_POST["book"])) {
        $id = $_POST["book"];

        try {
            $libsAction->addToLib($_SESSION["user"]["id"], $id);
        } catch (Exception $e) {
            echo "An error occured.";
        }
    }

    echo '<div class="d-flex gap-3 flex-wrap mx-5">';
    foreach ($books as $key => $book) {
        $index = array_search($book["id"], array_column($lib, "bookId"));
        $presence = is_numeric($index);
        if ($presence) {
            $currentPage = round($book["pages_amount"] * $lib[$index]["progress"] / 100);
        };

        if ($presence) {
            $content = '<a href="book.php?id=' . $book["id"] . '&page=' . $currentPage . '" class="btn btn-primary w-100" role="button">Open</a>';
        } else {
            $content = '<input type="submit" value="Read" class="btn btn-success w-100">';
        }

        echo '<div class="d-flex flex-column justify-content-center align-items-center">
            <img class="rounded object-fit-cover" src="' . $book["image"] . '" class="object-fit-cover" width="128" height="192" />
            ';
        if (strlen($book["name"]) > 12) {
            echo trim(substr($book["name"], 0, 12)) . "...";
        } else {
            echo '<p>' . $book["name"] . '</p>';
        };
        echo '<form class="w-100" action="'
            . $_SERVER["PHP_SELF"]
            . '" method="post" class="float-end pt-3">
                    <input type="text" hidden name="book" value=" ' . $book["id"] . '">
                    ' . $content . '
                </form>
        </div>';
    }
    echo '</div>';
}
