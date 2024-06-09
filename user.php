<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "./layouts/head.php"; ?>
    <title>Bukie | User</title>
</head>

<body>
    <?php
    echo $twig->render("header.twig", ["user" => $_SESSION["user"], "location" => $_SERVER["PHP_SELF"]]);
    if (!$isUser) {
        echo "<p class=\"p-4\">You have to <a href=\"auth.php\">authorize</a>.</p>";
        return;
    }
    ?>
    <article class="p-5">
        <section class="row gap-4">
            <div class="col border p-4 infoCard rounded">
                <h1>Your information:</h1>
                <ul class="d-flex flex-column gap-2 ms-4">
                    <?php
                    foreach ($_SESSION["user"] as $key => $data) {
                        echo "<li style=\"display: flex\"><p style=\"width: 96px\">" . $key . "</p><p>" . $data . "</p></li>";
                    } ?>
                </ul>
            </div>
            <div class="col border p-4 infoCard rounded">
                <h1>Change email & password:</h1>
                <h2 class="mt-4">Change email</h2>
                <form class="d-flex flex-column gap-2" action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                    <input class="form-control" name="email" type="email" placeholder="E-mail" value="<?php echo $_SESSION["user"]["email"] ?>">
                    <input class="form-control" name="password" type="password" placeholder="Password">
                    <div><button class="btn btn-danger float-end">Submit</button></div>
                </form>
                <hr>
                <h2 class="mt-4">Change password</h2>
                <form class="d-flex flex-column gap-2" action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                    <input class="form-control" name="password1" type="password" placeholder="Old password">
                    <input class="form-control" name="password2" type="password" placeholder="New password">
                    <div><button class="btn btn-danger float-end">Submit</button></div>
                </form>
            </div>
        </section>
    </article>
    <?php echo $twig->render("footer.twig")?>
</body>

</html>