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

$emptyBooks = [
    [
        "id" => "",
        "name" => "",
        "description" => "",
        "image" => "",
        "author" => "",
        "pagesAmount" => "",
        "link" => "",
        "isCost" => "",
        "isReading" => ""
    ]
];

foreach ($popularBooks as $key => $book) {
    foreach ($lib as $libBook) {
        if ($book["id"] === $libBook["bookId"]) {
            $popularBooks[$key]["isReading"] = true;
        }
    }
};

if (isset($_GET["q"])) {
    $books = $booksAction->searchBook($_GET["q"]);
    foreach ($books as $key => $book) {
        foreach ($lib as $libBook) {
            if ($book["id"] === $libBook["bookId"]) {
                $books[$key]["isReading"] = true;
            }
        }
    };
}

function fill($field)
{
    if (isset($_GET[$field])) {
        echo $_GET[$field];
    }
}
?>

<body>
    <?php echo $twig->render("header.twig", ["user" => $_SESSION["user"], "location" => $_SERVER["PHP_SELF"]]); ?>
    <main class="d-flex gap-2 ps-5 pt-2 w-100 overflow-hidden">
        <aside>
            <form class="d-flex flex-column gap-2 bg-lighted rounded p-3" action="<?php $_SERVER["PHP_SELF"] ?>" method="get" style="width: fit-content;">
                <h2>Search the book</h2>
                <div class="d-flex input-group">
                    <input class="form-control form-outline border border-dark color-dark bg-transparent" type="text" name="q" placeholder="Name of the book" value="<?php fill("q") ?>">
                    <input class="btn btn-primary" type="submit" value="Search">
                </div>
                <div>
                    <h5>Filters:</h5>
                    <div class="d-flex gap-1">
                        <input hidden type="checkbox" id="fanfics" name="fanfics">
                        <button id="fanBtn" type="button" onclick="toggle(fans)" style="border-width: 4px" class="btn btn-warning">Fan&nbsp;fics</button>
                        <input hidden type="checkbox" id="originals" name="originals">
                        <button id="orBtn" type="button" onclick="toggle(orig)" style="border-width: 4px" class="btn btn-warning">Originals</button>
                        <input hidden type="checkbox" id="charts" name="charts">
                        <button id="chBtn" type="button" onclick="toggle(char)" style="border-width: 4px" class="btn bg-purple text-lighted">Charts</button>
                    </div>
                    <script async>
                        const [fanfics, originals, charts] = [document.getElementById("fanfics"), document.getElementById("originals"), document.getElementById("charts")];
                        const [fanBtn, orBtn, chBtn] = [document.getElementById("fanBtn"), document.getElementById("orBtn"), document.getElementById("chBtn")];
                        const [fans, orig, char] = [
                            [fanfics, fanBtn],
                            [originals, orBtn],
                            [charts, chBtn]
                        ];

                        const toggle = (obj) => {
                            obj[0].click();
                            if (obj[0].checked) {
                                obj[1].style.border = "4px solid #0D6EFD";
                            } else {
                                obj[1].style.border = "4px solid #00000000";
                            }
                        } //obj.checked = !obj.checked;

                        <?php
                        if (isset($_GET["fanfics"])) echo 'toggle(fans);';
                        if (isset($_GET["originals"])) echo 'toggle(orig);';
                        if (isset($_GET["charts"])) echo 'toggle(char);';
                        ?>
                    </script>
                </div>
            </form>
        </aside>
        <article class="d-flex flex-column gap-3 w-100">
            <section>
                <?php
                echo "<h3>Result:</h3>";
                if (!isset($_GET["q"])) {
                    echo "<p>Write anything to display more useful information.</p>";
                    echo $twig->render("carousel.twig", ["books" => $emptyBooks]);
                } else {
                    echo "<p>". sizeof($books) ." books are found.</p>";
                    echo $twig->render("carousel.twig", ['books' => $books]);
                }
                ?>
            </section>
            <section>
                <h3>Popular:</h3>
                <?php echo $twig->render("carousel.twig", ['books' => $popularBooks]); ?>
            </section>
        </article>
    </main>
    <?php echo $twig->render('footer.twig'); ?>
</body>

</html>