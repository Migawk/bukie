<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <title>Bukie | Search</title>
</head>

<?php
include "./layouts/rack.php";
$db = new DB();
$booksAction = new Books();
$libsAction = new Libs();
$popularBooks = $booksAction->getAllBooks();
$lib = $libsAction->getLib($_SESSION["user"]["id"]);

if (isset($_GET["q"])) {
    $books = $booksAction->searchBook($_GET["q"]);
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
    <article class="px-4">
        <section>
            <form class="d-flex w-50 input-group" action="<?php $_SERVER["PHP_SELF"] ?>" method="get">
                <input class="form-control form-outline" type="text" name="q" placeholder="Query..." value="<?php fill("q") ?>">
                <input class="btn btn-primary" type="submit" value="Submit">
            </form>
        </section>
        <section>
            <?php
            if (!isset($_GET["q"])) {

                echo "<h1>Result:</h1> <p>Waiting for request...</p>";
            } else {
                echo "<h1>Result:</h1>";
                rack($books, $libsAction,$lib);
            }
            ?>
        </section>
        <section>
            <h1>Popular:</h1>
            <?php rack($popularBooks, $libsAction, $lib); ?>
        </section>
    </article>
</body>

</html>