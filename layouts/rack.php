<?php

function rack($books, $libsAction, $lib)
{
    if (isset($_POST["book"])) {
        $id = $_POST["book"];

        try {
        $libsAction->addToLib($_SESSION["user"]["id"], $id);} catch(Exception $e) {
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
            $content = '<a href="book.php?id=' . $book["id"] . '&page=' . $currentPage . '" class="btn btn-primary" role="button">Open</a>';
        } else {
            $content = '<input type="submit" value="Read" class="btn btn-success">';
        }

        echo '<div>
            <img class="rounded" src="';
        echo $book["image"];
        echo '" class="object-fit-cover" width="128" height="192" />
            <div style="width: 128px;">';
        if (strlen($book["name"] > 12)) {
            echo trim(substr($book["name"], 0, 12)) . "...";
        } else {
            echo $book["name"];
        };
        echo '</div>
            <div style="width: 128px;">
                <form action="';
        echo $_SERVER["PHP_SELF"];
        echo '" method="post" class="float-end pt-3">
                    <input type="text" hidden name="book" value=" ' . $book["id"] . '">
                    ' . $content . '
                </form>
            </div>
        </div>';
        if ($key == 4) echo '<div class="w-100"></div>';
    }
    echo '</div>';
}
