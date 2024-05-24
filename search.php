<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <title>Bukie | Search</title>
</head>

<?php
$db = new DB();
$popularBooks = $db->getAllBooks();

if (isset($_GET["q"])) {
    $books = $db->searchBook($_GET["q"]);
}

function fill($field)
{
    if (isset($_GET[$field])) {
        echo $_GET[$field];
    }
}
?>

<body>
    <?php include "./layouts/header.php"; ?>
    <article>
        <section>
            <form class="d-flex w-75 gap-2" action="<?php $_SERVER["PHP_SELF"] ?>" method="get">
                <input class="form-control" type="text" name="q" placeholder="Query..." value="<?php fill("q") ?>">
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
        </section>
        <section>
            <?php
            if (!isset($_GET["q"])) {

                echo "<h1>Result:</h1> <p>Waiting for request...</p>";
            } else {
                echo "<h1>Result:</h1>";
                include "./layouts/rack.php";
            }
            ?>
        </section>
        <section>
            <h1>Popular:</h1>
            <?php include "./layouts/popularRack.php" ?>
        </section>
    </article>
</body>

</html>