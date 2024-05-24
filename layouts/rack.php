<div class="d-flex gap-3 flex-wrap mx-5 w-100">
    <?php
    if (isset($_POST["book"])) {
        $id = $_POST["book"];
        $db->addToLib($_SESSION["user"]["id"], $_POST["book"]);
    }

    foreach ($books as $key => $book) {
    ?>
        <div class="w20p">
            <img src="<?php echo $book["image"] ?>" class="bookPrev" width="128" height="192" />
            <div style="width: 128px;"><?php
                                        if (strlen($book["name"] > 12)) {
                                            echo trim(substr($book["name"], 0, 12)) . "...";
                                        } else {
                                            echo $book["name"];
                                        }
                                        ?></div>
            <div style="width: 128px;">
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post" class="float-end pt-3">
                    <input type="text" hidden name="book" value="<?php echo $book["id"] ?>">
                    <input type="submit" value="Add to fav" class="btn btn-success">
                </form>
            </div>
        </div>
        <?php if ($key == 4) echo '<div class="w-100"></div>' ?>

    <?php
    }
    ?>
</div>